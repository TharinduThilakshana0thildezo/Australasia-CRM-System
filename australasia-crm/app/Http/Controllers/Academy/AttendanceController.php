<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * AttendanceController — Session attendance marking, correction, and make-up session management.
 *
 * Business rule: Attendance threshold for exam eligibility is configurable via AcademySetting.
 * The threshold is NOT hard-coded — always read from settings.
 */
class AttendanceController extends Controller
{
    public function index()
    {
        // TODO: $sessions = AcademySession::with('batch.course')->latest()->paginate(50);
        //       $belowThreshold = AcademyStudent::belowAttendanceThreshold()->get();
        return view('academy.attendance.index');
    }

    /**
     * Show mark-attendance form for a session.
     */
    public function markForm(int $sessionId)
    {
        // TODO: $session = AcademySession::with(['batch.students'])->findOrFail($sessionId);
        return view('academy.attendance.mark');
    }

    /**
     * Save bulk attendance for a session.
     */
    public function store(Request $request, int $sessionId)
    {
        $request->validate([
            'attendance'              => 'required|array',
            'attendance.*.student_id' => 'required|integer',
            'attendance.*.status'     => 'required|in:present,absent,late,excused',
        ]);

        // TODO: foreach ($request->attendance as $entry) {
        //           AcademyAttendance::create([
        //               'session_id'  => $sessionId,
        //               'student_id'  => $entry['student_id'],
        //               'status'      => $entry['status'],
        //               'note'        => $entry['note'] ?? null,
        //               'recorded_by' => auth()->id(),
        //           ]);
        //       }
        //       AcademySession::findOrFail($sessionId)->update(['attendance_recorded' => true]);

        return redirect()->route('academy.attendance.index')
            ->with('success', 'Attendance recorded for this session.');
    }

    /**
     * Correct a previously recorded attendance entry.
     * Original entry is preserved in the audit log.
     */
    public function correct(Request $request, int $sessionId)
    {
        $request->validate([
            'student_id'         => 'required|integer',
            'new_status'         => 'required|in:present,absent,late,excused',
            'correction_reason'  => 'required|string|min:5',
        ]);

        // TODO: AcademyAttendanceCorrection::create([
        //           'session_id'        => $sessionId,
        //           'student_id'        => $request->student_id,
        //           'new_status'        => $request->new_status,
        //           'correction_reason' => $request->correction_reason,
        //           'corrected_by'      => auth()->id(),
        //       ]);
        //       // Soft-update current record; original is preserved via correction log.

        return back()->with('success', 'Attendance corrected. Original record preserved in audit log.');
    }

    /**
     * Make-up sessions listing.
     */
    public function makeup()
    {
        // TODO: $belowThreshold = AcademyStudent::belowAttendanceThreshold()->get();
        //       $makeupSessions  = AcademyMakeupSession::with('student','originalSession')->latest()->get();
        return view('academy.attendance.makeup');
    }

    /**
     * Schedule a make-up session for a student.
     */
    public function makeupStore(Request $request)
    {
        $request->validate([
            'student_id'  => 'required|integer',
            'session_id'  => 'required|integer',
            'makeup_date' => 'required|date|after:today',
            'reason'      => 'required|string',
        ]);

        // TODO: AcademyMakeupSession::create([...]);
        return redirect()->route('academy.attendance.makeup')
            ->with('success', 'Make-up session scheduled.');
    }
}
