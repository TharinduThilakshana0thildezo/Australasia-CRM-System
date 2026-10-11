<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * StudentController — Registration, profile management, and cross-module linking.
 * Identity rule: NIC and phone are the matching keys across all three modules.
 */
class StudentController extends Controller
{
    public function index()
    {
        // TODO: $students = AcademyStudent::with('handler')->latest()->paginate(50);
        return view('academy.students.index');
    }

    public function create()
    {
        return view('academy.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nic'               => 'required|string|max:12',
            'full_name'         => 'required|string|max:255',
            'phone'             => 'required|string|max:15',
            'email'             => 'nullable|email|max:255',
            'dob'               => 'nullable|date',
            'source'            => 'required|in:walk_in,employment,consultancy,referral,link,phone,online',
            'handler_id'        => 'required|string',
            'registration_date' => 'required|date',
        ]);

        // Duplicate detection: check NIC against AcademyStudent, Employment candidates, Consultancy students.
        // TODO: $existing = AcademyStudent::where('nic', $request->nic)->first();
        //       Also check EmploymentCandidate::where('nic', ...) and ConsultancyStudent::where('nic', ...);
        //       If found, warn staff rather than block creation.

        // TODO: $student = AcademyStudent::create([...]);
        //       If $request->source === 'employment' && $request->employment_candidate_id → link profiles.
        //       If $request->source === 'consultancy' && $request->consultancy_student_id → link profiles.

        return redirect()->route('academy.students.index')
            ->with('success', 'Student registered successfully.');
    }

    public function show(int $id)
    {
        // TODO: $student = AcademyStudent::with(['enrollments.course','enrollments.batch',
        //       'payments','certificates','attendances','examResults'])->findOrFail($id);
        return view('academy.students.show');
    }

    /**
     * Enroll a student in a course/batch from the student profile.
     */
    public function enroll(Request $request, int $id)
    {
        $request->validate([
            'course_id' => 'required|string',
            'batch_id'  => 'required|string',
        ]);

        // TODO: Check batch capacity before enrolling.
        //       If full, offer waitlist based on AcademySetting::seat_hold_days.
        //       AcademyEnrollment::create(['student_id' => $id, 'course_id' => ..., 'batch_id' => ..., 'status' => 'enrolled']);

        return redirect()->route('academy.students.show', $id)
            ->with('success', 'Student enrolled successfully. Fee payment required to confirm seat.');
    }

    /**
     * Close a student case with reason.
     */
    public function close(Request $request, int $id)
    {
        $request->validate([
            'close_type'   => 'required|in:withdrawn,unresponsive,final_fail,other',
            'close_reason' => 'required|string|min:10',
        ]);

        // TODO: $student = AcademyStudent::findOrFail($id)->close($request->close_type, $request->close_reason, auth()->id());
        //       NOTE: Does NOT touch Employment or Consultancy profile.

        return redirect()->route('academy.students.index')
            ->with('success', 'Student case closed. All records are preserved.');
    }
}
