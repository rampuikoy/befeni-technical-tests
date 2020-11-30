<?php

namespace App\ShirtOrder;

use App\Models\ShirtOrder;
use App\ShirtOrder\Datasource\DataSourceRepository;
use App\ShirtOrder\ShirtOrderRepository;
use App\Traits\CacheTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Elasticsearch\Client;
use Exception;
use GrahamCampbell\ResultType\Success;

class EloquentRepository implements ShirtOrderRepository
{

    use CacheTrait;

    const CACHE_KEY             = 'SHIRT_ORDER';
    const MINUTE_CACHE          = 1;


    protected $dataRepo;
    private $elasticsearch;

    public function __construct(ShirtOrder $shirt, DataSourceRepository $dataRepo, Client $elasticsearch)
    {
        $this->dataRepo = $dataRepo;
        $this->keyBy = self::CACHE_KEY . ".TAG.TYPE";
        $this->time = $this->getTime(self::MINUTE_CACHE);
        $this->shirt        = $shirt;
        $this->elasticsearch = $elasticsearch;
    }

    public function create($tag, $additional = [], $header = ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Accept-Encoding' => 'gzip, deflate, br'])
    {
        $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.CREATE", $additional, $header);

        $source = $this->dataRepo->getByTagType($tag, 'create');

        $response = Cache::remember($key, $this->time, function () use ($source, $additional, $header) {
            $response = $this->getResponse($source, $additional, $header);
            return $response;
        });

        return $response;
    }

    public function update($tag, $additional = [], $header = ['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Accept-Encoding' => 'gzip, deflate, br'])
    {
        $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.UPDATE", $additional, $header);

        $source = $this->dataRepo->getByTagType($tag, 'update');

        $response = Cache::remember($key, $this->time, function () use ($tag, $source, $additional, $header) {
            $response = $this->getResponse($source, $additional, $header);
            return $response;
        });

        $updateAll = $this->updateModelToAllDataSource($tag, $additional, $header);

        return [$response, $updateAll];
    }

    public function delete($tag, $additional = [], $header = ['Accept' => 'application/json', 'Accept-Encoding' => 'gzip, deflate, br'])
    {
        $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.DELETE", $additional, $header);

        $source = $this->dataRepo->getByTagType($tag, 'delete');

        $response = Cache::remember($key, $this->time, function () use ($source, $additional, $header) {
            $response = $this->getResponse($source, $additional, $header);
            return $response;
        });

        $deleteAll = $this->deleteModelToAllDataSource($tag, $additional, $header);

        return [$response, $deleteAll];
    }

    public function receive($tag, $filter = [], $additional = [], $header = ['Accept' => 'application/json', 'Accept-Encoding' => 'gzip, deflate, br'])
    {

        $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.RECEIVE", $additional, $header);

        $source = $this->dataRepo->getByTagType($tag, 'receive');

        $response = Cache::remember($key, $this->time, function () use ($tag, $source, $additional, $header) {
            $response = $this->getResponse($source, $additional, $header);
            $this->saved($tag, $response['result']);
            return $response;
        });

        if (is_null($filter)) {

            return $response;
        }

        return  $this->search($tag, $filter);
    }

    public function getResponse($source, $additional, $header)
    {
        switch ($source->method) {
            case 'post':
                $response = Http::withHeaders($header)->post($source->url, $additional);
                break;
            case 'get':
                $response = Http::withHeaders($header)->get($source->url, $additional);
                break;
            case 'put':
                $response = Http::withHeaders($header)->put($source->url, $additional);
                break;
            case 'patch':
                $response = Http::withHeaders($header)->patch($source->url, $additional);
                break;
            case 'delete':
                $response = Http::withHeaders($header)->delete($source->url, $additional);
                break;
        }
        return $response->json();
    }

    public function search($tag, $condition)
    {
        $items = $this->searchOnElasticsearch($tag, $condition);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch($tag, $condition): array
    {

        $items = $this->elasticsearch->search([
            'index' => 'shirt_order_' . $tag,
            'body' => [
                "query" => [
                    "match" => $condition
                ]
            ]
        ]);

        return $items;
    }

    private function buildCollection(array $items)
    {
        $data = [];
        foreach ($items['hits']['hits'] as $item) {
            $data[] = $item['_source'];
        }
        return $data;
    }

    public function saved($tag, $result)
    {
        foreach ($result as $items) {
            $this->elasticsearch->index([
                'index' => 'shirt_order_' . $tag,
                'id' => 1,
                'body' => $items,
            ]);
        }
    }

    public function deleted($tag)
    {
        $this->elasticsearch->delete([
            'index' => 'shirt_order_' . $tag,
            'id' => 'FSBzFHYBVdRe3uk1dsse',
        ]);
    }

    public function updateModelToAllDataSource($tag, $additional, $header)
    {
        $source =  $this->dataRepo->getAllTagUpdate($tag);
        $succes = [];
        $error = [];
        foreach ($source as $item) {
            $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.UPDATE", $additional, $header);

            try {
                $response = Cache::remember($key, $this->time, function () use ($item, $additional, $header) {
                    $response = $this->getResponse($item, $additional, $header);
                    return $response;
                });
                $succes[] = $item;
            } catch (Exception $e) {
                $error[] = $item;
            }
        }
        return ["succes item" => $succes, "error item" => $error];
    }

    public function deleteModelToAllDataSource($tag, $additional, $header)
    {
        $source =  $this->dataRepo->getAllTagDelete($tag);
        $succes = [];
        $error = [];
        foreach ($source as $item) {
            $key = $this->getTwoArrayKey(self::CACHE_KEY . ".TAG." . $tag . "TYPE.DELETE", $additional, $header);

            try {
                $response = Cache::remember($key, $this->time, function () use ($item, $additional, $header) {
                    $response = $this->getResponse($item, $additional, $header);
                    return $response;
                });
                $succes[] = $item;
            } catch (Exception $e) {
                $error[] = $item;
            }
        }
        return ["succes item" => $succes, "error item" => $error];
    }
}
