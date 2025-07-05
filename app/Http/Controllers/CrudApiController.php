<?php

namespace App\Http\Controllers;

use App\Contracts\CrudControllerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CrudApiController extends MainApiController implements CrudControllerInterface
{
    protected $get;
    protected $show;
    protected $create;
    protected $update;
    protected $delete;

    protected $dto;

    protected $resourceClass;

    protected $createRequestClass;
    protected $updateRequestClass;

    public function __construct(
        object $get,
        object $show,
        object $create,
        object $update,
        object $delete
    ) {
        $this->get = $get;
        $this->show = $show;
        $this->create = $create;
        $this->update = $update;
        $this->delete = $delete;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->success($this->resourceClass::collection($this->get->get())->toArray($request));
    }

    public function show(int $id): JsonResponse
    {
        return $this->success($this->resourceClass::make($this->show->show($id))->resolve());
    }

    public function store(Request $request): JsonResponse
    {
        $validatedRequest = app($this->createRequestClass);
        $data = $validatedRequest->validated();

        $dto = ($this->dto)::fromArray($data);

        return $this->success($this->resourceClass::make($this->create->create($dto))->toArray($request));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validatedRequest = app($this->updateRequestClass);
        $data = $validatedRequest->validated();

        $dto = ($this->dto)::fromArray([...$data, 'id' => $id]);

        return $this->success($this->resourceClass::make($this->update->update($dto))->toArray($request));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->delete->delete($id);
        return $this->success();
    }
}
