<?php

namespace Database\Seeders;

use App\Models\DataSource;
use Illuminate\Database\Seeder;

class DataSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'tag' => 'local',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'get',
                'type' => 'receive',
            ],
           [
                'tag' => 'local',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'post',
                'type' => 'create',
            ],
            [
                'tag' => 'local',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'put',
                'type' => 'update',
            ],
            [
                'tag' => 'local',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'delete',
                'type' => 'delete',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'get',
                'type' => 'receive',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'post',
                'type' => 'create',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'put',
                'type' => 'update',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'delete',
                'type' => 'delete',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'get',
                'type' => 'receive',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'post',
                'type' => 'create',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'put',
                'type' => 'update',
            ],
            [
                'tag' => 'facebook',
                'url'=> env('IPV4').'/api/test-resource',
                'method'=>'delete',
                'type' => 'delete',
            ],
        ];
        foreach($array as $item){
            DataSource::create($item);
        }
    }
}
