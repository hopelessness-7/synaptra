<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ReadOnlyApiController extends MainApiController
{
    protected $get;
    protected $show;

    protected $resourceClass;

    public function __construct(object $get, object $show)
    {
        $this->get = $get;
        $this->show = $show;
    }

    public function index(): JsonResponse
    {
        return $this->success(
            $this->resourceClass::collection($this->get->get())->resolve()
        );
    }

    public function show(int $id): JsonResponse
    {
        return $this->success(
            $this->resourceClass::make($this->show->show($id))->resolve()
        );
    }
}
