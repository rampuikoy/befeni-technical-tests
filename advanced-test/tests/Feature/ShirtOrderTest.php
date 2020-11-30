<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ShirtOrderTest extends TestCase
{

    use WithFaker;

    const PREFIX = 'api/shirt-order';
    /**
     * test receive shirt order from data soure
     *
     * @return void
     */
    /** @test */
    public function receive_shirt_order_from_datasource_test(){
        $response = $response = $this->json('POST',  'api/shirt-order/receive', [
            "tag" => "local",
        ]);
        $response->assertStatus(200);
    }

      /**
     * test update shirt order from data soure
     *
     * @return void
     */
    /** @test */
    public function update_shirt_order_from_datasource_test(){
        $response = $response = $this->json('POST',  'api/shirt-order/update', [
            "tag" => "local",
            "additional" => ['id' => '5','collar_size' => '40'],
        ]);
        $response->assertStatus(200);
    }

     /**
     * test delete shirt order from data soure
     *
     * @return void
     */
    /** @test */
    public function delete_shirt_order_from_datasource_test(){
        $response = $response = $this->json('POST',  'api/shirt-order/delete', [
            "tag" => "local",
            "additional" => ['id' => '5'],
        ]);
        $response->assertStatus(200);
    }


}
