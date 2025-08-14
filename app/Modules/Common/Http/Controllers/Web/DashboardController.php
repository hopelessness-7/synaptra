<?php

namespace App\Modules\Common\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Common\Application\UseCases\GetDashboard;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private GetDashboard $getDashboard;

    public function __construct(GetDashboard $getDashboard)
    {
        $this->getDashboard = $getDashboard;
    }

    public function index(): RedirectResponse|View
    {
        if (!auth()->user()->projects()->exists()) {
            return redirect()->route('onboarding.step', 'welcome');
        }

        $dashboard = $this->getDashboard->execute();
        return view('common.dashboard', compact('dashboard'));
    }
}

