<x-layouts.app title="Students — Academy">

<x-page-header
    title="Academy Students"
    subtitle="All registered candidates across the Academy pipeline"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Students']]">
    <x-slot:actions>
        <a href="{{ route('academy.registration-links.index') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="link" style="width:14px;height:14px"></i>Reg. Links
        </a>
        <a href="{{ route('academy.students.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>Register Student
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['22','New Enquiries','user','slate'],['134','Active Students','users','violet'],['18','Enrolled','check-circle','emerald'],['8','Closed / Withdrawn','x-circle','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="stu-search" type="text" class="search-input" placeholder="Search name, NIC, ID, phone…">
            </div>
            <select id="stu-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="enquiry">Enquiry</option>
                <option value="enrolled">Enrolled</option>
                <option value="active">Active Training</option>
                <option value="completed">Completed</option>
                <option value="withdrawn">Withdrawn</option>
                <option value="closed">Closed</option>
            </select>
            <select id="stu-source" class="form-select" style="width:auto">
                <option value="">All Sources</option>
                <option value="walk_in">Walk-in</option>
                <option value="employment">Foreign Employment</option>
                <option value="consultancy">Consultancy</option>
                <option value="referral">Referral</option>
                <option value="link">Registration Link</option>
            </select>
            <select id="stu-handler" class="form-select" style="width:auto">
                <option value="">All Handlers</option>
                <option>Kasun Bandara</option><option>Nimal Jayawardena</option><option>Priya Hewage</option>
            </select>
            <button id="clear-stu" class="btn btn-ghost btn-sm"><i data-lucide="x" style="width:14px;height:14px"></i>Clear</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><div class="text-sm text-slate-500"><strong>162</strong> students</div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student ID</th><th>Name</th><th>NIC</th><th>Phone</th><th>Source</th><th>Course(s)</th><th>Handler</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $students=[
                    ['ACD-1001','Kamal Pradeep','199812304512','0771234567','Employment','Pre-Departure (WH)','Kasun B.','completed'],
                    ['ACD-1002','Nimesha Silva','200012308944','0762345678','Walk-in','English Comm.','Priya H.','completed'],
                    ['ACD-1003','Samantha Perera','199703201234','0754321098','Employment','Pre-Departure (WH)','Kasun B.','active'],
                    ['ACD-1004','Thilina Jayawardena','199905103456','0761234567','Referral','Pre-Departure (WH)','Nimal J.','enrolled'],
                    ['ACD-1005','Dulani Wickramasinghe','200104207890','0773456789','Walk-in','Arabic Language','Priya H.','active'],
                    ['ACD-1006','Asanka Fernando','199801107123','0752345678','Employment','Pre-Departure (HOS)','Kasun B.','enrolled'],
                    ['ACD-1007','Chamari Ranasinghe','200203106789','0771234987','Consultancy','Hospitality Service','Priya H.','active'],
                    ['ACD-1008','Roshan Dissanayake','199506209012','0763456890','Link','Computer Literacy','Nimal J.','enquiry'],
                    ['ACD-1009','Malinda Seneviratne','199911203345','0754567012','Employment','Pre-Departure (HOS)','Kasun B.','withdrawn'],
                    ['ACD-1010','Tharanga Kumara','200007108901','0762456789','Walk-in','English Comm.','Priya H.','active'],
                ];
                @endphp
                @foreach($students as $s)
                <tr class="stu-row" data-status="{{ $s[7] }}">
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-xs font-mono text-indigo-600">{{ $s[0] }}</a></td>
                    <td>
                        <a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s[1] }}</a>
                        @if(in_array($s[4],['Employment','Consultancy']))
                        <span class="badge badge-lead text-xs ml-1">{{ $s[4] }}</span>
                        @endif
                    </td>
                    <td class="font-mono text-xs text-slate-600">{{ $s[2] }}</td>
                    <td class="text-sm text-slate-600">{{ $s[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $s[4] }}</td>
                    <td class="text-sm text-slate-700">{{ $s[5] }}</td>
                    <td class="text-sm text-slate-500">{{ $s[6] }}</td>
                    <td><x-status-badge :status="$s[7]" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('academy.students.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('stu-search'),st=document.getElementById('stu-status'),clr=document.getElementById('clear-stu');
    const rows=document.querySelectorAll('tr.stu-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
    clr?.addEventListener('click',()=>{s.value='';st.value='';filter();});
});
</script>
</x-layouts.app>
