<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\UseCases\Auth\Logout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __construct(
        private readonly Logout $logout
    ){}

    public function __invoke(): RedirectResponse
    {
        $this->logout->execute();
        Auth::logout();
        return redirect()->route('login.view')->withoutCookie('token');
    }
}
