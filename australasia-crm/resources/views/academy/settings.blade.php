<x-layouts.app title="Settings — Academy">

<x-page-header
    title="Academy Settings"
    subtitle="Configure workflow thresholds, policies, and system behaviour"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Settings']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-warning mb-5">
    <i data-lucide="alert-triangle" style="width:20px;height:20px;flex-shrink:0"></i>
    <div>
        <strong>Owner / Director Action Required</strong>
        <p class="text-sm mt-1">The following settings are marked as <em>"to be confirmed"</em> by management. All thresholds below are <strong>configurable and not hard-coded</strong>. Review and update each policy before going live.</p>
    </div>
</div>

<form method="POST" action="{{ route('academy.settings.save') }}">
@csrf

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    {{-- Attendance Policy --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Attendance Eligibility Threshold</h3>
                <p class="text-xs text-slate-400 mt-0.5">Minimum attendance % required to sit an exam</p>
            </div>
            <span class="badge badge-pending text-xs">Pending Confirmation</span>
        </div>
        <div class="card-body space-y-4">
            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                ⚠ This setting controls whether a student is flagged as ineligible when entering exam marks. Students below this threshold will be blocked unless an authorized override is applied.
            </div>
            <div class="form-group">
                <label class="form-label required" for="attendance_threshold">Minimum Attendance %</label>
                <div class="flex items-center gap-3">
                    <input id="attendance_threshold" name="attendance_threshold" type="number" min="0" max="100" step="1" class="form-input" style="width:100px" value="75" required>
                    <span class="text-sm text-slate-500">% (default: 75%)</span>
                </div>
                <p class="form-hint">Recommended: 75% – 80%. Must be confirmed by director.</p>
            </div>
            <div class="form-group">
                <label class="form-label">Allow Override?</label>
                <div class="flex gap-4 mt-1">
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="attendance_override_allowed" value="1" checked class="form-radio"><span class="text-sm">Yes — require written reason + director authorization</span></label>
                    <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="attendance_override_allowed" value="0" class="form-radio"><span class="text-sm">No — strict block (no override permitted)</span></label>
                </div>
            </div>
        </div>
    </div>

    {{-- Unpaid Enrollment Seat Policy --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Unpaid Enrollment Seat Policy</h3>
                <p class="text-xs text-slate-400 mt-0.5">How long a seat is held for an unpaid enrollment</p>
            </div>
            <span class="badge badge-pending text-xs">Pending Confirmation</span>
        </div>
        <div class="card-body space-y-4">
            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                ⚠ After a student is enrolled, how long should a seat be held before releasing it to waitlisted students if no payment is received?
            </div>
            <div class="form-group">
                <label class="form-label required" for="seat_hold_days">Seat Hold Period (days)</label>
                <div class="flex items-center gap-3">
                    <input id="seat_hold_days" name="seat_hold_days" type="number" min="0" max="60" step="1" class="form-input" style="width:100px" value="7">
                    <span class="text-sm text-slate-500">days (0 = no hold)</span>
                </div>
                <p class="form-hint">After this period, seat is automatically flagged for release (staff confirm release). Must be confirmed by director.</p>
            </div>
            <div class="form-group">
                <label class="form-label">Auto-Notify Student?</label>
                <div class="flex items-center gap-2 mt-1">
                    <input type="checkbox" name="notify_unpaid" id="notify_unpaid" class="form-checkbox" checked>
                    <label for="notify_unpaid" class="text-sm">Send notification to handler when seat hold period is about to expire</label>
                </div>
            </div>
        </div>
    </div>

    {{-- Fee Refund / Retention on Withdrawal --}}
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Fee Treatment on Withdrawal</h3>
                <p class="text-xs text-slate-400 mt-0.5">Refund or retention policy when a student withdraws</p>
            </div>
            <span class="badge badge-pending text-xs">Pending Confirmation</span>
        </div>
        <div class="card-body space-y-4">
            <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
                ⚠ What happens to the paid course fee when a student withdraws? All fees are recorded permanently regardless of this setting.
            </div>
            <div class="form-group">
                <label class="form-label required">Default Fee Policy</label>
                <select name="withdrawal_fee_policy" class="form-select" required>
                    <option value="manual">Manual — Director reviews each case individually</option>
                    <option value="no_refund">No refund — Full fee retained</option>
                    <option value="partial_refund">Partial refund — Configurable %</option>
                    <option value="full_refund">Full refund — if before batch start</option>
                </select>
                <p class="form-hint">Recommendation: <strong>Manual</strong> — each case varies. Must be confirmed by director.</p>
            </div>
            <div class="form-group">
                <label class="form-label" for="partial_refund_pct">Partial Refund % (if applicable)</label>
                <div class="flex items-center gap-3">
                    <input id="partial_refund_pct" name="partial_refund_pct" type="number" min="0" max="100" class="form-input" style="width:100px" value="50">
                    <span class="text-sm text-slate-500">% refunded</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Certificate Numbering --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Certificate Numbering</h3><p class="text-xs text-slate-400 mt-0.5">Auto-generated certificate ID format</p></div>
        <div class="card-body space-y-4">
            <div class="form-group">
                <label class="form-label" for="cert_prefix">Certificate ID Prefix</label>
                <input id="cert_prefix" name="cert_prefix" type="text" class="form-input" value="CERT-ACD" maxlength="12">
                <p class="form-hint">e.g. CERT-ACD → CERT-ACD-A8F2 (auto-appended unique code)</p>
            </div>
        </div>
    </div>

    {{-- Handler Assignment --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Default Handler Assignment</h3></div>
        <div class="card-body space-y-4">
            <div class="form-group">
                <label class="form-label" for="default_handler">Default Handler for New Students</label>
                <select id="default_handler" name="default_handler_id" class="form-select">
                    <option value="">None — must be manually assigned</option>
                    <option value="kasun">Kasun Bandara</option>
                    <option value="nimal">Nimal Jayawardena</option>
                    <option value="priya">Priya Hewage</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Registration Link Settings --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Registration Link Defaults</h3></div>
        <div class="card-body space-y-4">
            <div class="form-group">
                <label class="form-label" for="link_default_expiry">Default Link Expiry (days)</label>
                <input id="link_default_expiry" name="link_default_expiry" type="number" min="1" max="365" class="form-input" style="width:100px" value="14">
            </div>
            <div class="form-group">
                <label class="form-label">Require Staff Approval?</label>
                <div class="flex items-center gap-2 mt-1">
                    <input type="checkbox" name="link_require_approval" id="link_require_approval" class="form-checkbox" checked>
                    <label for="link_require_approval" class="text-sm">Yes — self-registrations go into a pending queue for staff review before student profile is created</label>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="flex gap-3 mt-6">
    <button type="submit" class="btn btn-primary">
        <i data-lucide="save" style="width:16px;height:16px"></i>Save Settings
    </button>
    <a href="{{ route('academy.dashboard') }}" class="btn btn-ghost">Cancel</a>
</div>

</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
