<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CrudControllerInterface
{
    public function index(Request $request): JsonResponse;
    public function show(int $id): JsonResponse;
    public function store(Request $request): JsonResponse;
    public function update(Request $request, int $id): JsonResponse;
    public function destroy(int $id): JsonResponse;
}
