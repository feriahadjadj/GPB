<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    // Show all history entries
    public function index()
    {
        $histories = History::orderBy('date_time', 'desc')->get();
        return view('history.index', compact('histories'));
    }

    // Save a new history entry
    public function store(Request $request)
    {
        $request->validate([
            'date_time' => 'required|date',
            'detail' => 'required|string',
        ]);

        History::create([
            'date_time' => $request->date_time,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'History saved successfully!');
    }
}
