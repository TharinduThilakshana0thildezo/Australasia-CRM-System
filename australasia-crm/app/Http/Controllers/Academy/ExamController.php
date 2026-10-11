<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * ExamController — Exam scheduling, marks entry, threshold blocking, publishing, and re-sits.
 *
 * Business rule: Before allowing marks entry for a student, their attendance %
 * must be checked against the AcademySetting `attendance_threshold`.
 * Below-threshold students require authorized override.
 */
class ExamController extends Controller
{
    public function index()
    {
        // TODO: $exams = AcademyExam::with(['batch.course'])->latest()->get();
        return view('academy.exams.index');
    }

    public function create()
    {
        return view('academy.exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'course_id'   => 'required|string',
            'batch_id'    => 'required|string',
            'exam_type'   => 'required|in:written,practical,oral,mcq,project',
            'exam_date'   => 'required|date',
            'max_marks'   => 'required|integer|min:1',
            'pass_marks'  => 'required|integer|min:0|lte:max_marks',
            'assessor'    => 'nullable|string',
        ]);

        // TODO: AcademyExam::create([...]);
        return redirect()->route('academy.exams.index')
            ->with('success', 'Exam scheduled successfully.');
    }

    public function show(int $id)
    {
        // TODO: $exam = AcademyExam::with(['results.student'])->findOrFail($id);
        return view('academy.exams.show');
    }

    public function marks(int $id)
    {
        // TODO: $exam = AcademyExam::with(['batch.students'])->findOrFail($id);
        //       foreach ($exam->batch->students as $student) {
        //           $student->attendance_pct = ...calculate...;
        //           $student->is_eligible = ($student->attendance_pct >= $threshold);
        //       }
        return view('academy.exams.marks');
    }

    public function marksStore(Request $request, int $id)
    {
        $request->validate([
            'marks'              => 'required|array',
            'marks.*.student_id' => 'required|integer',
            'marks.*.obtained'   => 'required|numeric|min:0|max:1000',
        ]);

        // TODO: Validate that no marks are entered for below-threshold students
        //       unless override is present.
        //       Save marks as DRAFT.
        //       AcademyExamResult::updateOrCreate(...)
        //       AcademyExam::findOrFail($id)->update(['status' => 'marks_pending']);

        return redirect()->route('academy.exams.show', $id)
            ->with('success', 'Marks saved as Draft. Review and Publish to finalize.');
    }

    public function publish(Request $request, int $id)
    {
        // TODO: AcademyExam::findOrFail($id)->update(['status' => 'completed', 'published_at' => now(), 'published_by' => auth()->id()]);
        //       Update result outcomes based on pass_marks.
        //       Passed students become eligible for certificate.
        return redirect()->route('academy.exams.show', $id)
            ->with('success', 'Exam results published. Passed students are now eligible for certificates.');
    }

    public function resitSchedule(Request $request, int $id)
    {
        $request->validate([
            'student_id'   => 'required|integer',
            'resit_date'   => 'required|date',
            'resit_reason' => 'nullable|string',
        ]);

        // TODO: AcademyExamResult::createReSitRecord([...]);
        //       Preserve the old failure record for audit.

        return back()->with('success', 'Re-sit scheduled. Old failure record is preserved.');
    }
}
