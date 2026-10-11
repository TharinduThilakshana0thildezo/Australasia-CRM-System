<x-layouts.app title="Class Sessions — Academy">

<x-page-header
    title="Class Sessions"
    subtitle="All scheduled and completed class sessions across batches"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Sessions']]">
    <x-slot:actions>
        <button onclick="openModal('session-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>Add Session
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['3','Attendance Pending','alert-circle','rose'],['12','Upcoming','calendar','indigo'],['68','Completed','check-circle','emerald'],['83','Total Sessions','layers','slate']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="ses-search" type="text" class="search-input" placeholder="Search topic, batch, trainer…">
            </div>
            <select id="ses-batch" class="form-select" style="width:auto">
                <option value="">All Batches</option>
                <option>BCH-2026-001</option><option>BCH-2026-002</option>
                <option>BCH-2026-003</option><option>BCH-2026-004</option><option>BCH-2026-005</option>
            </select>
            <select id="ses-status" class="form-select" style="width:auto">
                <option value="">All</option>
                <option value="pending">Attendance Pending</option>
                <option value="done">Attendance Done</option>
                <option value="upcoming">Upcoming</option>
            </select>
            <input id="ses-date" type="date" class="form-input" style="width:140px" placeholder="Date">
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><div class="text-sm text-slate-500"><strong>83</strong> sessions</div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Session ID</th><th>Batch</th><th>Topic</th><th>Date</th><th>Time</th><th>Trainer</th><th>Venue</th><th>Attendance</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $sessions=[
                    ['SES-001','BCH-2026-001','Workplace Safety — Introduction','01 Oct 2026','08:00–12:00','Mr. Rupasinghe','Room A','24/24','done'],
                    ['SES-002','BCH-2026-001','Hazard Awareness & PPE','03 Oct 2026','08:00–12:00','Mr. Rupasinghe','Room A','23/24','done'],
                    ['SES-003','BCH-2026-001','Equipment Handling','05 Oct 2026','08:00–12:00','Mr. Rupasinghe','Room A','22/24','done'],
                    ['SES-004','BCH-2026-001','Labour Law & Rights','08 Oct 2026','08:00–12:00','Mr. Rupasinghe','Room A','—','pending'],
                    ['SES-005','BCH-2026-001','Cultural Orientation','10 Oct 2026','08:00–12:00','Ms. Jayasiri','Room A','—','upcoming'],
                    ['SES-006','BCH-2026-002','English Basics — Session 1','05 Oct 2026','09:00–13:00','Ms. Jayasiri','Room B','18/18','done'],
                    ['SES-007','BCH-2026-002','Grammar & Vocabulary','07 Oct 2026','09:00–13:00','Ms. Jayasiri','Room B','17/18','done'],
                    ['SES-008','BCH-2026-002','Speaking Practice 1','09 Oct 2026','09:00–13:00','Ms. Jayasiri','Room B','—','pending'],
                    ['SES-009','BCH-2026-003','Computer Introduction','10 Oct 2026','14:00–17:00','Mr. Dissanayake','Lab 1','—','upcoming'],
                    ['SES-010','BCH-2026-004','Arabic Alphabet & Pronunciation','10 Oct 2026','14:00–17:00','Ms. Hathuma','Room C','—','upcoming'],
                ];
                @endphp
                @foreach($sessions as $ses)
                <tr class="ses-row" data-status="{{ $ses[8] }}">
                    <td><code class="text-xs font-mono text-indigo-600">{{ $ses[0] }}</code></td>
                    <td class="text-xs font-mono text-slate-500">{{ $ses[1] }}</td>
                    <td class="text-sm font-semibold text-slate-800">{{ $ses[2] }}</td>
                    <td class="text-xs text-slate-500">{{ $ses[3] }}</td>
                    <td class="text-xs text-slate-500">{{ $ses[4] }}</td>
                    <td class="text-sm text-slate-600">{{ $ses[5] }}</td>
                    <td class="text-xs text-slate-500">{{ $ses[6] }}</td>
                    <td class="text-sm font-semibold {{ $ses[7]==='—'?'text-slate-400':'text-emerald-600' }}">{{ $ses[7] }}</td>
                    <td>
                        <span class="badge {{ $ses[8]==='done'?'badge-approved':($ses[8]==='pending'?'badge-pending':'badge-draft') }}">
                            {{ $ses[8]==='done'?'Recorded':($ses[8]==='pending'?'Att. Pending':'Upcoming') }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-1">
                            @if($ses[8]==='pending')
                            <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-primary btn-xs"><i data-lucide="check-square" style="width:12px;height:12px"></i>Mark</a>
                            @elseif($ses[8]==='done')
                            <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @else
                            <span class="text-xs text-slate-400">Upcoming</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Session Modal --}}
<div id="session-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:480px">
        <div class="modal-header"><span class="modal-title">Add Class Session</span><button onclick="closeModal('session-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.sessions.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Batch</label>
                    <select name="batch_id" class="form-select" required>
                        <option value="">Select batch</option>
                        <option value="BCH-2026-001">BCH-2026-001 — PDT Warehouse (Active)</option>
                        <option value="BCH-2026-002">BCH-2026-002 — English Comm. (Active)</option>
                        <option value="BCH-2026-003">BCH-2026-003 — Computer Literacy (Active)</option>
                        <option value="BCH-2026-004">BCH-2026-004 — Arabic Language (Active)</option>
                        <option value="BCH-2026-005">BCH-2026-005 — Hospitality (Active)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Topic</label>
                    <input name="topic" type="text" class="form-input" placeholder="Session topic / title" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="form-group"><label class="form-label required">Date</label><input name="session_date" type="date" class="form-input" required></div>
                    <div class="form-group"><label class="form-label">Venue</label><input name="venue" type="text" class="form-input" placeholder="Room / Lab"></div>
                    <div class="form-group"><label class="form-label required">Start Time</label><input name="start_time" type="time" class="form-input" required></div>
                    <div class="form-group"><label class="form-label required">End Time</label><input name="end_time" type="time" class="form-input" required></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('session-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Add Session</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('ses-search'),st=document.getElementById('ses-status'),ba=document.getElementById('ses-batch');
    const rows=document.querySelectorAll('tr.ses-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||''),batch=(ba?.value||'');
        rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status)&&(!batch||r.textContent.includes(batch));r.style.display=ok?'':'none';});
    }
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);ba?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
