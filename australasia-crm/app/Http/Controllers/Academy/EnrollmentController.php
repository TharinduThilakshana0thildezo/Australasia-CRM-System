<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('academy.enrollments.index');
    }

    public function show(int $id)
    {
        return view('academy.enrollments.show');
    }

    public function complete(int $id)
    {
        // TODO: Validate criteria (fee paid, attendance ok, exam passed, cert issued).
        //       AcademyEnrollment::findOrFail($id)->update(['status' => 'completed', 'completed_at' => now()]);
        return back()->with('success', 'Enrollment marked as completed.');
    }

    public function withdraw(Request $request, int $id)
    {
        $request->validate([
            'withdrawal_date'   => 'required|date',
            'withdrawal_reason' => 'required|string|min:10',
        ]);

        // TODO: AcademyEnrollment::findOrFail($id)->update(['status' => 'withdrawn', 'withdrawn_at' => $request->withdrawal_date, 'withdrawal_reason' => $request->withdrawal_reason]);
        //       Check AcademySetting `withdrawal_fee_policy` and alert finance if partial_refund is configured.
        return redirect()->route('academy.enrollments.index')
            ->with('success', 'Withdrawal recorded. Fee policy applied per settings.');
    }
}
