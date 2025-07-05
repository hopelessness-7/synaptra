<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\DTO\Auth\UserRegisterDTO;
use App\Modules\Auth\Application\UseCases\Auth\Register;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Auth\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __construct(
        private readonly Register $register
    ){}


    public function index(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): ?RedirectResponse
    {
        $dto = UserRegisterDTO::fromArray([
            ...$request->validated(),
            'userAgent' => $request->userAgent(),
            'ipAddress' => $request->ip(),
        ]);

        $this->register->execute($dto);

        return redirect()->route('login.view');
    }
}
