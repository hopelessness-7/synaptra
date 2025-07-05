<?php

namespace App\Modules\Auth\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Auth\Application\UseCases\User\Show;
use Illuminate\Http\Request;
use Modules\Auth\Http\Resources\UserResource;

class UserController extends MainApiController
{
    public function __construct(
        private readonly Show $show
    ){}

    public function show(Request $request, $id = null)
    {
        $id = $id ?: auth()->user()->id;
        $user = $this->show->execute($id);

        return $this->success([
            ...UserResource::make($user)->toArray($request),
        ]);
    }
}

