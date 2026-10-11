<x-layouts.app title="Enter Marks — EXM-001">

<x-page-header
    title="Enter Marks — EXM-001"
    subtitle="Pre-Departure Final Assessment · BCH-2026-001 · 15 Oct 2026 · Max: 100 · Pass: 50"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.exams.index'),'label'=>'Exams'],['url'=>route('academy.exams.show',1),'label'=>'EXM-001'],['url'=>'#','label'=>'Enter Marks']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-info mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>Marks Entry Rules:</strong> Enter marks between 0 and 100. Marks are saved as <em>Draft</em> until published. Students below the attendance threshold are flagged — enter marks only after authorized override.
        Results must be reviewed and published separately after marks entry.
    </div>
</div>

<form method="POST" action="{{ route('academy.exams.marks.store',1) }}">
@csrf
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Batch Roster — 24 Students</h3>
        <div class="text-sm text-slate-500">Pass mark: <strong>50</strong> · Max: <strong>100</strong></div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Attendance</th>
                    <th>Eligibility</th>
                    <th>Marks Obtained (0–100)</th>
                    <th>Outcome (Auto)</th>
                </tr>
            </thead>
            <tbody>
                @php
                $students=[
                    ['ACD-1001','Kamal Pradeep','92%','eligible'],
                    ['ACD-1002','Nimesha Silva','78%','eligible'],
                    ['ACD-1003','Samantha Perera','85%','eligible'],
                    ['ACD-1004','Thilina Jayawardena','80%','eligible'],
                    ['ACD-1005','Dulani Wickramasinghe','91%','eligible'],
                    ['ACD-1006','Asanka Fernando','75%','eligible'],
                    ['ACD-1007','Chamari Ranasinghe','62%','below_threshold'],
                    ['ACD-1008','Roshan Dissanayake','58%','below_threshold'],
                    ['ACD-1009','Malinda Seneviratne','88%','eligible'],
                    ['ACD-1010','Tharanga Kumara','83%','eligible'],
                ];
                @endphp
                @foreach($students as $i => $s)
                <tr class="{{ $s[3]==='below_threshold'?'bg-rose-50':($i%2===0?'bg-white':'bg-slate-50/50') }}">
                    <td>
                        <input type="hidden" name="marks[{{ $i }}][student_id]" value="{{ $s[0] }}">
                        <p class="text-sm font-semibold text-slate-800">{{ $s[1] }}</p>
                        <p class="text-xs text-slate-400">{{ $s[0] }}</p>
                    </td>
                    <td class="text-sm font-bold {{ (int)$s[2]<75?'text-rose-600':'text-emerald-600' }}">{{ $s[2] }}</td>
                    <td>
                        @if($s[3]==='below_threshold')
                        <span class="badge badge-rejected text-xs">⚠ Below Threshold</span>
                        @else
                        <span class="badge badge-approved text-xs">Eligible</span>
                        @endif
                    </td>
                    <td>
                        @if($s[3]==='below_threshold')
                        <div class="text-xs text-rose-600 font-semibold">Blocked — attendance threshold not met</div>
                        <div class="text-xs text-slate-400 mt-0.5">Contact director for override authorization</div>
                        @else
                        <div class="flex items-center gap-2">
                            <input type="number" name="marks[{{ $i }}][obtained]" min="0" max="100" step="0.5" class="form-input marks-input" style="width:80px" required
                                oninput="updateOutcome(this)">
                            <span class="text-xs text-slate-400">/ 100</span>
                        </div>
                        @endif
                    </td>
                    <td>
                        <span class="outcome-badge text-xs text-slate-400" id="outcome-{{ $i }}">Enter marks</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex gap-3">
        <button type="submit" class="btn btn-primary"><i data-lucide="save" style="width:16px;height:16px"></i>Save Marks (Draft)</button>
        <a href="{{ route('academy.exams.show',1) }}" class="btn btn-ghost">Cancel</a>
        <div class="ml-auto text-xs text-slate-400 flex items-center">Results remain Draft until published from the exam page.</div>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    document.querySelectorAll('.marks-input').forEach((inp,i)=>{
        inp.addEventListener('input',()=>{
            const v=parseFloat(inp.value);
            const badge=document.getElementById('outcome-'+i);
            if(badge){
                if(isNaN(v)){badge.textContent='Enter marks';badge.className='outcome-badge text-xs text-slate-400';}
                else if(v>=50){badge.textContent='✓ Pass';badge.className='outcome-badge text-xs text-emerald-600 font-bold';}
                else{badge.textContent='✗ Fail';badge.className='outcome-badge text-xs text-rose-600 font-bold';}
            }
        });
    });
});
</script>
</x-layouts.app>
