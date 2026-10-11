<x-layouts.app title="Exams — Academy">

<x-page-header
    title="Exams &amp; Assessments"
    subtitle="Schedule, marks entry, results and re-sit management"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Exams']]">
    <x-slot:actions>
        <a href="{{ route('academy.exams.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Schedule Exam</a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['4','Upcoming Exams','calendar','indigo'],['3','Marks Pending','edit','amber'],['2','Results Pending','clock','blue'],['2','Re-sits Needed','refresh-cw','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="exam-search" type="text" class="search-input" placeholder="Search exam title, batch…">
            </div>
            <select id="exam-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="draft">Draft</option>
                <option value="scheduled">Scheduled</option>
                <option value="marks_pending">Marks Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">All Exams</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Exam ID</th><th>Title</th><th>Batch</th><th>Date</th><th>Max / Pass</th><th>Students</th><th>Passed</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $exams=[
                    ['EXM-001','Pre-Departure Final Assessment','BCH-2026-001','15 Oct 2026','100 / 50',24,0,'scheduled'],
                    ['EXM-002','English Assessment 2','BCH-2026-002','18 Oct 2026','50 / 30',18,0,'scheduled'],
                    ['EXM-003','Computer Skills Test','BCH-2026-003','25 Oct 2026','100 / 60',30,0,'draft'],
                    ['EXM-004','Arabic Oral Examination','BCH-2026-004','01 Nov 2026','50 / 35',12,0,'draft'],
                    ['EXM-005','Pre-Departure Final (Prev.)','BCH-2026-003-P','15 Sep 2026','100 / 50',30,28,'completed'],
                    ['RST-001','Pre-Departure Re-sit','BCH-2026-003-P','18 Sep 2026','100 / 50',2,2,'completed'],
                ];
                @endphp
                @foreach($exams as $ex)
                <tr class="exam-row" data-status="{{ $ex[7] }}">
                    <td><code class="text-xs font-mono text-indigo-600">{{ $ex[0] }}</code></td>
                    <td><a href="{{ route('academy.exams.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $ex[1] }}</a></td>
                    <td class="text-xs font-mono text-slate-500">{{ $ex[2] }}</td>
                    <td class="text-xs text-slate-500">{{ $ex[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $ex[4] }}</td>
                    <td class="text-sm font-bold text-slate-800">{{ $ex[5] }}</td>
                    <td class="text-sm {{ $ex[6]>0?'text-emerald-600 font-bold':'text-slate-400' }}">{{ $ex[6]>0?$ex[6].'/'.$ex[5]:'—' }}</td>
                    <td><x-status-badge :status="$ex[7]" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('academy.exams.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if($ex[7]==='scheduled')
                            <a href="{{ route('academy.exams.marks',1) }}" class="btn btn-primary btn-xs">Enter Marks</a>
                            @elseif($ex[7]==='marks_pending')
                            <a href="{{ route('academy.exams.marks',1) }}" class="btn btn-warning btn-xs">Enter Marks</a>
                            @elseif($ex[7]==='completed')
                            <button onclick="openModal('resit-modal')" class="btn btn-outline btn-xs">Re-sit</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Re-sit Modal --}}
<div id="resit-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Schedule Re-sit Examination</span><button onclick="closeModal('resit-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.exams.resit.schedule',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-info text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Previous attempt results are preserved. A new exam record will be created for the re-sit.</div>
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select failed student</option>
                        <option value="ACD-1007">ACD-1007 — Chamari Ranasinghe (44/100)</option>
                        <option value="ACD-1015">ACD-1015 — Roshan Kumara (38/100)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Re-sit Date</label>
                    <input name="resit_date" type="date" class="form-input" required>
                </div>
                <div class="form-group"><label class="form-label">Notes</label>
                    <textarea name="resit_reason" rows="3" class="form-textarea" placeholder="Any special notes for this re-sit…"></textarea>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('resit-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Schedule Re-sit</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('exam-search'),st=document.getElementById('exam-status');
    const rows=document.querySelectorAll('tr.exam-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
