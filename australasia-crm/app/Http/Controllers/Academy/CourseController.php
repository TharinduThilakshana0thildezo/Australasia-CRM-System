<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * CourseController — CRUD + lifecycle (pause / resume / archive) for Academy courses.
 */
class CourseController extends Controller
{
    public function index()
    {
        // TODO: $courses = AcademyCourse::withCount(['batches','students'])->latest()->get();
        return view('academy.courses.index');
    }

    public function create()
    {
        return view('academy.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'code'        => 'required|string|max:20|unique:academy_courses,code',
            'course_type' => 'required|in:pre_departure,language,skills,it,hospitality,other',
            'duration'    => 'required|string|max:100',
            'capacity'    => 'required|integer|min:1',
            'fee'         => 'required|numeric|min:0',
            'currency'    => 'required|in:LKR,USD',
        ]);

        // TODO: AcademyCourse::create($request->only([...]));
        return redirect()->route('academy.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(int $id)
    {
        // TODO: $course = AcademyCourse::with(['batches','students'])->findOrFail($id);
        return view('academy.courses.show');
    }

    public function edit(int $id)
    {
        // TODO: $course = AcademyCourse::findOrFail($id);
        return view('academy.courses.edit');
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'fee'      => 'required|numeric|min:0',
            'currency' => 'required|in:LKR,USD',
            'capacity' => 'required|integer|min:1',
        ]);

        // TODO: AcademyCourse::findOrFail($id)->update($request->only([...]));
        return redirect()->route('academy.courses.show', $id)
            ->with('success', 'Course updated successfully.');
    }

    public function pause(Request $request, int $id)
    {
        $request->validate([
            'pause_reason' => 'required|string|min:10',
        ]);

        // TODO: AcademyCourse::findOrFail($id)->pause($request->pause_reason, auth()->id());
        return redirect()->route('academy.courses.show', $id)
            ->with('success', 'Course paused. Existing batches continue unaffected.');
    }

    public function resume(int $id)
    {
        // TODO: AcademyCourse::findOrFail($id)->resume(auth()->id());
        return redirect()->route('academy.courses.show', $id)
            ->with('success', 'Course resumed. New enrollments are now open.');
    }

    public function archive(Request $request, int $id)
    {
        $request->validate([
            'archive_reason' => 'required|string|min:10',
        ]);

        // TODO: AcademyCourse::findOrFail($id)->archive($request->archive_reason, auth()->id());
        return redirect()->route('academy.courses.index')
            ->with('success', 'Course archived. All historical data is preserved.');
    }
}
