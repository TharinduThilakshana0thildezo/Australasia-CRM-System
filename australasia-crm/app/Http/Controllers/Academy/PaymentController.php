<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * PaymentController — Record course fee payments.
 * Rule: Financial records cannot be deleted.
 */
class PaymentController extends Controller
{
    public function index()
    {
        // TODO: $payments = AcademyPayment::with('student','course')->latest()->paginate(50);
        return view('academy.payments.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'course_id'  => 'required|integer', // Which enrollment does this pay for?
            'amount'     => 'required|numeric|min:0.01',
            'currency'   => 'required|in:LKR,USD',
            'method'     => 'required|string',
            'paid_on'    => 'required|date',
            'reference'  => 'nullable|string|max:100',
        ]);

        // TODO: AcademyPayment::create([...]);
        //       Update AcademyEnrollment fee_status to 'Paid' if fully paid.
        
        return back()->with('success', 'Payment recorded successfully. Ledger updated.');
    }
}
