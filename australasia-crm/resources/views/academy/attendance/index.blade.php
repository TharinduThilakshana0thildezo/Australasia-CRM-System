<x-layouts.app title="Attendance — Academy">

<x-page-header
    title="Attendance Management"
    subtitle="Session attendance records and below-threshold alerts"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Attendance']]">
    <x-slot:actions>
        <a href="{{ route('academy.attendance.makeup') }}" class="btn btn-secondary btn-sm"><i data-lucide="refresh-cw" style="width:14px;height:14px"></i>Make-up Sessions</a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

{{-- Alert: Below threshold --}}
<div class="card mb-5 border-rose-200">
    <div class="card-header bg-rose-50">
        <div class="flex items-center gap-2">
            <i data-lucide="alert-triangle" style="width:18px;height:18px;color:#ef4444"></i>
            <h3 class="card-title text-rose-700">7 Students Below Attendance Threshold</h3>
        </div>
        <span class="text-sm text-rose-600">Threshold: configurable — <a href="{{ route('academy.settings') }}" class="underline font-semibold">Settings</a></span>
    </div>
    <div class="card-body">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Batch</th><th>Attendance %</th><th>Sessions Absent</th><th>Action</th></tr></thead>
            <tbody>
                @foreach([
                    ['ACD-1007','Chamari Ranasinghe','BCH-2026-001','62%',6],
                    ['ACD-1015','Roshan Kumara','BCH-2026-002','58%',9],
                    ['ACD-1022','Amali Jayasiri','BCH-2026-003','71%',7],
                ] as $b)
                <tr>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-rose-700 hover:underline">{{ $b[1] }}</a><p class="text-xs text-slate-400">{{ $b[0] }}</p></td>
                    <td class="text-xs font-mono text-slate-500">{{ $b[2] }}</td>
                    <td class="text-sm font-bold text-rose-600">{{ $b[3] }}</td>
                    <td class="text-sm font-bold text-rose-600">{{ $b[4] }}</td>
                    <td><a href="{{ route('academy.attendance.makeup') }}" class="btn btn-warning btn-xs">Schedule Make-up</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Filter bar --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="att-search" type="text" class="search-input" placeholder="Search session, batch, topic…">
            </div>
            <select id="att-batch" class="form-select" style="width:auto">
                <option value="">All Batches</option>
                <option>BCH-2026-001</option><option>BCH-2026-002</option><option>BCH-2026-003</option>
                <option>BCH-2026-004</option><option>BCH-2026-005</option>
            </select>
            <select id="att-status" class="form-select" style="width:auto">
                <option value="">All Sessions</option>
                <option value="pending">Attendance Pending</option>
                <option value="done">Recorded</option>
                <option value="upcoming">Upcoming</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">All Sessions</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Session ID</th><th>Batch</th><th>Topic</th><th>Date</th><th>Time</th><th>Trainer</th><th>Attended</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $sessions=[
                    ['SES-001','BCH-2026-001','Workplace Safety — Intro','01 Oct 2026','08:00–12:00','Mr. Rupasinghe','24/24','done'],
                    ['SES-002','BCH-2026-001','Hazard Awareness & PPE','03 Oct 2026','08:00–12:00','Mr. Rupasinghe','23/24','done'],
                    ['SES-003','BCH-2026-001','Equipment Handling','05 Oct 2026','08:00–12:00','Mr. Rupasinghe','22/24','done'],
                    ['SES-004','BCH-2026-001','Labour Law & Rights','08 Oct 2026','08:00–12:00','Mr. Rupasinghe','—','pending'],
                    ['SES-005','BCH-2026-002','English Basics — Session 1','05 Oct 2026','09:00–13:00','Ms. Jayasiri','18/18','done'],
                    ['SES-006','BCH-2026-002','Grammar & Vocabulary','07 Oct 2026','09:00–13:00','Ms. Jayasiri','17/18','done'],
                    ['SES-007','BCH-2026-003','Computer Intro','10 Oct 2026','14:00–17:00','Mr. Dissanayake','—','upcoming'],
                    ['SES-008','BCH-2026-004','Arabic Alphabet','10 Oct 2026','14:00–17:00','Ms. Hathuma','—','upcoming'],
                ];
                @endphp
                @foreach($sessions as $ses)
                <tr class="sess-row" data-status="{{ $ses[7] }}">
                    <td><code class="text-xs font-mono text-indigo-600">{{ $ses[0] }}</code></td>
                    <td class="text-xs font-mono text-slate-500">{{ $ses[1] }}</td>
                    <td class="text-sm font-semibold text-slate-800">{{ $ses[2] }}</td>
                    <td class="text-xs text-slate-500">{{ $ses[3] }}</td>
                    <td class="text-xs text-slate-500">{{ $ses[4] }}</td>
                    <td class="text-sm text-slate-600">{{ $ses[5] }}</td>
                    <td class="text-sm font-bold {{ $ses[6]==='—'?'text-slate-400':'text-emerald-600' }}">{{ $ses[6] }}</td>
                    <td>
                        <span class="badge {{ $ses[7]==='done'?'badge-approved':($ses[7]==='pending'?'badge-pending':'badge-draft') }}">
                            {{ ucfirst($ses[7]) }}
                        </span>
                    </td>
                    <td>
                        @if($ses[7]==='pending')
                        <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-primary btn-xs"><i data-lucide="check-square" style="width:12px;height:12px"></i>Mark</a>
                        @elseif($ses[7]==='done')
                        <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                        <button onclick="openModal('correct-modal')" class="btn btn-outline btn-xs">Correct</button>
                        @else
                        <span class="text-xs text-slate-400">Not started</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Correction Modal --}}
<div id="correct-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Correct Attendance Entry</span><button onclick="closeModal('correct-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.attendance.correct',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-info text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Original entry is preserved in the audit log. A correction reason is required.</div>
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select student</option>
                        <option value="ACD-1007">ACD-1007 — Chamari Ranasinghe</option>
                        <option value="ACD-1001">ACD-1001 — Kamal Pradeep</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Correct Status</label>
                    <select name="new_status" class="form-select" required>
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="late">Late</option>
                        <option value="excused">Excused</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Correction Reason</label>
                    <textarea name="correction_reason" rows="3" class="form-textarea" required minlength="5" placeholder="Minimum 5 characters required"></textarea>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('correct-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-warning">Save Correction</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('att-search'),st=document.getElementById('att-status');
    const rows=document.querySelectorAll('tr.sess-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
