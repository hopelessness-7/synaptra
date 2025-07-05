<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\DTO\Auth\LoginDTO;
use App\Modules\Auth\Application\UseCases\Auth\Login;
use App\Modules\Auth\Infrastructure\Exceptions\DeviceNotConfirmedException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Infrastructure\Exceptions\AccountBlockedException;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;

class LoginController extends Controller
{
    public function __construct(
        private readonly Login $login
    ) {}

    public function index(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): ?RedirectResponse
    {
        $dto = LoginDTO::fromArray([
            ...$request->validated(),
            'userAgent' => $request->userAgent(),
            'ip' => $request->ip(),
        ]);

        try {
            $data = $this->login->execute($dto);

            return redirect()->route('dashboard')
                ->withCookie(cookie('token', $data['token']));

        } catch (AuthenticationException $e) {
            return back()->withErrors(['auth' => 'Incorrect credentials']);
        } catch (AccountBlockedException $e) {
            return back()->withErrors(['auth' => 'Account blocked']);
        } catch (DeviceNotConfirmedException $e) {
            return back()->withErrors(['auth' => 'Confirm the device']);
        }
    }
}
