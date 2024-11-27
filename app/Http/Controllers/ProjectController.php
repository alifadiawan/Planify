<?php

namespace App\Http\Controllers;

use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function fetch()
    {
        $data = ProjectModel::all();
        return response()->json($data);
    }

    public function index()
    {
        return Inertia::render('KanbanBoard');
    }

    public function store(Request $request)
    {
        $data = [
            'project_title' => $request->project_title,
            // 'user_id' => Auth::user()->id
        ];

        ProjectModel::create($data);

        return response()->json($data, 200);
    }

    public function detail($id)
    {
        $data = ProjectModel::with('columns.cards')->findOrFail($id);
        // return $data;
        return Inertia::render('KanbanDetail',compact('data'));
    }
}