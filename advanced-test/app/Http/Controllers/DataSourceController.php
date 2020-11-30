<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataSource\DataSourceCreateRequest;
use App\ShirtOrder\Datasource\DataSourceRepository;
use App\Traits\CoreResponseTrait;
use Illuminate\Http\Request;

class DataSourceController extends Controller
{
    use CoreResponseTrait;

    protected $dataRepo;

    public function __construct(DataSourceRepository $dataSourceRepository)
    {
        $this->dataRepo = $dataSourceRepository;
    }

    public function create(DataSourceCreateRequest $request){
        $data = $request->only('type','method','url','tag');
        $source = $this->dataRepo->store($data);

        return $this->successResponse($source, 201);
    }

    public function get(Request $request, $tag, $type){
        $source = $this->dataRepo->getByTagType($tag, $type);

        return $this->successResponse($source);
    }

    public function delete(Request $request, $tag, $type){
        $source = $this->dataRepo->deleteByTagType($tag, $type);

        return $this->successResponse($source);
    }

    public function all(Request $request){
        $source = $this->dataRepo->all();
        return $this->successResponse($source);
    }
}
