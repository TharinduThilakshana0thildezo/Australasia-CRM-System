<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * CertificateController — Issuing, voiding, and reissuing certificates.
 *
 * Rule: Certificates can only be issued if enrollment is completed
 * (fees paid, attendance met, exam passed).
 */
class CertificateController extends Controller
{
    public function index()
    {
        // TODO: $readyQueue = AcademyEnrollment::readyForCertificate()->get();
        //       $certificates = AcademyCertificate::with(['student','course'])->latest()->get();
        return view('academy.certificates.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|integer',
            'issue_date'    => 'required|date',
            'issued_by'     => 'required|string',
        ]);

        // TODO: Verify enrollment meets all criteria.
        //       Generate Certificate ID using AcademySetting `cert_prefix`.
        //       AcademyCertificate::create([...]);

        return redirect()->route('academy.certificates.index')
            ->with('success', 'Certificate issued successfully.');
    }

    public function void(Request $request, int $id)
    {
        $request->validate([
            'void_reason' => 'required|string|min:10',
        ]);

        // TODO: AcademyCertificate::findOrFail($id)->update(['status' => 'voided', 'void_reason' => $request->void_reason, 'voided_at' => now(), 'voided_by' => auth()->id()]);
        return back()->with('success', 'Certificate voided. Original record is preserved in audit logs.');
    }

    public function reissue(Request $request, int $id)
    {
        $request->validate([
            'reissue_reason' => 'required|string|min:10',
        ]);

        // TODO: 1. Void old certificate with reason.
        //       2. Generate new certificate number.
        //       3. Insert new certificate record linking to the old one.
        return back()->with('success', 'Certificate reissued. Previous certificate has been voided.');
    }
}
