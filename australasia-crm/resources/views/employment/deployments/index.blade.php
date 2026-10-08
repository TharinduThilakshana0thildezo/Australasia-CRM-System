<x-layouts.app title="Deployments — Foreign Employment">

<x-page-header
    title="Deployments"
    subtitle="Flight bookings, pre-departure briefings and dispatch management"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Deployments']]">
    <x-slot:actions>
        <a href="{{ route('employment.deployments.export') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i> Export
        </a>
        <button onclick="openModal('dep-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plane" style="width:14px;height:14px"></i>
            Schedule Deployment
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
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="18" label="Scheduled"          icon="calendar"     color="indigo" />
    <x-stat-card value="5"  label="This Month"         icon="plane"        color="violet" />
    <x-stat-card value="3"  label="Departing This Week" icon="zap"         color="amber" />
    <x-stat-card value="11" label="Deployed (Oct)"     icon="check-circle" color="emerald" />
    <x-stat-card value="203" label="Total Deployed"    icon="globe"        color="teal" />
</div>

<!-- Upcoming Alert -->
<div class="alert alert-info mb-5">
    <i data-lucide="calendar-check" style="width:18px;height:18px;flex-shrink:0"></i>
    <div>
        <p class="font-bold">3 candidates departing within the next 7 days</p>
        <p class="text-sm mt-0.5">Ensure briefing, flight, and final document checks are complete before departure.</p>
    </div>
</div>

<!-- Deployments Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Deployment Schedule</h3>
        <div class="flex gap-2" id="dep-pills">
            <button class="filter-pill active" data-dep-filter="all">All</button>
            <button class="filter-pill" data-dep-filter="upcoming">Upcoming</button>
            <button class="filter-pill" data-dep-filter="thismonth">This Month</button>
            <button class="filter-pill" data-dep-filter="departed">Departed</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Deployment ID</th>
                    <th>Candidate</th>
                    <th>Employer / Vacancy</th>
                    <th>Destination</th>
                    <th>Flight</th>
                    <th>Departure Date</th>
                    <th>Briefing</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $deployments = [
                    ['id' => 'DEP-0018', 'candidate' => 'Kavindu Perera',    'cid' => 'CAND-1297', 'employer' => 'Global Workforce Solutions', 'vacancy' => 'Warehouse Operator', 'country' => 'Melbourne, AU', 'flight' => 'UL 605', 'departure' => '10 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment',      'urgent' => true,  'filter' => 'upcoming'],
                    ['id' => 'DEP-0017', 'candidate' => 'Pradeep Fernando',  'cid' => 'CAND-1290', 'employer' => 'Global Workforce Solutions', 'vacancy' => 'Warehouse Operator', 'country' => 'Melbourne, AU', 'flight' => 'UL 605', 'departure' => '10 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment',      'urgent' => true,  'filter' => 'upcoming'],
                    ['id' => 'DEP-0016', 'candidate' => 'Dilrukshi Jayakody','cid' => 'CAND-1278', 'employer' => 'Pacific Hospitality Group',  'vacancy' => 'Hospitality Staff',  'country' => 'Sydney, AU',    'flight' => 'SQ 483', 'departure' => '12 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment',      'urgent' => true,  'filter' => 'upcoming'],
                    ['id' => 'DEP-0015', 'candidate' => 'Chamari Dias',      'cid' => 'CAND-1292', 'employer' => 'Al Futtaim Manufacturing',  'vacancy' => 'Machine Operator',   'country' => 'Dubai, UAE',    'flight' => 'EK 343', 'departure' => '18 Oct 2026', 'briefing' => 'Pending',   'status' => 'checklist',       'urgent' => false, 'filter' => 'thismonth'],
                    ['id' => 'DEP-0014', 'candidate' => 'Nadeeka Silva',     'cid' => 'CAND-1296', 'employer' => 'Qatar Industrial Services', 'vacancy' => 'Factory Worker',     'country' => 'Doha, QA',      'flight' => 'QR 157', 'departure' => '22 Oct 2026', 'briefing' => 'Scheduled', 'status' => 'visa_processing', 'urgent' => false, 'filter' => 'thismonth'],
                    ['id' => 'DEP-0012', 'candidate' => 'Kumari Dissanayake','cid' => 'CAND-1271', 'employer' => 'Pacific Hospitality Group',  'vacancy' => 'Hospitality Staff',  'country' => 'Sydney, AU',    'flight' => 'UL 601', 'departure' => '02 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployed',        'urgent' => false, 'filter' => 'departed'],
                    ['id' => 'DEP-0011', 'candidate' => 'Roshan Thilakasiri','cid' => 'CAND-1268', 'employer' => 'Al Futtaim Manufacturing',  'vacancy' => 'Machine Operator',   'country' => 'Dubai, UAE',    'flight' => 'EK 345', 'departure' => '28 Sep 2026', 'briefing' => 'Completed', 'status' => 'deployed',        'urgent' => false, 'filter' => 'departed'],
                ];
                @endphp

                @foreach($deployments as $dep)
                <tr class="dep-row {{ $dep['urgent'] ? 'bg-amber-50' : '' }}" data-filter="{{ $dep['filter'] }}">
                    <td>
                        <a href="{{ route('employment.deployments.show', 1) }}"
                           class="font-mono text-sm font-semibold text-indigo-600 hover:underline">
                            {{ $dep['id'] }}
                        </a>
                        @if($dep['urgent'])
                        <span class="badge badge-warning badge-dot block w-fit mt-0.5">Urgent</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($dep['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $dep['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $dep['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">{{ $dep['vacancy'] }}</div>
                        <div class="text-xs text-slate-500">{{ $dep['employer'] }}</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5 text-sm text-slate-600">
                            <i data-lucide="map-pin" style="width:13px;height:13px;color:#94a3b8"></i>
                            {{ $dep['country'] }}
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5 text-sm font-mono font-semibold text-slate-800">
                            <i data-lucide="plane" style="width:13px;height:13px;color:#6366f1"></i>
                            {{ $dep['flight'] }}
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold {{ $dep['urgent'] ? 'text-amber-700' : 'text-slate-700' }} whitespace-nowrap">
                            {{ $dep['departure'] }}
                        </div>
                    </td>
                    <td>
                        @php $bc = ['Completed' => 'badge-approved', 'Pending' => 'badge-pending', 'Scheduled' => 'badge-registered']; @endphp
                        <span class="badge {{ $bc[$dep['briefing']] ?? 'badge-draft' }} badge-dot">{{ $dep['briefing'] }}</span>
                    </td>
                    <td><x-status-badge :status="$dep['status']" /></td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.deployments.show', 1) }}" class="btn btn-ghost btn-xs" title="View">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            <button onclick="openModal('briefing-modal')" class="btn btn-ghost btn-xs" title="Briefing Status">
                                <i data-lucide="clipboard-check" style="width:13px;height:13px"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ====== SCHEDULE DEPLOYMENT MODAL ====== -->
<div id="dep-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal('dep-modal')">
    <div class="modal-box" style="max-width:640px;width:100%">
        <div class="modal-header">
            <h3 class="modal-title">Schedule New Deployment</h3>
            <button onclick="closeModal('dep-modal')" class="modal-close"><i data-lucide="x" style="width:18px;height:18px"></i></button>
        </div>
        <form action="{{ route('employment.deployments.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="modal-label">Candidate Name</label>
                        <input type="text" name="candidate_name" class="form-input" placeholder="e.g. Kavindu Perera" required>
                    </div>
                    <div>
                        <label class="modal-label">Candidate ID</label>
                        <input type="text" name="candidate_id" class="form-input" placeholder="CAND-XXXX">
                    </div>
                    <div>
                        <label class="modal-label">Employer</label>
                        <select name="employer" class="form-select" required>
                            <option value="">Select Employer</option>
                            <option>Global Workforce Solutions</option>
                            <option>Al Futtaim Manufacturing</option>
                            <option>Qatar Industrial Services</option>
                            <option>Pacific Hospitality Group</option>
                            <option>Saudi Logistics & Transport</option>
                        </select>
                    </div>
                    <div>
                        <label class="modal-label">Vacancy / Job Role</label>
                        <input type="text" name="vacancy" class="form-input" placeholder="e.g. Warehouse Operator">
                    </div>
                    <div>
                        <label class="modal-label">Destination Country</label>
                        <select name="destination" class="form-select" required>
                            <option value="">Select Destination</option>
                            <option>Melbourne, Australia</option><option>Sydney, Australia</option>
                            <option>Dubai, UAE</option><option>Doha, Qatar</option>
                            <option>Kuwait City, Kuwait</option><option>Riyadh, Saudi Arabia</option>
                        </select>
                    </div>
                    <div>
                        <label class="modal-label">Flight Number</label>
                        <input type="text" name="flight" class="form-input" placeholder="e.g. UL 605">
                    </div>
                    <div>
                        <label class="modal-label">Departure Date</label>
                        <input type="date" name="departure_date" class="form-input" required>
                    </div>
                    <div>
                        <label class="modal-label">Departure Time</label>
                        <input type="time" name="departure_time" class="form-input" value="08:00">
                    </div>
                    <div>
                        <label class="modal-label">Pre-departure Briefing</label>
                        <select name="briefing" class="form-select">
                            <option>Not Scheduled</option>
                            <option>Scheduled</option>
                            <option>Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="modal-label">Briefing Date</label>
                        <input type="date" name="briefing_date" class="form-input">
                    </div>
                    <div class="md:col-span-2">
                        <label class="modal-label">Special Instructions</label>
                        <textarea name="notes" class="form-input" rows="2" placeholder="Any airport instructions, contact persons, document requirements…"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('dep-modal')" class="btn btn-ghost btn-sm">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i data-lucide="plane" style="width:14px;height:14px"></i> Schedule Deployment
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Briefing Update Modal -->
<div id="briefing-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal('briefing-modal')">
    <div class="modal-box" style="max-width:420px;width:100%">
        <div class="modal-header">
            <h3 class="modal-title">Update Briefing Status</h3>
            <button onclick="closeModal('briefing-modal')" class="modal-close"><i data-lucide="x" style="width:18px;height:18px"></i></button>
        </div>
        <div class="modal-body">
            <div class="mb-4">
                <label class="modal-label">Briefing Status</label>
                <select class="form-select">
                    <option>Not Scheduled</option><option>Scheduled</option><option selected>Completed</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="modal-label">Briefing Date</label>
                <input type="date" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div>
                <label class="modal-label">Conducted By</label>
                <select class="form-select">
                    <option>Kasun Bandara</option><option>Nimal Jayawardena</option><option>Priya Hewage</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('briefing-modal')" class="btn btn-ghost btn-sm">Cancel</button>
            <button onclick="closeModal('briefing-modal');showToast('Briefing status updated!','success')" class="btn btn-primary btn-sm">Save</button>
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
.alert-success { background:#f0fdf4;border:1.5px solid #86efac;color:#166534;padding:14px 16px;border-radius:12px;font-size:14px;display:flex;align-items:center;gap:10px;font-weight:500; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // Filter pills
    const pills = document.querySelectorAll('[data-dep-filter]');
    const rows = document.querySelectorAll('tr.dep-row');
    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            const f = pill.dataset.depFilter;
            rows.forEach(r => {
                r.style.display = (f === 'all' || r.dataset.filter === f) ? '' : 'none';
            });
        });
    });
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
document.addEventListener('keydown', e => { if(e.key==='Escape') { document.querySelectorAll('.modal-overlay').forEach(m=>m.style.display='none'); document.body.style.overflow=''; } });
</script>

</x-layouts.app>
