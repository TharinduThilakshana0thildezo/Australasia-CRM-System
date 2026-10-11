<x-layouts.app title="Academy Dashboard">

<x-page-header
    title="Academy"
    subtitle="Courses, batches, attendance, exams and certificates management"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>'#','label'=>'Academy']]">
    <x-slot:actions>
        <a href="{{ route('academy.students.create') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>Register Student
        </a>
        <a href="{{ route('academy.courses.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Course
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

{{-- ======= PENDING BUSINESS RULES ======= --}}
<div class="alert alert-warning mb-5">
    <i data-lucide="alert-triangle" style="width:20px;height:20px;flex-shrink:0"></i>
    <div>
        <strong>⚠ Business Rules Pending Confirmation</strong>
        <p class="text-sm mt-1">The following Academy workflow rules are flagged as "to be confirmed" by management:
        (1) Attendance eligibility % for exam access — <a href="{{ route('academy.settings') }}" class="underline font-semibold">configure in Settings</a>.
        (2) Unpaid enrollment seat hold policy — <a href="{{ route('academy.settings') }}" class="underline font-semibold">configure in Settings</a>.
        (3) Fee refund/retention on withdrawal — <a href="{{ route('academy.settings') }}" class="underline font-semibold">configure in Settings</a>.
        </p>
    </div>
</div>

{{-- KPI Row 1: Pipeline --}}
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-3 mb-5">
    @php $kpis = [
        ['22','Enquiries','user','slate',route('academy.students.index')],
        ['134','Active Students','users','violet',route('academy.students.index')],
        ['12','Active Courses','book-open','indigo',route('academy.courses.index')],
        ['8','Running Batches','layers','cyan',route('academy.batches.index')],
        ['18','Fee Pending','credit-card','amber',route('academy.payments.index')],
        ['7','Below Attendance','alert-triangle','rose',route('academy.attendance.index')],
        ['4','Exams Upcoming','file-check','blue',route('academy.exams.index')],
        ['189','Certs Issued','award','emerald',route('academy.certificates.index')],
    ]; @endphp
    @foreach($kpis as $k)
    <a href="{{ $k[4] }}" class="stat-card hover:shadow-md transition-shadow">
        <div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-5 h-5 text-{{ $k[3] }}-600"></i></div>
        <div class="stat-value">{{ $k[0] }}</div>
        <div class="stat-label">{{ $k[1] }}</div>
    </a>
    @endforeach
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    {{-- Running Batches --}}
    <div class="xl:col-span-2 card">
        <div class="card-header">
            <h3 class="card-title">Running Batches</h3>
            <a href="{{ route('academy.batches.index') }}" class="text-sm text-indigo-600 font-semibold">View all →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Batch</th><th>Course</th><th>Trainer</th><th>Students</th><th>Progress</th><th>End</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @php
                    $batches=[
                        ['BCH-2026-001','Pre-Departure Training — Warehouse','Mr. Rupasinghe',24,14,'15 Oct 2026','active'],
                        ['BCH-2026-002','English Communication (Intermediate)','Ms. Jayasiri',18,6,'20 Oct 2026','active'],
                        ['BCH-2026-003','Computer Literacy — Basic','Mr. Dissanayake',30,15,'28 Oct 2026','active'],
                        ['BCH-2026-004','Arabic Language (Beginners)','Ms. Hathuma',12,8,'05 Nov 2026','active'],
                        ['BCH-2026-005','Hospitality Service Training','Mr. Perera',22,10,'10 Nov 2026','active'],
                    ];
                    @endphp
                    @foreach($batches as $b)
                    @php $pct = round($b[4]/$b[3]*100); @endphp
                    <tr>
                        <td><code class="text-xs font-mono text-indigo-600">{{ $b[0] }}</code></td>
                        <td class="text-sm font-semibold text-slate-800">{{ $b[1] }}</td>
                        <td class="text-sm text-slate-600">{{ $b[2] }}</td>
                        <td class="text-sm font-bold text-slate-800">{{ $b[3] }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="progress-bar-track w-16"><div class="progress-bar-fill bg-indigo-500" style="width:{{ $pct }}%"></div></div>
                                <span class="text-xs text-slate-500">{{ $b[4] }}/{{ $b[3] }} sessions</span>
                            </div>
                        </td>
                        <td class="text-xs text-slate-500">{{ $b[5] }}</td>
                        <td><x-status-badge :status="$b[6]" /></td>
                        <td><a href="{{ route('academy.batches.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Action Required --}}
    <div class="space-y-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Action Required</h3></div>
            <div class="card-body space-y-3">
                @foreach([
                    ['rose','alert-triangle','7 students below attendance threshold','academy.attendance.index'],
                    ['amber','credit-card','18 fee payments pending','academy.payments.index'],
                    ['amber','inbox','4 waitlisted students','academy.enrollments.index'],
                    ['blue','file-check','3 exams: marks not entered','academy.exams.index'],
                    ['emerald','award','6 certificates ready to issue','academy.certificates.index'],
                    ['rose','clock','2 re-sit exams pending scheduling','academy.exams.index'],
                ] as $item)
                <a href="{{ route($item[3]) }}" class="flex items-center gap-3 p-2.5 rounded-xl bg-{{ $item[0] }}-50 border border-{{ $item[0] }}-200 hover:bg-{{ $item[0] }}-100 transition-colors group">
                    <i data-lucide="{{ $item[2-1] }}" class="w-4 h-4 text-{{ $item[0] }}-600 flex-shrink-0"></i>
                    <span class="text-sm text-{{ $item[0] }}-800 font-medium">{{ $item[2] }}</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-{{ $item[0] }}-600 ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    {{-- Upcoming Exams --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Upcoming Exams</h3><a href="{{ route('academy.exams.index') }}" class="text-sm text-indigo-600 font-semibold">View all →</a></div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Exam</th><th>Batch</th><th>Date</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @foreach([
                        ['EXM-2026-001','Pre-Departure Final','BCH-2026-001','15 Oct 2026','scheduled'],
                        ['EXM-2026-002','English Assessment 2','BCH-2026-002','18 Oct 2026','scheduled'],
                        ['EXM-2026-003','Computer Skills Test','BCH-2026-003','25 Oct 2026','draft'],
                        ['EXM-2026-004','Arabic Oral Exam','BCH-2026-004','01 Nov 2026','draft'],
                    ] as $e)
                    <tr>
                        <td><span class="text-xs font-mono text-indigo-600">{{ $e[0] }}</span><p class="text-sm font-semibold text-slate-800">{{ $e[1] }}</p></td>
                        <td class="text-xs text-slate-500">{{ $e[2] }}</td>
                        <td class="text-xs text-slate-500">{{ $e[3] }}</td>
                        <td><x-status-badge :status="$e[4]" /></td>
                        <td><a href="{{ route('academy.exams.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Certificates --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Recently Issued Certificates</h3><a href="{{ route('academy.certificates.index') }}" class="text-sm text-indigo-600 font-semibold">View all →</a></div>
        <div class="card-body space-y-3">
            @foreach([
                ['Kamal Pradeep','Pre-Departure Training','CERT-ACD-A8F2','08 Oct 2026','Employment'],
                ['Nimesha Silva','English Communication','CERT-ACD-B3E9','07 Oct 2026','Employment'],
                ['Chamara Bandara','Computer Literacy','CERT-ACD-C7D1','05 Oct 2026','Academy Only'],
                ['Ruwan Jayawardena','Hospitality Training','CERT-ACD-D4F8','04 Oct 2026','Employment'],
            ] as $c)
            <div class="flex items-center gap-3 py-2 border-b border-slate-50 last:border-0">
                <div class="avatar avatar-sm avatar-violet">{{ strtoupper(substr($c[0],0,2)) }}</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800">{{ $c[0] }}</p>
                    <p class="text-xs text-slate-400">{{ $c[1] }} · <span class="font-mono">{{ $c[2] }}</span></p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">{{ $c[3] }}</p>
                    <span class="badge badge-approved text-xs">{{ $c[4] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Cross-Module Banner --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cross-Module Integration</h3>
        <div class="flex gap-2">
            <span class="stream-badge stream-employment">Foreign Employment</span>
            <span class="stream-badge stream-consultancy">Consultancy</span>
        </div>
    </div>
    <div class="card-body">
        <div class="alert alert-info mb-4">
            <i data-lucide="link" style="width:18px;height:18px;flex-shrink:0"></i>
            <div class="text-sm">
                <strong>Shared Identity System:</strong> Academy students are matched to existing Foreign Employment candidates and Consultancy students via NIC/phone. No duplicate profiles are created. Academy completions feed pre-departure training certificates back to the Employment pipeline.
            </div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-center">
            @foreach([['89','Employment-linked Enrollments','cyan'],['71','Certificates → Employment','emerald'],['71','Returned to Talent Pool','indigo'],['18','Consultancy Referrals','violet']] as $s)
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-2xl font-extrabold text-{{ $s[2] }}-600">{{ $s[0] }}</div>
                <div class="text-xs text-slate-500 mt-1 font-medium">{{ $s[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
