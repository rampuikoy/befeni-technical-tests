<?php

namespace App\ShirtOrder;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ShirtOrderRepository
{
    /**
     * get shirt order from several data source
     *
     * @param $tag
     * @param array $body
     * @param array $header
     *
     * @return null
     */
    public function receive($tag, $additional = [], $header = ['Accept' => 'application/json','Accept-Encoding' => 'gzip, deflate, br']);

    /**
     * get shirt order from several data source
     *
     * @param $tag
     * @param array $body
     * @param array $header
     *
     * @return null
     */
    public function create($tag, $additional = [], $header = ['Accept' => 'application/json', 'Content-Type' => 'application/json','Accept-Encoding' => 'gzip, deflate, br']);

    /**
     * get shirt order from several data source
     *
     * @param $tag
     * @param array $body
     * @param array $header
     *
     * @return null
     */
    public function update($tag, $additional = [], $header = ['Accept' => 'application/json', 'Content-Type' => 'application/json','Accept-Encoding' => 'gzip, deflate, br']);

    /**
     * get shirt order from several data source
     *
     * @param $tag
     * @param array $body
     * @param array $header
     *
     * @return null
     */
    public function delete($tag, $additional = [], $header = ['Accept' => 'application/json','Accept-Encoding' => 'gzip, deflate, br']);

    /**
     * search shirt order
     *
     * @param $query
     *
     * @return Collection
     */
    //public function search (string $query = ''): Collection;
}
