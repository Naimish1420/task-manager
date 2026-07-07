<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalTasks = auth()->user()->tasks()->count();
        $pendingTasks = auth()->user()->tasks()->where('status', TaskStatus::Pending)->count();
        $completedTasks = auth()->user()->tasks()->where('status', TaskStatus::Completed)->count();

        $recentTasks = auth()->user()->tasks()->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'recentTasks'
        ));
    }
}
