<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShirtOrder\ShirtOrderInsertRequest;
use App\Http\Requests\ShirtOrder\ShirtOrderUpdateRequest;
use App\ShirtOrder\ShirtOrderRepository;
use App\Traits\CoreResponseTrait;
use Illuminate\Http\Request;

class ShirtOrderController extends Controller
{
    use CoreResponseTrait;

    protected $shirtOrderRepo;

    public function __construct(ShirtOrderRepository $shirtOrderRepo)
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

        return $this->successResponse($shirt);
    }

    public function updateById(ShirtOrderUpdateRequest $request, $id)
    {
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

    public function getById($id)
    {
        $shirt = $this->shirtOrderRepo->getById($id);

        return $this->successResponse($shirt);
    }

    public function deleteById($id)
    {
        $shirt = $this->shirtOrderRepo->deleteById($id);

        return $this->successResponse($shirt);
    }

    public function search()
    {
        //
    }
}
