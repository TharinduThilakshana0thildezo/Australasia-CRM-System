<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationLinkController extends Controller
{
    public function index()
    {
        return view('academy.registration-links.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'  => 'required|string',
            'expires_at' => 'required|date|after:today',
            'max_uses'   => 'nullable|integer|min:1',
            'notes'      => 'nullable|string',
        ]);

        // TODO: Generate unique string ID 'LINK-ACD-...'
        //       AcademyRegistrationLink::create([...]);
        return back()->with('success', 'Registration link generated.');
    }

    public function deactivate(int $id)
    {
        // TODO: AcademyRegistrationLink::findOrFail($id)->update(['status' => 'deactivated']);
        return back()->with('success', 'Link deactivated. It will no longer accept submissions.');
    }

    public function applications(int $id)
    {
        // TODO: $link = AcademyRegistrationLink::findOrFail($id);
        //       $applications = AcademyStudentApplication::where('link_id', $id)->get();
        // NOTE: View for this is currently rendered inline in the index or can be a separate list.
        return back()->with('info', 'Applications list view to be implemented.');
    }

    public function reject(Request $request, int $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|min:10',
        ]);

        // TODO: AcademyStudentApplication::findOrFail($id)->update(['status' => 'rejected', 'reject_reason' => $request->reject_reason]);
        return back()->with('success', 'Application rejected.');
    }
}
