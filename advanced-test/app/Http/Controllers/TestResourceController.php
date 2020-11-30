<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShirtOrder\ShirtOrderGetByIdRequest;
use App\Http\Requests\ShirtOrder\ShirtOrderInsertRequest;
use App\Http\Requests\ShirtOrder\ShirtOrderUpdateRequest;
use App\ShirtOrder\TestResource\TestResourceRepository;
use App\Traits\CoreResponseTrait;
use Illuminate\Http\Request;

class TestResourceController extends Controller
{
    use CoreResponseTrait;

    protected $shirtOrderRepo;

    public function __construct(TestResourceRepository $shirtOrderRepo)
    {
        $this->shirtOrderRepo = $shirtOrderRepo;
    }

    public function insert(ShirtOrderInsertRequest $request)
    {
        $data = $request->only(
            'customer_id',
            'fabric_id',
            'collar_size',
            'chest_size',
            'waist_size',
            'wrist_size',
        );

        $shirt = $this->shirtOrderRepo->store($data);

        return $this->successResponse($shirt, 201);
    }

    public function updateById(ShirtOrderUpdateRequest $request)
    {
        $id = $request->id;
        $data = $request->only(
            'customer_id',
            'fabric_id',
            'collar_size',
            'chest_size',
            'waist_size',
            'wrist_size',
        );

        $shirt = $this->shirtOrderRepo->updateById($id, $data);

        return $this->successResponse($shirt);
    }

    public function getById(Request $request)
    {
        if ($request->has('id')){
            $id = $request->id;

            $shirt = $this->shirtOrderRepo->getById($id);
        }else {
            $shirt = $this->shirtOrderRepo->all();
        }


        return $this->successResponse($shirt);
    }

    public function deleteById(ShirtOrderGetByIdRequest $request)
    {
        $id = $request->id;

        $shirt = $this->shirtOrderRepo->deleteById($id);

        return $this->successResponse($shirt);
    }

    public function search()
    {
        //
    }
}
