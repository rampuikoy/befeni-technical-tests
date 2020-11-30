<?php

namespace App\ShirtOrder\TestResource;

use App\Models\ShirtOrder;
use App\ShirtOrder\Datasource\DataSourceRepository;
use App\Traits\CacheTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EloquentRepository implements TestResourceRepository
{

    use CacheTrait;

    const CACHE_KEY             = 'TEST_RESOURCE';
    const MINUTE_CACHE          = 1;

    protected $dataRepo;

    public function __construct(ShirtOrder $shirt, DataSourceRepository $dataRepo)
    {
        $this->dataRepo = $dataRepo;
        $this->keyById = self::CACHE_KEY . ".ID";
        $this->time = $this->getTime(self::MINUTE_CACHE);
        $this->shirt        = $shirt;
    }

    public function all(){
        $key = $this->getCacheKey(self::CACHE_KEY, 'ALL');
        $shirt = Cache::remember($key, $this->time, function (){
            return ShirtOrder::all();
        });
        return $shirt;
    }

    public function store(array $data)
    {
        $shirt  = $this->shirt->create($data);

        if (is_null($shirt)) {
            return null;
        }
        return $this->getById($shirt->id);
    }

    public function getById($id)
    {
        $key = $this->getCacheKey($this->keyById, $id);
        $shirt = Cache::remember($key, $this->time, function () use ($id) {
            $shirt = ShirtOrder::find($id);

            return $shirt;
        });

        return $shirt;
    }

    public function updateById($id, array $data)
    {
        $shirt = $this->getById($id);
        if (is_null($shirt)) {
            return null;
        }
        $shirt->update($data);
        return $this->updateCacheById($shirt->id);
    }

    public function deleteById($id)
    {
        $shirt = $this->getById($id);

        if (is_null($shirt)) {

            return 'record has been deleted or not found';
        }
        $shirt->delete();

        $this->deleteCacheById($id);

        return 'delete success';
    }

    public function import($data)
    {
        $shirt  = $this->shirt::insert($data);
        return $shirt;
    }

    public function updateCacheById($id)
    {
        $key = $this->getCacheKey($this->keyById, $id);
        Cache::forget($key);
        return $this->getById($id);
    }

    public function deleteCacheById($id)
    {
        $key = $this->getCacheKey($this->keyById, $id);
        Cache::forget($key);
    }
}
