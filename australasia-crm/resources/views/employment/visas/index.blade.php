<x-layouts.app title="Visa Processing — Foreign Employment">

<x-page-header
    title="Visa Processing"
    subtitle="Track all active visa applications and their status"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Visa Processing']]">
    <x-slot:actions>
        <a href="{{ route('employment.visas.export') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i> Export
        </a>
        <button onclick="openModal('visa-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Visa Application
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-5">
    <i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div>{{ session('success') }}</div>
</div>
@endif

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
    <x-stat-card value="67"  label="Total Active"       icon="shield" color="indigo" />
    <x-stat-card value="31"  label="Preparing"          icon="file-text" color="amber" />
    <x-stat-card value="24"  label="Submitted"          icon="send" color="violet" />
    <x-stat-card value="8"   label="Processing"         icon="loader" color="cyan" />
    <x-stat-card value="4"   label="Visa Delays"        icon="clock" color="rose" />
    <x-stat-card value="203" label="Approved (Total)"   icon="shield-check" color="emerald" />
</div>

<!-- Delay Alert -->
<div class="alert alert-danger mb-5">
    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="flex-1">
        <p class="font-bold">4 visa applications have exceeded the allowed processing timeframe</p>
        <p class="text-sm mt-0.5">These cases may be eligible for refund review. Immediate action required.</p>
    </div>
    <a href="#overdue" class="btn btn-danger btn-sm flex-shrink-0">View Delayed Cases</a>
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input id="visa-search" type="text" class="search-input" placeholder="Search candidate, application, reference…">
            </div>
            <select id="visa-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="submitted">Submitted</option>
                <option value="processing">Processing</option>
                <option value="visa_processing">Overdue</option>
                <option value="visa_approved">Approved</option>
                <option value="refund">Refund</option>
            </select>
            <select id="visa-country" class="form-select" style="width:auto">
                <option value="">All Countries</option>
                <option value="australia">Australia</option>
                <option value="uae">UAE</option>
                <option value="qatar">Qatar</option>
                <option value="kuwait">Kuwait</option>
                <option value="saudi">Saudi Arabia</option>
            </select>
            <select id="visa-staff" class="form-select" style="width:auto">
                <option value="">All Staff</option>
                <option value="nimal">Nimal Jayawardena</option>
                <option value="priya">Priya Hewage</option>
            </select>
            <button id="visa-clear" class="btn btn-ghost btn-sm">
                <i data-lucide="x" style="width:14px;height:14px"></i> Clear
            </button>
        </div>
    </div>
</div>

<!-- Visa Table -->
<div class="card" id="overdue">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Visa ID</th>
                    <th>Candidate</th>
                    <th>Country / Type</th>
                    <th>Application</th>
                    <th>Submitted</th>
                    <th>Deadline</th>
                    <th>Days Elapsed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $visas = [
                    ['visa_id' => 'VSA-00291', 'candidate' => 'Nadeeka Silva',       'cid' => 'CAND-1296', 'country' => 'Australia', 'type' => '482 Work',  'app' => 'APP-0849', 'submitted' => '01 Oct 2026', 'deadline' => '30 Nov 2026', 'days' => 5,  'status' => 'submitted',       'overdue' => false],
                    ['visa_id' => 'VSA-00290', 'candidate' => 'Chamari Dias',        'cid' => 'CAND-1292', 'country' => 'UAE',       'type' => 'Work',      'app' => 'APP-0847', 'submitted' => '28 Sep 2026', 'deadline' => '28 Oct 2026', 'days' => 8,  'status' => 'processing',      'overdue' => false],
                    ['visa_id' => 'VSA-00289', 'candidate' => 'Indika Chandrasena',  'cid' => 'CAND-1289', 'country' => 'Qatar',     'type' => 'Work',      'app' => 'APP-0845', 'submitted' => '10 Sep 2026', 'deadline' => '10 Oct 2026', 'days' => 26, 'status' => 'visa_processing', 'overdue' => true],
                    ['visa_id' => 'VSA-00287', 'candidate' => 'Malith Perera',       'cid' => 'CAND-1281', 'country' => 'Kuwait',    'type' => 'Work',      'app' => 'APP-0841', 'submitted' => '01 Sep 2026', 'deadline' => '01 Oct 2026', 'days' => 35, 'status' => 'visa_processing', 'overdue' => true],
                    ['visa_id' => 'VSA-00284', 'candidate' => 'Kavindu Perera',      'cid' => 'CAND-1297', 'country' => 'Australia', 'type' => '482 Work',  'app' => 'APP-0842', 'submitted' => '05 Oct 2026', 'deadline' => '04 Dec 2026', 'days' => 1,  'status' => 'visa_approved',   'overdue' => false],
                    ['visa_id' => 'VSA-00279', 'candidate' => 'Ruwan Pathirana',     'cid' => 'CAND-1293', 'country' => 'Saudi Arabia','type' => 'Iqama',   'app' => 'APP-0836', 'submitted' => '15 Aug 2026', 'deadline' => '15 Sep 2026', 'days' => 51, 'status' => 'refund',          'overdue' => true],
                ];
                @endphp

                @foreach($visas as $v)
                <tr class="visa-row {{ $v['overdue'] ? 'bg-rose-50' : '' }}" data-status="{{ $v['status'] }}" data-country="{{ strtolower($v['country']) }}">
                    <td>
                        <a href="{{ route('employment.visas.show', 1) }}"
                           class="font-mono font-semibold text-indigo-600 hover:underline">
                            {{ $v['visa_id'] }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($v['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $v['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $v['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">{{ $v['country'] }}</div>
                        <div class="text-xs text-slate-500">{{ $v['type'] }}</div>
                    </td>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}"
                           class="text-sm text-indigo-600 font-mono hover:underline">
                            {{ $v['app'] }}
                        </a>
                    </td>
                    <td class="text-sm text-slate-600">{{ $v['submitted'] }}</td>
                    <td class="text-sm {{ $v['overdue'] ? 'text-rose-600 font-bold' : 'text-slate-600' }}">
                        {{ $v['deadline'] }}
                    </td>
                    <td>
                        <span class="text-sm font-bold {{ $v['overdue'] ? 'text-rose-600' : 'text-slate-700' }}">
                            {{ $v['days'] }} days
                            @if($v['overdue'])
                            <span class="text-xs font-normal text-rose-500 block">EXCEEDED</span>
                            @endif
                        </span>
                    </td>
                    <td><x-status-badge :status="$v['status']" /></td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.visas.show', 1) }}" class="btn btn-ghost btn-xs" title="View">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            <button onclick="openModal('update-visa-modal')" class="btn btn-ghost btn-xs" title="Update Status">
                                <i data-lucide="edit-3" style="width:13px;height:13px"></i>
                            </button>
                            @if($v['overdue'])
                            <a href="{{ route('employment.refunds.create') }}"
                               class="btn btn-danger btn-xs" title="Review refund eligibility">
                                <i data-lucide="rotate-ccw" style="width:13px;height:13px"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–6 of 67 active visa applications</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Previous</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<!-- ====== NEW VISA APPLICATION MODAL ====== -->
<div id="visa-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal('visa-modal')">
    <div class="modal-box" style="max-width:600px;width:100%">
        <div class="modal-header">
            <h3 class="modal-title">New Visa Application</h3>
            <button onclick="closeModal('visa-modal')" class="modal-close"><i data-lucide="x" style="width:18px;height:18px"></i></button>
        </div>
        <form action="{{ route('employment.visas.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="modal-label">Candidate Name</label>
                        <input type="text" name="candidate_name" class="form-input" placeholder="e.g. Kavindu Perera" required>
                    </div>
                    <div>
                        <label class="modal-label">Candidate ID</label>
                        <input type="text" name="candidate_id" class="form-input" placeholder="CAND-XXXX">
                    </div>
                    <div>
                        <label class="modal-label">Destination Country</label>
                        <select name="country" class="form-select" required>
                            <option value="">Select Country</option>
                            <option>Australia</option><option>UAE</option><option>Qatar</option>
                            <option>Kuwait</option><option>Saudi Arabia</option><option>Malaysia</option>
                        </select>
                    </div>
                    <div>
                        <label class="modal-label">Visa Type</label>
                        <select name="visa_type" class="form-select" required>
                            <option value="">Select Type</option>
                            <option>482 Work (Australia)</option><option>Work Permit</option>
                            <option>Iqama (Saudi)</option><option>Employment Visa</option>
                            <option>Temporary Skill Shortage</option>
                        </select>
                    </div>
                    <div>
                        <label class="modal-label">Application Reference</label>
                        <input type="text" name="application_ref" class="form-input" placeholder="APP-XXXX">
                    </div>
                    <div>
                        <label class="modal-label">Submission Date</label>
                        <input type="date" name="submission_date" class="form-input" value="{{ date('Y-m-d') }}">
                    </div>
                    <div>
                        <label class="modal-label">Expected Deadline</label>
                        <input type="date" name="deadline" class="form-input">
                    </div>
                    <div>
                        <label class="modal-label">Assigned Officer</label>
                        <select name="officer" class="form-select">
                            <option>Nimal Jayawardena</option>
                            <option>Priya Hewage</option>
                            <option>Kasun Bandara</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="modal-label">Notes</label>
                        <textarea name="notes" class="form-input" rows="2" placeholder="Any special instructions or notes…"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('visa-modal')" class="btn btn-ghost btn-sm">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" style="width:14px;height:14px"></i> Create Application
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Update Status Modal -->
<div id="update-visa-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal('update-visa-modal')">
    <div class="modal-box" style="max-width:440px;width:100%">
        <div class="modal-header">
            <h3 class="modal-title">Update Visa Status</h3>
            <button onclick="closeModal('update-visa-modal')" class="modal-close"><i data-lucide="x" style="width:18px;height:18px"></i></button>
        </div>
        <div class="modal-body">
            <div class="mb-4">
                <label class="modal-label">New Status</label>
                <select class="form-select">
                    <option>Preparing</option><option>Submitted</option><option>Processing</option>
                    <option>Additional Docs Required</option><option>Approved</option><option>Rejected</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="modal-label">Reference / Note</label>
                <input type="text" class="form-input" placeholder="Embassy reference or note…">
            </div>
            <div>
                <label class="modal-label">Date</label>
                <input type="date" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('update-visa-modal')" class="btn btn-ghost btn-sm">Cancel</button>
            <button onclick="closeModal('update-visa-modal');showToast('Visa status updated successfully!','success')" class="btn btn-primary btn-sm">Update Status</button>
        </div>
    </div>
</div>

<style>
.modal-overlay { position:fixed;inset:0;background:rgba(0,0,0,0.45);backdrop-filter:blur(4px);z-index:999;display:flex;align-items:center;justify-content:center;padding:20px; }
.modal-box { background:white;border-radius:20px;box-shadow:0 24px 64px rgba(0,0,0,0.18);width:100%;animation:modal-in 0.25s ease; }
@keyframes modal-in { from{opacity:0;transform:scale(0.95) translateY(10px);} to{opacity:1;transform:scale(1) translateY(0);} }
.modal-header { display:flex;align-items:center;justify-content:space-between;padding:20px 24px 0; }
.modal-title { font-size:17px;font-weight:700;color:#0f172a; }
.modal-close { width:32px;height:32px;border-radius:8px;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#64748b; }
.modal-close:hover { background:#e2e8f0; }
.modal-body { padding:20px 24px; }
.modal-footer { display:flex;justify-content:flex-end;gap:8px;padding:16px 24px 20px;border-top:1px solid #f1f5f9; }
.modal-label { display:block;font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:0.6px;margin-bottom:6px; }
.alert-success { background:#f0fdf4;border:1.5px solid #86efac;color:#166534;padding:14px 16px;border-radius:12px;font-size:14px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-weight:500; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // Filter logic
    const s = document.getElementById('visa-search');
    const st = document.getElementById('visa-status');
    const c = document.getElementById('visa-country');
    const cl = document.getElementById('visa-clear');
    const rows = document.querySelectorAll('tr.visa-row');

    function filter() {
        const q = (s?.value||'').toLowerCase();
        const status = (st?.value||'').toLowerCase();
        const country = (c?.value||'').toLowerCase();
        rows.forEach(r => {
            const txt = r.textContent.toLowerCase();
            const ok = (!q||txt.includes(q)) && (!status||r.dataset.status===status) && (!country||r.dataset.country.includes(country));
            r.style.display = ok ? '' : 'none';
        });
    }
    s?.addEventListener('input', filter);
    st?.addEventListener('change', filter);
    c?.addEventListener('change', filter);
    cl?.addEventListener('click', () => { if(s)s.value=''; if(st)st.value=''; if(c)c.value=''; filter(); });
});

function openModal(id) {
    document.getElementById(id).style.display = 'flex';
    document.body.style.overflow = 'hidden';
    lucide.createIcons();
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
    document.body.style.overflow = '';
}
function showToast(message, type) {
    const colors = { success:'#10b981', error:'#ef4444', info:'#6366f1', warning:'#f59e0b' };
    const c = document.getElementById('toast-container');
    if (!c) return;
    const t = document.createElement('div');
    t.style.cssText = 'background:white;border-left:4px solid '+colors[type||'success']+';border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,0.12);padding:12px 16px;display:flex;align-items:center;gap:10px;min-width:280px;font-size:14px;font-weight:500;color:#1e293b;margin-bottom:8px;';
    t.innerHTML = '<span style="color:'+colors[type||'success']+'">&#10003;</span> '+message;
    c.appendChild(t);
    setTimeout(()=>{ t.style.transition='opacity 0.3s'; t.style.opacity='0'; setTimeout(()=>t.remove(),300); },3000);
}
document.addEventListener('keydown', e => { if(e.key==='Escape') { document.querySelectorAll('.modal-overlay').forEach(m=>{ m.style.display='none'; }); document.body.style.overflow=''; } });
</script>

</x-layouts.app>
