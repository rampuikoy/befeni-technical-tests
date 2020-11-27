<?php

use App\Models\ShirtOrder;
use App\ShirtOrder\ShirtOrderRepository;
use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class EloquentRepository implements ShirtOrderRepository
{

    use CacheTrait;

    const CACHE_KEY             = 'SHIRT_ORDER';
    const MINUTE_CACHE          = 1;

    public function __construct(ShirtOrder $shirt)
    {
        $this->keyById = self::CACHE_KEY . ".ID";
        $this->time = $this->getTime(self::MINUTE_CACHE);
        $this->shirt        = $shirt;
    }

    public function store(array $data)
    {
        $shirt  = $this->shirt::create($data);

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
            // $shirt->load('relation'); ---- use for load relation with shirt order.

            return $shirt;
        });

        return $shirt;
    }

    public function updateById($id, array $data)
    {
        $shirt = $this->getById($id);
        if(is_null($shirt)){
            return null;
        }
        $shirt->update($data);
        return $this->updateCacheById($shirt->id);
    }

    public function DeleteById($id)
    {
        $shirt = $this->getById($id);
        if(is_null($shirt)){
            return null;
        }
        $shirt->delete();
        return null;
    }

    public function search(string $query = ''): Collection
    {

    }

    public function updateCacheById($id)
    {
        $key = $this->getCacheKey($this->keyById, $id);
        Cache::forget($key);
        return $this->getById($id);
    }
}
