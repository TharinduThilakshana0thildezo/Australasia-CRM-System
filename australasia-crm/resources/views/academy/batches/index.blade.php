<x-layouts.app title="Batches — Academy">

<x-page-header
    title="Batch Management"
    subtitle="All course batches — schedule, roster, and status"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Batches']]">
    <x-slot:actions>
        <a href="{{ route('academy.batches.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Batch
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['8','Running Batches','layers','emerald'],['3','Scheduled','calendar','indigo'],['5','Completed','check-circle','slate'],['2','Near Capacity','alert-triangle','amber']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="batch-search" type="text" class="search-input" placeholder="Search batch, course, trainer…">
            </div>
            <select id="batch-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="scheduled">Scheduled</option>
                <option value="active">Running</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <select id="batch-course" class="form-select" style="width:auto">
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
    <div class="card-header"><div class="text-sm text-slate-500"><strong>16</strong> batches</div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Batch Code</th><th>Course</th><th>Trainer</th><th>Start</th><th>End</th><th>Seats</th><th>Attendance %</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $batches=[
                    ['BCH-2026-001','Pre-Departure — Warehouse','Mr. Rupasinghe','01 Oct 2026','15 Oct 2026',24,30,'88%','active'],
                    ['BCH-2026-002','English Communication (Int.)','Ms. Jayasiri','05 Oct 2026','20 Oct 2026',18,20,'91%','active'],
                    ['BCH-2026-003','Computer Literacy — Basic','Mr. Dissanayake','10 Oct 2026','28 Oct 2026',30,30,'—','active'],
                    ['BCH-2026-004','Arabic Language (Beg.)','Ms. Hathuma','10 Oct 2026','05 Nov 2026',12,15,'—','active'],
                    ['BCH-2026-005','Hospitality Service','Mr. Perera','15 Oct 2026','10 Nov 2026',22,25,'—','active'],
                    ['BCH-2026-006','Pre-Departure — Warehouse','Mr. Rupasinghe','20 Oct 2026','03 Nov 2026',8,30,'—','scheduled'],
                    ['BCH-2026-007','English Communication (Adv.)','Ms. Jayasiri','01 Nov 2026','28 Nov 2026',5,15,'—','scheduled'],
                    ['BCH-2026-003-P','Pre-Departure — Warehouse','Mr. Rupasinghe','01 Sep 2026','15 Sep 2026',30,30,'87%','completed'],
                ];
                @endphp
                @foreach($batches as $b)
                @php
                    $pct = $b[5]/$b[6]*100;
                    $nearFull = $pct >= 90;
                @endphp
                <tr class="batch-row" data-status="{{ $b[8] }}">
                    <td><a href="{{ route('academy.batches.show',1) }}" class="text-xs font-mono font-semibold text-indigo-600">{{ $b[0] }}</a></td>
                    <td class="text-sm font-semibold text-slate-800">{{ $b[1] }}</td>
                    <td class="text-sm text-slate-600">{{ $b[2] }}</td>
                    <td class="text-xs text-slate-500">{{ $b[3] }}</td>
                    <td class="text-xs text-slate-500">{{ $b[4] }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold {{ $nearFull?'text-rose-600':'text-slate-800' }}">{{ $b[5] }}/{{ $b[6] }}</span>
                            @if($nearFull)<span class="badge badge-refund text-xs">Full</span>@endif
                        </div>
                        <div class="progress-bar-track w-16 mt-1"><div class="progress-bar-fill {{ $nearFull?'bg-rose-500':'bg-indigo-500' }}" style="width:{{ $pct }}%"></div></div>
                    </td>
                    <td class="text-sm {{ $b[7]==='—'?'text-slate-400':((int)$b[7]<75?'text-rose-600':'text-emerald-600') }} font-semibold">{{ $b[7] }}</td>
                    <td><x-status-badge :status="$b[8]" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('academy.batches.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if($b[8]==='scheduled')
                            <form method="POST" action="{{ route('academy.batches.start',1) }}">@csrf<button type="submit" class="btn btn-success btn-xs">Start</button></form>
                            @elseif($b[8]==='active')
                            <button onclick="openModal('transfer-modal')" class="btn btn-outline btn-xs">Transfer</button>
                            <form method="POST" action="{{ route('academy.batches.complete',1) }}">@csrf<button type="submit" class="btn btn-primary btn-xs" onclick="return confirm('Mark batch complete?')">Complete</button></form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Transfer Modal --}}
<div id="transfer-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Transfer Student Between Batches</span><button onclick="closeModal('transfer-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.batches.transfer',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select student</option>
                        <option value="ACD-1003">ACD-1003 — Samantha Perera</option>
                        <option value="ACD-1004">ACD-1004 — Thilina Jayawardena</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Transfer to Batch</label>
                    <select name="new_batch_id" class="form-select" required>
                        <option value="">Select target batch</option>
                        <option value="BCH-2026-006">BCH-2026-006 — 20 Oct 2026 (22 seats left)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Transfer Reason</label>
                    <textarea name="transfer_reason" rows="3" class="form-textarea" required minlength="10"></textarea>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('transfer-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Transfer Student</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('batch-search'),st=document.getElementById('batch-status');
    const rows=document.querySelectorAll('tr.batch-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
