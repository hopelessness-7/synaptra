<?php

namespace App\Modules\Common\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Common\Application\UseCases\GetDashboard;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private GetDashboard $getDashboard;

    public function __construct(GetDashboard $getDashboard)
    {
        $this->getDashboard = $getDashboard;
    }

    public function index():  View
    {
        $dashboard = $this->getDashboard->execute();
        return view('common.dashboard', compact('dashboard'));
    }
}

