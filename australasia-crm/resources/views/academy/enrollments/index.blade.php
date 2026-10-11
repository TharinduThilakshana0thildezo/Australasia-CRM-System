<x-layouts.app title="Enrollments — Academy">

<x-page-header
    title="Enrollments"
    subtitle="All Academy course enrollments — active, completed, withdrawn"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Enrollments']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['134','Active','users','emerald'],['18','Awaiting Payment','credit-card','amber'],['4','Waitlisted','clock','indigo'],['9','Withdrawn','x-circle','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="enr-search" type="text" class="search-input" placeholder="Search student, ID, course…">
            </div>
            <select id="enr-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="completed">Completed</option>
                <option value="withdrawn">Withdrawn</option>
                <option value="waitlisted">Waitlisted</option>
            </select>
            <select id="enr-course" class="form-select" style="width:auto">
                <option value="">All Courses</option>
                <option>Pre-Departure — Warehouse</option>
                <option>English Communication</option>
                <option>Arabic Language</option>
                <option>Computer Literacy</option>
                <option>Hospitality Service</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><div class="text-sm text-slate-500"><strong>165</strong> enrollments</div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Enrollment ID</th><th>Student</th><th>Course</th><th>Batch</th><th>Enrolled On</th><th>Fee</th><th>Attendance</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $enrs=[
                    ['ENR-ACD-0047','ACD-1001','Kamal Pradeep','Pre-Departure — WH','BCH-2026-003-P','15 Aug','Paid','92%','completed'],
                    ['ENR-ACD-0048','ACD-1002','Nimesha Silva','English Comm.','BCH-2026-001','16 Aug','Paid','78%','active'],
                    ['ENR-ACD-0049','ACD-1003','Samantha Perera','Pre-Departure — WH','BCH-2026-001','17 Aug','Paid','85%','active'],
                    ['ENR-ACD-0050','ACD-1004','Thilina Jayawardena','Arabic Language','BCH-2026-004','18 Aug','Paid','—','active'],
                    ['ENR-ACD-0051','ACD-1005','Dulani Wickramasinghe','Arabic Language','BCH-2026-004','19 Aug','Pending','—','active'],
                    ['ENR-ACD-0052','ACD-1006','Asanka Fernando','Pre-Departure — HOS','BCH-2026-005','20 Aug','Pending','—','active'],
                    ['ENR-ACD-0053','ACD-1009','Malinda Seneviratne','Pre-Departure — WH','BCH-2026-001','21 Aug','Paid','—','withdrawn'],
                    ['ENR-ACD-0054','ACD-1008','Roshan Dissanayake','Computer Literacy','—','22 Aug','None','—','waitlisted'],
                ];
                @endphp
                @foreach($enrs as $e)
                <tr class="enr-row" data-status="{{ $e[8] }}">
                    <td><a href="{{ route('academy.enrollments.show',1) }}" class="text-xs font-mono text-indigo-600">{{ $e[0] }}</a></td>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $e[2] }}</a><p class="text-xs text-slate-400">{{ $e[1] }}</p></td>
                    <td class="text-sm text-slate-700">{{ $e[3] }}</td>
                    <td class="text-xs font-mono text-slate-500">{{ $e[4] }}</td>
                    <td class="text-xs text-slate-500">{{ $e[5] }}</td>
                    <td><span class="badge {{ $e[6]==='Paid'?'badge-approved':($e[6]==='Pending'?'badge-pending':'badge-draft') }}">{{ $e[6] }}</span></td>
                    <td class="text-sm font-semibold {{ $e[7]==='—'?'text-slate-400':((int)$e[7]<75?'text-rose-600':'text-emerald-600') }}">{{ $e[7] }}</td>
                    <td><x-status-badge :status="$e[8]" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('academy.enrollments.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if($e[8]==='active')
                            <button onclick="openModal('withdraw-modal')" class="btn btn-danger btn-xs">Withdraw</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Withdraw Modal --}}
<div id="withdraw-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Record Withdrawal</span><button onclick="closeModal('withdraw-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.enrollments.withdraw',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-warning text-sm"><i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>
                    <strong>Fee Treatment — Pending Confirmation.</strong> Do NOT process a refund or retain fees without director authorization. The applicable policy must be confirmed.
                </div>
                <div class="form-group"><label class="form-label required">Withdrawal Date</label><input name="withdrawal_date" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                <div class="form-group"><label class="form-label required">Reason</label><textarea name="withdrawal_reason" rows="4" class="form-textarea" required minlength="10" placeholder="Minimum 10 characters…"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('withdraw-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger" onclick="return confirm('Record this withdrawal?')">Record Withdrawal</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('enr-search'),st=document.getElementById('enr-status');
    const rows=document.querySelectorAll('tr.enr-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
