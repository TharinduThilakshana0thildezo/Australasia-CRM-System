<x-layouts.app title="Pre-Departure Training — Warehouse">

<x-page-header
    title="Pre-Departure Training — Warehouse"
    subtitle="PDT-WH · Active · 2 running batches"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.courses.index'),'label'=>'Courses'],['url'=>'#','label'=>'PDT-WH']]">
    <x-slot:actions>
        <a href="{{ route('academy.courses.edit',1) }}" class="btn btn-secondary btn-sm"><i data-lucide="edit" style="width:14px;height:14px"></i>Edit</a>
        <button onclick="openModal('pause-course-modal')" class="btn btn-warning btn-sm"><i data-lucide="pause" style="width:14px;height:14px"></i>Pause</button>
        <a href="{{ route('academy.batches.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>New Batch</a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{tab:'overview'}">
    <div class="lg:col-span-2 space-y-5">
        {{-- Tabs --}}
        <div class="tab-bar">
            <button @click="tab='overview'" :class="tab==='overview'?'tab-active':'tab'" class="tab">Overview</button>
            <button @click="tab='modules'" :class="tab==='modules'?'tab-active':'tab'" class="tab">Modules</button>
            <button @click="tab='batches'" :class="tab==='batches'?'tab-active':'tab'" class="tab">Batches</button>
            <button @click="tab='students'" :class="tab==='students'?'tab-active':'tab'" class="tab">Students</button>
            <button @click="tab='history'" :class="tab==='history'?'tab-active':'tab'" class="tab">History</button>
        </div>

        {{-- Overview --}}
        <div x-show="tab==='overview'" class="space-y-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Course Details</h3><x-status-badge status="active" /></div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        @foreach([
                            ['Code','PDT-WH'],['Type','Pre-Departure Training'],['Duration','2 weeks (80 hours)'],
                            ['Fee','LKR 5,000'],['Currency','LKR'],['Capacity per Batch','30'],
                            ['Default Trainer','Mr. Rupasinghe'],['Linked Module','Foreign Employment'],['Created','05 Jan 2026'],
                        ] as $r)
                        <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <p class="text-xs text-slate-400 mb-1">Description</p>
                        <p class="text-sm text-slate-700">Mandatory pre-departure training for candidates placed in warehouse and logistics roles in the Middle East and South-East Asia. Covers workplace safety, equipment handling, workplace rights, and cultural orientation.</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-xs text-slate-400 mb-1">Prerequisites</p>
                        <p class="text-sm text-slate-600">Minimum O/L qualification. Must be an active Foreign Employment candidate with a confirmed job offer. Basic English literacy required.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modules --}}
        <div x-show="tab==='modules'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Course Modules</h3><span class="text-sm text-slate-500">80 hrs total</span></div>
            <div class="card-body">
                @foreach([
                    [1,'Workplace Safety & Hazard Awareness',16,'Mr. Rupasinghe'],
                    [2,'Equipment Handling & Ergonomics',12,'Mr. Rupasinghe'],
                    [3,'Workplace Rights, Contract & Labour Law',8,'Ms. Jayasiri'],
                    [4,'Cultural Orientation & Communication',12,'Ms. Jayasiri'],
                    [5,'Basic English for the Workplace',16,'Ms. Jayasiri'],
                    [6,'Emergency Procedures & First Aid',8,'Mr. Rupasinghe'],
                    [7,'Final Assessment & Graduation',8,'Mr. Rupasinghe'],
                ] as $m)
                <div class="flex items-center gap-4 py-3 border-b border-slate-50 last:border-0">
                    <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0">{{ $m[0] }}</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-slate-800">{{ $m[1] }}</p>
                        <p class="text-xs text-slate-400">Trainer: {{ $m[3] }}</p>
                    </div>
                    <span class="text-sm font-bold text-slate-700 flex-shrink-0">{{ $m[2] }}h</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Batches --}}
        <div x-show="tab==='batches'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Batches</h3><a href="{{ route('academy.batches.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>New Batch</a></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Batch</th><th>Trainer</th><th>Start</th><th>End</th><th>Students</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        @foreach([
                            ['BCH-2026-001','Mr. Rupasinghe','01 Oct 2026','15 Oct 2026',24,30,'active'],
                            ['BCH-2026-002','Mr. Rupasinghe','20 Oct 2026','03 Nov 2026',8,30,'scheduled'],
                            ['BCH-2026-003','Mr. Rupasinghe','01 Sep 2026','15 Sep 2026',30,30,'completed'],
                        ] as $b)
                        <tr>
                            <td><code class="text-xs font-mono text-indigo-600">{{ $b[0] }}</code></td>
                            <td class="text-sm text-slate-600">{{ $b[1] }}</td>
                            <td class="text-xs text-slate-500">{{ $b[2] }}</td>
                            <td class="text-xs text-slate-500">{{ $b[3] }}</td>
                            <td class="text-sm"><span class="font-bold">{{ $b[4] }}</span><span class="text-slate-400">/{{ $b[5] }}</span></td>
                            <td><x-status-badge :status="$b[6]" /></td>
                            <td><a href="{{ route('academy.batches.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Students --}}
        <div x-show="tab==='students'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">All Students on This Course</h3><span class="badge badge-approved">52 enrolled</span></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Batch</th><th>Attendance</th><th>Result</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        @foreach([
                            ['Kamal Pradeep','ACD-1001','BCH-2026-001','92%','Pass','completed'],
                            ['Nimesha Silva','ACD-1002','BCH-2026-001','78%','Pass','completed'],
                            ['Samantha Perera','ACD-1003','BCH-2026-001','—','Pending','active'],
                            ['Thilina Jayawardena','ACD-1004','BCH-2026-002','—','Pending','enrolled'],
                        ] as $s)
                        <tr>
                            <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s[0] }}</a><p class="text-xs text-slate-400">{{ $s[1] }}</p></td>
                            <td class="text-xs font-mono text-slate-500">{{ $s[2] }}</td>
                            <td class="text-sm font-semibold {{ (int)$s[3]<75 ? 'text-rose-600':'text-emerald-600' }}">{{ $s[3] }}</td>
                            <td class="text-sm text-slate-600">{{ $s[4] }}</td>
                            <td><x-status-badge :status="$s[5]" /></td>
                            <td><a href="{{ route('academy.students.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- History --}}
        <div x-show="tab==='history'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Course History</h3></div>
            <div class="card-body">
                <div class="timeline">
                    @foreach([
                        ['info','+','Course Created','05 Jan 2026','Admin. Initial setup: 2-week pre-departure training for warehouse roles. Fee: LKR 5,000.'],
                        ['info','~','Fee Updated','15 Mar 2026','Fee changed from LKR 4,500 to LKR 5,000. Authorized by director.'],
                        ['info','~','Default Trainer Assigned','01 May 2026','Mr. Rupasinghe assigned as default trainer.'],
                        ['info','+','Batch BCH-2026-003 Completed','15 Sep 2026','30 students completed. 28 passed. 2 re-sat and passed.'],
                    ] as $h)
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot-{{ $h[0] }}">{{ $h[1] }}</div>
                        <div class="timeline-content"><div class="timeline-title">{{ $h[2] }}</div><div class="timeline-meta">{{ $h[3] }}</div><div class="timeline-body">{{ $h[4] }}</div></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        @foreach([['52','Total Students','users','violet'],['189','Certificates Issued','award','emerald'],['2','Running Batches','layers','indigo'],['97%','Pass Rate','check-circle','teal']] as $k)
        <div class="stat-card"><div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-4 h-4 text-{{ $k[3] }}-600"></i></div><div class="stat-value text-xl">{{ $k[0] }}</div><div class="stat-label text-xs">{{ $k[1] }}</div></div>
        @endforeach
        <div class="card">
            <div class="card-header"><h3 class="card-title">Actions</h3></div>
            <div class="card-body space-y-2">
                <a href="{{ route('academy.batches.create') }}" class="btn btn-primary w-full btn-sm">New Batch</a>
                <a href="{{ route('academy.courses.edit',1) }}" class="btn btn-outline w-full btn-sm">Edit Course</a>
                <button onclick="openModal('pause-course-modal')" class="btn btn-warning w-full btn-sm">Pause Course</button>
            </div>
        </div>
    </div>
</div>

{{-- Pause Modal --}}
<div id="pause-course-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Pause Course</span><button onclick="closeModal('pause-course-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.courses.pause',1) }}">@csrf
            <div class="modal-body"><div class="alert alert-info mb-3 text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Running batches will NOT be affected.</div>
            <div class="form-group"><label class="form-label required">Reason</label><textarea name="pause_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div></div>
            <div class="modal-footer"><button type="button" onclick="closeModal('pause-course-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-warning">Pause</button></div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
