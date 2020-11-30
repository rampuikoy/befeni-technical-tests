<?php

namespace App\ShirtOrder\TestResource;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TestResourceRepository
{
      /**
     * get all shirt
     *
     *
     *
     * @return object|null
     */
    public function all();

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
     * @return null
     */
    public function deleteById($id);

    /**
     * import shirt order
     *
     * @param $id
     * @param array $data
     *
     * @return null
     */
    public function import(array $data);

}
