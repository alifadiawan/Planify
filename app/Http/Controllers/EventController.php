<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $data = EventModel::all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $data = [
            'title' => $request->title,
            'start' => Carbon::parse($request->start)->format('Y-m-d H:i'),  // Disable seconds
            'end' => Carbon::parse($request->end)->format('Y-m-d H:i'),      // Disable seconds
            'description' => $request->description,
        ];

        // Create a new event using validated data
        $event = EventModel::create($data);

        // Return a JSON response with the created event and a 201 status code
        return response()->json($event, 201);
    }
}
