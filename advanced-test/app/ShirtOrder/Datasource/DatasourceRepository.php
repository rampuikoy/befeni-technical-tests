<?php

namespace App\ShirtOrder\Datasource;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface DataSourceRepository
{

    /**
     * create new data source
     *
     *
     * @return object|null
     */
    public function all();

    /**
     * create new data source
     *
     * @param array $data
     *
     * @return object|null
     */
    public function store(array $data);

    /**
     * get data source by tag type
     *
     * @param $tag
     *
     * @param $type
     *
     * @return object
     */
    public function getByTagType($tag, $type);

    /**
     * delete data source by tag type
     *
     * @param $tag
     *
     * @param $type
     *
     * @return null
     */
    public function deleteByTagType($tag, $type);


     /**
     * get all tag with type update
     *
     * @param $tag
     *
     *
     * @return object
     */
    public function getAllTagUpdate($tag);

     /**
     * get all tag with type delete
     *
     * @param $tag
     *
     *
     * @return object
     */
    public function getAllTagDelete($tag);

}
