<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\DTO\UserDTO;
use App\Modules\Auth\Application\UseCases\User\Update;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function update(Update $update, UserRequest  $request): RedirectResponse
    {
        $dto = UserDto::fromRequest($request->validated());

        dd($dto);

        $update->update($dto);

        return redirect()->back()->with('success', 'Update completed');
    }
}
