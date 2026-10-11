<?php

namespace App\Http\Controllers\Academy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * AcademyController — Academy module dashboard & cross-cutting actions.
 *
 * Serves the main Academy dashboard and any cross-module actions that don't
 * belong to a specific sub-entity (courses, batches, students, etc.).
 */
class AcademyController extends Controller
{
    /**
     * Display the Academy dashboard.
     * Injects summary KPIs, running batches, upcoming exams, and recent certificates.
     */
    public function dashboard()
    {
        // TODO: Replace stub data with real Eloquent queries when models are ready.
        return view('academy.dashboard');
    }

    /**
     * Display the Academy analytics / reports page.
     */
    public function reports(Request $request)
    {
        // TODO: Accept filter params (report_type, period, date_from, date_to, course_id)
        //       and aggregate stats accordingly.
        return view('academy.reports');
    }

    /**
     * Display the Academy settings form.
     */
    public function settings()
    {
        // TODO: Load settings from DB (e.g. AcademySetting model or config table).
        return view('academy.settings');
    }

    /**
     * Persist updated Academy settings.
     */
    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'attendance_threshold'   => 'required|integer|min:0|max:100',
            'seat_hold_days'         => 'nullable|integer|min:0|max:60',
            'withdrawal_fee_policy'  => 'required|in:manual,no_refund,partial_refund,full_refund',
            'partial_refund_pct'     => 'nullable|integer|min:0|max:100',
            'cert_prefix'            => 'nullable|string|max:12',
            'link_default_expiry'    => 'nullable|integer|min:1|max:365',
        ]);

        // TODO: Persist to AcademySetting model or config table.
        // AcademySetting::updateOrCreate([], $request->only([...]));

        return redirect()->route('academy.settings')
            ->with('success', 'Academy settings saved successfully.');
    }
}
