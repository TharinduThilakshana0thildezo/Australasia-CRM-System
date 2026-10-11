<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('academy.sessions.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'     => 'required|string',
            'topic'        => 'required|string|max:255',
            'session_date' => 'required|date',
            'venue'        => 'nullable|string|max:100',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
        ]);

        // TODO: AcademySession::create([...]);
        return back()->with('success', 'Session added to batch schedule.');
    }
}
