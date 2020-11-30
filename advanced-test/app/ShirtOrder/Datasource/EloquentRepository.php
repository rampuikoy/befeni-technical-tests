<?php

namespace App\ShirtOrder\Datasource;

use App\Models\DataSource;
use App\Models\ShirtOrder;
use App\ShirtOrder\ShirtOrderRepository;
use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class EloquentRepository implements DataSourceRepository
{

    use CacheTrait;

    const CACHE_KEY             = 'DATA_SOURCE';
    const MINUTE_CACHE          = 1;

    public function __construct(DataSource $source)
    {
        $this->keyAll = $this->getCacheKey(self::CACHE_KEY, 'ALL');
        $this->keyByTagType = self::CACHE_KEY . ".TAG";
        $this->time = $this->getTime(self::MINUTE_CACHE);
        $this->source        = $source;
    }

    public function store(array $data)
    {
        $source = $this->getByTagType($data['tag'], $data['type']);
        if (!is_null($source)) {
            return $source;
        }

        $source = $this->source->create($data);
        return $this->getByTagType($source->tag, $source->type);
    }

    public function getByTagType($tag, $type)
    {
        $key = $this->getCacheKey($this->keyByTagType, $tag . "." . $type);
        $source = Cache::remember($key, $this->time, function () use ($tag, $type) {
            $source = DataSource::where([['tag', '=', $tag], ['type', '=', $type]])->first();
            return $source;
        });

        return $source;
    }

    public function deleteByTagType($tag, $type)
    {
        $source = $this->getByTagType($tag, $type);

        $source->delete();
        $this->deleteCacheByTagType($tag, $type);

        return 'delete success';
    }

    public function getAllTagUpdate($tag)
    {
        $key = $this->getCacheKey(self::CACHE_KEY, 'ALL.UPDATE.WITHOUT.'.$tag);
        $source = Cache::remember($key, $this->time, function () use ($tag) {
            $source = DataSource::where([['tag', '<>', $tag], ['type', '=', 'update']])->get();
            return $source;
        });

        return $source;
    }

    public function getAllTagDelete($tag)
    {
        $key = $this->getCacheKey(self::CACHE_KEY, 'ALL.DELETE.WITHOUT.'.$tag);
        $source = Cache::remember($key, $this->time, function () use ($tag) {
            $source = DataSource::where([['tag', '<>', $tag], ['type', '=', 'delete']])->get();
            return $source;
        });

        return $source;
    }

    public function all()
    {
        $source = Cache::remember($this->keyAll, $this->time, function () {
            return DataSource::all();
        });

        return $source;
    }

    public function updateCacheByTagType($tag, $type)
    {
        $key = $this->getCacheKey($this->keyByTagType, $tag . "." . $type);
        Cache::forget($key);
        return $this->getByTagType($tag, $type);
    }


    public function deleteCacheByTagType($tag, $type)
    {
        $key = $this->getCacheKey($this->keyByTagType, $tag . "." . $type);
        Cache::forget($key);
    }
}
