<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatisticController extends Controller
{
    public function index(): View
    {
        $statistics = Statistic::with('user')
                               ->orderByDesc('total_tasks')
                               ->limit(10)
                               ->get();
        return view('statistics.index', compact('statistics'));
    }
}
