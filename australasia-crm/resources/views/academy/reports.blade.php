<x-layouts.app title="Reports — Academy">

<x-page-header
    title="Academy Reports"
    subtitle="Analytics, performance metrics, and exportable reports"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Reports']]">
    <x-slot:actions>
        <button onclick="window.print()" class="btn btn-secondary btn-sm"><i data-lucide="printer" style="width:14px;height:14px"></i>Print</button>
        <button onclick="exportReport()" class="btn btn-primary btn-sm"><i data-lucide="download" style="width:14px;height:14px"></i>Export Excel</button>
    </x-slot:actions>
</x-page-header>

<div class="card mb-5">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('academy.reports') }}">
            <div class="flex flex-wrap gap-3 items-center">
                <select name="report_type" id="report-type" class="form-select" style="width:auto">
                    <option value="overview">Overview Report</option>
                    <option value="enrollment">Enrollment Report</option>
                    <option value="attendance">Attendance Report</option>
                    <option value="exam">Exam & Results Report</option>
                    <option value="certificate">Certificate Report</option>
                    <option value="financial">Financial Report</option>
                    <option value="trainer">Trainer Performance</option>
                </select>
                <select name="period" class="form-select" style="width:auto">
                    <option value="this_month">This Month</option>
                    <option value="last_month">Last Month</option>
                    <option value="this_quarter" selected>This Quarter</option>
                    <option value="this_year">This Year</option>
                    <option value="custom">Custom Range</option>
                </select>
                <input name="date_from" type="date" class="form-input" style="width:140px" placeholder="From">
                <input name="date_to" type="date" class="form-input" style="width:140px" placeholder="To">
                <select name="course_id" class="form-select" style="width:auto">
                    <option value="">All Courses</option>
                    <option>Pre-Departure — Warehouse</option>
                    <option>English Communication</option>
                    <option>Arabic Language</option>
                    <option>Computer Literacy</option>
                    <option>Hospitality Service</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm"><i data-lucide="bar-chart-2" style="width:14px;height:14px"></i>Generate</button>
            </div>
        </form>
    </div>
</div>

{{-- Overview KPIs --}}
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-3 mb-6">
    @foreach([
        ['162','Total Students','users','violet'],
        ['134','Active','check-circle','emerald'],
        ['17','Courses','book-open','indigo'],
        ['16','Batches','layers','cyan'],
        ['189','Certs Issued','award','teal'],
        ['93%','Avg. Pass Rate','trending-up','blue'],
        ['88%','Avg. Attendance','clock','amber'],
        ['LKR 2.1M','Revenue','credit-card','rose'],
    ] as $k)
    <div class="stat-card">
        <div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-4 h-4 text-{{ $k[3] }}-600"></i></div>
        <div class="stat-value text-base">{{ $k[0] }}</div>
        <div class="stat-label text-xs">{{ $k[1] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    {{-- Enrollment by Course --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Enrollments by Course</h3><span class="text-xs text-slate-400">This Quarter</span></div>
        <div class="card-body space-y-3">
            @foreach([
                ['Pre-Departure — Warehouse',52,80,'indigo'],
                ['English Communication',32,50,'emerald'],
                ['Arabic Language',20,45,'amber'],
                ['Computer Literacy',30,30,'cyan'],
                ['Hospitality Service',22,45,'violet'],
                ['Pre-Departure — Hospitality',18,50,'rose'],
            ] as $c)
            @php $pct = round($c[1]/$c[2]*100); @endphp
            <div>
                <div class="flex justify-between mb-1 text-sm">
                    <span class="text-slate-700 font-medium">{{ $c[0] }}</span>
                    <span class="text-slate-500 font-bold">{{ $c[1] }} <span class="text-slate-400 font-normal">/ {{ $c[2] }} cap</span></span>
                </div>
                <div class="progress-bar-track"><div class="progress-bar-fill bg-{{ $c[3] }}-500" style="width:{{ $pct }}%"></div></div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Results Summary --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Exam Results Summary</h3><span class="text-xs text-slate-400">All Time</span></div>
        <div class="card-body">
            <div class="grid grid-cols-3 gap-4 text-center mb-5">
                <div class="bg-emerald-50 rounded-xl p-4"><p class="text-3xl font-extrabold text-emerald-600">93%</p><p class="text-xs text-slate-500 mt-1">Pass Rate</p></div>
                <div class="bg-indigo-50 rounded-xl p-4"><p class="text-3xl font-extrabold text-indigo-600">189</p><p class="text-xs text-slate-500 mt-1">Passed</p></div>
                <div class="bg-rose-50 rounded-xl p-4"><p class="text-3xl font-extrabold text-rose-600">14</p><p class="text-xs text-slate-500 mt-1">Failed</p></div>
            </div>
            <div class="space-y-3">
                @foreach([
                    ['1st Attempt',181,96,'emerald'],
                    ['Re-sit (2nd)',7,78,'amber'],
                    ['Re-sit (3rd)',1,50,'rose'],
                ] as $r)
                @php $pct = $r[2]; @endphp
                <div>
                    <div class="flex justify-between mb-1 text-sm"><span class="text-slate-700">{{ $r[0] }}</span><span class="font-bold text-{{ $r[3] }}-600">{{ $r[1] }} ({{ $pct }}%)</span></div>
                    <div class="progress-bar-track"><div class="progress-bar-fill bg-{{ $r[3] }}-500" style="width:{{ $pct }}%"></div></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Attendance Summary --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Attendance by Batch</h3><span class="text-xs text-slate-400">Running Batches</span></div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Batch</th><th>Avg. Attendance</th><th>Below Threshold</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach([
                        ['BCH-2026-001','88%',0,'active'],
                        ['BCH-2026-002','91%',0,'active'],
                        ['BCH-2026-003','79%',2,'active'],
                        ['BCH-2026-004','82%',1,'active'],
                        ['BCH-2026-005','85%',0,'active'],
                    ] as $b)
                    <tr>
                        <td class="text-xs font-mono text-slate-600">{{ $b[0] }}</td>
                        <td class="text-sm font-bold {{ (int)$b[1]<80?'text-amber-600':'text-emerald-600' }}">{{ $b[1] }}</td>
                        <td class="text-sm {{ $b[2]>0?'text-rose-600 font-bold':'text-slate-400' }}">{{ $b[2]>0?$b[2].' students':'—' }}</td>
                        <td><x-status-badge :status="$b[3]" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Financial Summary --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Financial Summary</h3><span class="text-xs text-slate-400">This Quarter</span></div>
        <div class="card-body">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-emerald-50 rounded-xl p-4"><p class="text-xl font-extrabold text-emerald-700">LKR 2.1M</p><p class="text-xs text-slate-500 mt-1">Fees Collected</p></div>
                <div class="bg-rose-50 rounded-xl p-4"><p class="text-xl font-extrabold text-rose-700">LKR 90K</p><p class="text-xs text-slate-500 mt-1">Outstanding</p></div>
            </div>
            <div class="space-y-2 text-sm">
                @foreach([
                    ['Pre-Departure — Warehouse','LKR 780,000','156 payments'],
                    ['English Communication','LKR 420,000','35 payments'],
                    ['Arabic Language','LKR 364,000','26 payments'],
                    ['Computer Literacy','LKR 280,000','35 payments'],
                ] as $f)
                <div class="flex justify-between items-center py-2 border-b border-slate-50 last:border-0">
                    <div><p class="font-semibold text-slate-700">{{ $f[0] }}</p><p class="text-xs text-slate-400">{{ $f[2] }}</p></div>
                    <span class="font-bold text-slate-800">{{ $f[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Cross-Module Impact --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Cross-Module Impact</h3></div>
    <div class="card-body">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            @foreach([
                ['89','Employment-linked Enrollments','indigo'],
                ['71','Employment Candidates Trained','emerald'],
                ['18','Consultancy Referrals','violet'],
                ['71%','Academy → Deployment Ready Pipeline','teal'],
            ] as $s)
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-2xl font-extrabold text-{{ $s[2] }}-600">{{ $s[0] }}</div>
                <div class="text-xs text-slate-500 mt-1 font-medium leading-tight">{{ $s[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function exportReport(){alert('Export functionality will be implemented in the backend controller. File: AcademyReportController@export');}
document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());
</script>
</x-layouts.app>
