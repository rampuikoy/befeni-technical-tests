<?php

namespace App\ShirtOrder;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ShirtOrderRepository
{
    /**
     * create new shirt
     *
     * @param array $data
     *
     * @return object|null
     */
    public function store(array $data);

    /**
     * update shirt by id
     *
     * @param $id
     * @param array $data
     *
     * @return object
     */
    public function updateById($id, array $data);

    /**
     * get shirt by id
     *
     * @param $id
     *
     * @return object
     */
    public function getById($id);

    /**
     * delete shirt order by id
     *
     * @param $id
     *
     * @return object|null
     */
    public function DeleteById($id);

     /**
     * search shirt order
     *
     * @param $query
     *
     * @return Collection
     */
    public function search (string $query = ''): Collection;
}
