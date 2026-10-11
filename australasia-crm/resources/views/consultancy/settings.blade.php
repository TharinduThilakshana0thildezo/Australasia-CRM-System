<x-layouts.app title="Settings — Consultancy">

<x-page-header
    title="Consultancy Settings"
    subtitle="Configure business rules, fee structures, and workflow parameters"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Settings']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-warning mb-5">
    <i data-lucide="alert-triangle" style="width:20px;height:20px;flex-shrink:0"></i>
    <div>
        <strong>Pending Business Rule Confirmations</strong><br>
        <span class="text-sm">The following rules are flagged as "to be confirmed" in the consultancy workflow. They are configurable below and default to safe/conservative values until confirmed by management.</span>
    </div>
</div>

<form method="POST" action="{{ route('consultancy.settings.save') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">

        {{-- Registration Fee --}}
        <div class="card border-amber-200">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Registration Fee</h3>
                    <p class="text-xs text-amber-600 font-semibold mt-0.5">⚠ PENDING MANAGEMENT CONFIRMATION</p>
                </div>
                <span class="badge badge-pending">To Be Confirmed</span>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label" for="reg_fee_amount">Registration Fee Amount (LKR)</label>
                        <input id="reg_fee_amount" name="reg_fee_amount" type="number" min="0" class="form-input" value="25000" placeholder="0">
                        <p class="form-hint">Amount collected from new students upon registration.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="reg_fee_currency">Currency</label>
                        <select id="reg_fee_currency" name="reg_fee_currency" class="form-select">
                            <option value="LKR" selected>LKR (Sri Lankan Rupee)</option>
                            <option value="USD">USD</option>
                            <option value="AUD">AUD</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Refund Policy --}}
        <div class="card border-amber-200">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Registration Fee Refund Policy</h3>
                    <p class="text-xs text-amber-600 font-semibold mt-0.5">⚠ PENDING MANAGEMENT CONFIRMATION</p>
                </div>
                <span class="badge badge-pending">To Be Confirmed</span>
            </div>
            <div class="card-body">
                <div class="form-group mb-4">
                    <label class="form-label">Refund Policy</label>
                    <select name="refund_policy" class="form-select">
                        <option value="non_refundable" selected>Non-Refundable (current default)</option>
                        <option value="fully_refundable">Fully Refundable on Case Closure</option>
                        <option value="partial">Partial Refund (specify percentage below)</option>
                        <option value="conditional">Conditional — Refundable only if visa rejected</option>
                        <option value="director_approval">Director Approval Required per Case</option>
                    </select>
                    <p class="form-hint">This is currently set to NON-REFUNDABLE as a safe default. Confirm with management before changing.</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Refund Percentage (if Partial)</label>
                    <input name="refund_percentage" type="number" min="0" max="100" class="form-input" value="0" placeholder="0–100">
                </div>
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                    <strong>Important:</strong> Any change to this setting must be authorized by the director/owner before being applied to active cases. Changes do not retroactively affect existing records.
                </div>
            </div>
        </div>

        {{-- Workflow Settings --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Workflow Configuration</h3></div>
            <div class="card-body space-y-4">
                <div class="flex items-start justify-between gap-4 py-3 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Require Study Plan Agreement Before Applications</p>
                        <p class="text-xs text-slate-500 mt-0.5">Consultants cannot create applications unless a counselling session with plan agreement has been recorded.</p>
                    </div>
                    <label class="flex items-center gap-2 flex-shrink-0">
                        <input type="checkbox" name="require_study_plan" value="1" checked class="form-input" style="width:18px;height:18px;padding:0">
                        <span class="text-sm font-medium text-slate-700">Enforced</span>
                    </label>
                </div>
                <div class="flex items-start justify-between gap-4 py-3 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Block Applications Until Registration Fee Is Paid</p>
                        <p class="text-xs text-slate-500 mt-0.5">Students with unpaid registration fees cannot have applications submitted.</p>
                    </div>
                    <label class="flex items-center gap-2 flex-shrink-0">
                        <input type="checkbox" name="block_on_unpaid_fee" value="1" checked class="form-input" style="width:18px;height:18px;padding:0">
                        <span class="text-sm font-medium text-slate-700">Enforced</span>
                    </label>
                </div>
                <div class="flex items-start justify-between gap-4 py-3 border-b border-slate-100">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Allow Enrollment Override</p>
                        <p class="text-xs text-slate-500 mt-0.5">Authorized consultants can override incomplete registration checklists with a mandatory reason.</p>
                    </div>
                    <label class="flex items-center gap-2 flex-shrink-0">
                        <input type="checkbox" name="allow_enrollment_override" value="1" checked class="form-input" style="width:18px;height:18px;padding:0">
                        <span class="text-sm font-medium text-slate-700">Allowed</span>
                    </label>
                </div>
                <div class="flex items-start justify-between gap-4 py-3">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Registration Link Expiry Default (days)</p>
                        <p class="text-xs text-slate-500 mt-0.5">Default expiry for self-registration links sent to leads.</p>
                    </div>
                    <input name="link_default_expiry" type="number" min="1" max="30" class="form-input" style="width:80px" value="7">
                </div>
            </div>
        </div>

        {{-- Notification Settings --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Notification Preferences</h3></div>
            <div class="card-body space-y-3">
                @foreach([
                    ['notify_reg_fee_overdue','Registration fee overdue (>3 days)','checked'],
                    ['notify_doc_correction','Document correction requested','checked'],
                    ['notify_offer_deadline','Offer acceptance deadline <7 days','checked'],
                    ['notify_visa_decision','Visa decision received','checked'],
                    ['notify_enrollment_due','Enrollment confirmation due','checked'],
                ] as $n)
                <label class="flex items-center gap-3 text-sm cursor-pointer">
                    <input type="checkbox" name="{{ $n[0] }}" value="1" {{ $n[2] }} class="form-input" style="width:16px;height:16px;padding:0">
                    <span class="text-slate-700">{{ $n[1] }}</span>
                </label>
                @endforeach
            </div>
        </div>

    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full">
                    <i data-lucide="save" style="width:16px;height:16px"></i>Save Settings
                </button>
                <a href="{{ route('consultancy.dashboard') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Pending Confirmations</h3></div>
            <div class="card-body space-y-2">
                <div class="flex items-center gap-2 text-sm text-amber-700 bg-amber-50 p-2 rounded-lg">
                    <i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>
                    Registration fee amount
                </div>
                <div class="flex items-center gap-2 text-sm text-amber-700 bg-amber-50 p-2 rounded-lg">
                    <i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>
                    Refund policy on case closure
                </div>
                <p class="text-xs text-slate-400 mt-2">These items are flagged from the consultancy workflow design. They require management sign-off before being applied operationally.</p>
            </div>
        </div>
    </div>
</div>
</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
