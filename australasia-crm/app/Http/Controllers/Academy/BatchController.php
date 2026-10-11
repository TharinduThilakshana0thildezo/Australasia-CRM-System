<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        return view('academy.batches.index');
    }

    public function create()
    {
        return view('academy.batches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|string',
            'batch_code'  => 'required|string|max:30|unique:academy_batches,batch_code',
            'trainer_id'  => 'required|string',
            'capacity'    => 'required|integer|min:1',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        // TODO: AcademyBatch::create([...]);
        return redirect()->route('academy.batches.index')
            ->with('success', 'Batch created and scheduled.');
    }

    public function show(int $id)
    {
        return view('academy.batches.show');
    }

    public function start(int $id)
    {
        // TODO: AcademyBatch::findOrFail($id)->update(['status' => 'active', 'started_at' => now()]);
        return back()->with('success', 'Batch started.');
    }

    public function complete(int $id)
    {
        // TODO: AcademyBatch::findOrFail($id)->update(['status' => 'completed', 'completed_at' => now()]);
        return redirect()->route('academy.batches.show', $id)
            ->with('success', 'Batch marked complete. Students are now eligible for certificate issuance (if exam passed).');
    }

    public function transfer(Request $request, int $id)
    {
        $request->validate([
            'student_id'      => 'required|integer',
            'new_batch_id'    => 'required|integer',
            'transfer_reason' => 'required|string|min:10',
        ]);

        // TODO: Update AcademyEnrollment: set batch_id to new_batch_id, log transfer reason.
        //       Check new batch has available capacity before transferring.
        return back()->with('success', 'Student transferred to new batch. Attendance history is preserved.');
    }
}
