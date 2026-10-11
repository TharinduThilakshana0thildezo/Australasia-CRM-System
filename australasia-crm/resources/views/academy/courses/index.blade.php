<x-layouts.app title="Courses — Academy">

<x-page-header
    title="Course Catalogue"
    subtitle="Manage all Academy courses — active, paused, and archived"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Courses']]">
    <x-slot:actions>
        <a href="{{ route('academy.courses.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Course
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['12','Active Courses','book-open','emerald'],['2','Paused','pause-circle','amber'],['3','Archived','archive','slate'],['8','Running Batches','layers','indigo']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="course-search" type="text" class="search-input" placeholder="Search course name, code…">
            </div>
            <select id="course-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="paused">Paused</option>
                <option value="archived">Archived</option>
            </select>
            <select id="course-type" class="form-select" style="width:auto">
                <option value="">All Types</option>
                <option value="pre_departure">Pre-Departure</option>
                <option value="language">Language</option>
                <option value="skills">Skills Training</option>
                <option value="it">IT / Computer</option>
                <option value="hospitality">Hospitality</option>
            </select>
            <button id="clear-filters" class="btn btn-ghost btn-sm"><i data-lucide="x" style="width:14px;height:14px"></i>Clear</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><div class="text-sm text-slate-500">Showing <strong>17</strong> courses</div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Code</th><th>Course Name</th><th>Type</th><th>Duration</th><th>Fee</th><th>Capacity</th><th>Active Batches</th><th>Students</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $courses=[
                    ['PDT-WH','Pre-Departure Training — Warehouse','pre_departure','2 weeks','LKR 5,000',30,2,52,'active'],
                    ['PDT-HOS','Pre-Departure Training — Hospitality','pre_departure','3 weeks','LKR 6,000',25,2,44,'active'],
                    ['PDT-CAR','Pre-Departure Training — Care Work','pre_departure','2 weeks','LKR 5,000',25,1,18,'active'],
                    ['ENG-INT','English Communication (Intermediate)','language','6 weeks','LKR 12,000',20,1,18,'active'],
                    ['ENG-ADV','English Communication (Advanced)','language','8 weeks','LKR 15,000',15,1,14,'active'],
                    ['ARA-BEG','Arabic Language (Beginners)','language','8 weeks','LKR 14,000',15,1,12,'active'],
                    ['ARA-INT','Arabic Language (Intermediate)','language','10 weeks','LKR 18,000',12,0,8,'active'],
                    ['CMP-BAS','Computer Literacy — Basic','it','4 weeks','LKR 8,000',30,1,30,'active'],
                    ['CMP-ADV','Computer Literacy — Advanced','it','6 weeks','LKR 12,000',20,0,11,'active'],
                    ['HOS-SRV','Hospitality Service Training','hospitality','4 weeks','LKR 10,000',20,1,22,'active'],
                    ['DRV-LIC','Defensive Driving & Safety','skills','1 week','LKR 3,500',15,0,5,'active'],
                    ['ELD-CAR','Elderly Care Basics','skills','3 weeks','LKR 7,500',12,0,6,'active'],
                    ['ENG-BEG','English Communication (Beginners)','language','4 weeks','LKR 9,000',20,0,19,'paused'],
                    ['PDT-FAC','Pre-Departure — Factory','pre_departure','2 weeks','LKR 5,000',30,0,24,'archived'],
                ];
                @endphp
                @foreach($courses as $c)
                <tr class="course-row" data-status="{{ $c[8] }}" data-type="{{ $c[2] }}">
                    <td><code class="text-xs font-mono text-indigo-600">{{ $c[0] }}</code></td>
                    <td><a href="{{ route('academy.courses.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $c[1] }}</a></td>
                    <td><span class="badge badge-lead text-xs">{{ ucwords(str_replace('_',' ',$c[2])) }}</span></td>
                    <td class="text-sm text-slate-600">{{ $c[3] }}</td>
                    <td class="text-sm font-semibold text-slate-700">{{ $c[4] }}</td>
                    <td class="text-sm text-slate-600">{{ $c[5] }}</td>
                    <td class="text-sm font-bold {{ $c[6]>0 ? 'text-emerald-600':'text-slate-400' }}">{{ $c[6] }}</td>
                    <td class="text-sm font-bold text-slate-800">{{ $c[7] }}</td>
                    <td><x-status-badge :status="$c[8]" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('academy.courses.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if($c[8] === 'active')
                            <a href="{{ route('academy.courses.edit',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="edit" style="width:13px;height:13px"></i></a>
                            <button onclick="openModal('pause-course-modal')" class="btn btn-outline btn-xs text-amber-600">Pause</button>
                            @elseif($c[8] === 'paused')
                            <form method="POST" action="{{ route('academy.courses.resume',1) }}">@csrf
                                <button type="submit" class="btn btn-success btn-xs">Resume</button>
                            </form>
                            <button onclick="openModal('archive-course-modal')" class="btn btn-outline btn-xs text-slate-600">Archive</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Pause Modal --}}
<div id="pause-course-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Pause Course</span><button onclick="closeModal('pause-course-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.courses.pause',1) }}">
            @csrf
            <div class="modal-body">
                <div class="alert alert-warning mb-3 text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Pausing will stop new enrollments. Running batches will continue unaffected.</div>
                <div class="form-group"><label class="form-label required">Reason for pausing</label><textarea name="pause_reason" rows="4" class="form-textarea" placeholder="Minimum 10 characters required…" required minlength="10"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('pause-course-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-warning">Pause Course</button></div>
        </form>
    </div>
</div>

{{-- Archive Modal --}}
<div id="archive-course-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Archive Course</span><button onclick="closeModal('archive-course-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.courses.archive',1) }}">
            @csrf
            <div class="modal-body">
                <div class="alert alert-warning mb-3 text-sm"><i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>Archiving is permanent. All historical data is preserved for reporting.</div>
                <div class="form-group"><label class="form-label required">Reason for archiving</label><textarea name="archive_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('archive-course-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger" onclick="return confirm('Archive this course? All historical data will be preserved.')">Archive Course</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('course-search'),st=document.getElementById('course-status'),ty=document.getElementById('course-type'),clr=document.getElementById('clear-filters');
    const rows=document.querySelectorAll('tr.course-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||''),type=(ty?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status)&&(!type||r.dataset.type===type);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);ty?.addEventListener('change',filter);
    clr?.addEventListener('click',()=>{s.value='';st.value='';ty.value='';filter();});
});
</script>
</x-layouts.app>
