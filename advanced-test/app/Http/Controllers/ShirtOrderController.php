<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShirtOrder\ShirtOrderApiRequest;
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

    public function receive(ShirtOrderApiRequest $request)
    {
        $additional = $request->additional;

        $tag = $request->tag;

        $filter = $request->filter;

        if ($request->has('send_header')) {
            $header = $request->send_header;
            $response = $this->shirtOrderRepo->receive($tag, $filter, $additional, $header);
        } else {
            $response = $this->shirtOrderRepo->receive($tag, $filter, $additional);
        }

        return $response;
    }

    public function delete(ShirtOrderApiRequest $request)
    {
        $additional = $request->additional;

        $tag = $request->tag;

        if ($request->has('send_header')) {
            $header = $request->send_header;
            $response = $this->shirtOrderRepo->delete($tag, $additional, $header);
        } else {
            $response = $this->shirtOrderRepo->delete($tag, $additional);
        }

        return $response;
    }

    public function update(ShirtOrderApiRequest $request)
    {
        $additional = $request->additional;

        $tag = $request->tag;

        if ($request->has('send_header')) {
            $header = $request->send_header;
            $response = $this->shirtOrderRepo->update($tag, $additional, $header);
        } else {
            $response = $this->shirtOrderRepo->update($tag, $additional);
        }

        return $response;
    }

    public function create(ShirtOrderApiRequest $request)
    {
        $additional = $request->additional;

        $tag = $request->tag;

        if ($request->has('send_header')) {
            $header = $request->send_header;
            $response = $this->shirtOrderRepo->create($tag, $additional, $header);
        } else {
            $response = $this->shirtOrderRepo->create($tag, $additional);
        }

        return $response;
    }
}
