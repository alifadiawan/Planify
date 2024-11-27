<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $totalTask = Task::count();
        $totalSubTask = SubTask::count();
        $project = ProjectModel::all();

        return Inertia::render('Dashboard', compact('totalTask', 'totalSubTask', 'project'));
    }

    public function taskStatistics()
    {
        $totalTasks = Task::count();
        $totalSubTasks = SubTask::count();
        $statusCounts = SubTask::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get();

        return response()->json([
            'totalTasks' => $totalTasks,
            'totalSubTasks' => $totalSubTasks,
            'statusCounts' => $statusCounts,
        ]);
    }
}
