<x-layouts.app title="Consultancy Dashboard">

<x-page-header
    title="Consultancy"
    subtitle="Study abroad advisory — student journey from lead to university enrollment"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Consultancy']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.leads.create') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>
            New Lead
        </a>
        <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            Register Student
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4">
    <i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>
    {{ session('success') }}
</div>
@endif

{{-- ========== KPI CARDS ========== --}}
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-3 mb-6">
    @php
    $kpis = [
        ['v'=>22,  'l'=>'Leads',            'ic'=>'user',           'col'=>'slate',  'href'=>route('consultancy.leads.index')],
        ['v'=>89,  'l'=>'Active Students',  'ic'=>'users',          'col'=>'violet', 'href'=>route('consultancy.students.index')],
        ['v'=>14,  'l'=>'Reg. Fee Pending', 'ic'=>'credit-card',    'col'=>'amber',  'href'=>route('consultancy.payments.index')],
        ['v'=>23,  'l'=>'Docs Awaiting Review','ic'=>'file-check',  'col'=>'orange', 'href'=>route('consultancy.documents.review')],
        ['v'=>34,  'l'=>'Applications',     'ic'=>'file-text',      'col'=>'cyan',   'href'=>route('consultancy.applications.index')],
        ['v'=>11,  'l'=>'Offers Pending',   'ic'=>'inbox',          'col'=>'indigo', 'href'=>route('consultancy.offers.index')],
        ['v'=>18,  'l'=>'Visa In Progress', 'ic'=>'shield',         'col'=>'violet', 'href'=>route('consultancy.visas.index')],
        ['v'=>12,  'l'=>'Enrolled',         'ic'=>'graduation-cap', 'col'=>'emerald','href'=>route('consultancy.enrollment.index')],
    ];
    @endphp
    @foreach($kpis as $k)
    <a href="{{ $k['href'] }}" class="stat-card no-underline group" style="cursor:pointer">
        <div class="stat-accent" style="background:{{ ['slate'=>'#64748b','violet'=>'#8b5cf6','amber'=>'#f59e0b','orange'=>'#f97316','cyan'=>'#06b6d4','indigo'=>'#6366f1','emerald'=>'#10b981'][$k['col']] ?? '#6366f1' }}"></div>
        <div class="stat-icon bg-{{ $k['col'] }}-100 mb-2">
            <i data-lucide="{{ $k['ic'] }}" class="w-5 h-5 text-{{ $k['col'] }}-600"></i>
        </div>
        <div class="stat-value group-hover:text-indigo-600 transition-colors">{{ $k['v'] }}</div>
        <div class="stat-label">{{ $k['l'] }}</div>
    </a>
    @endforeach
</div>

{{-- ========== PIPELINE STRIP ========== --}}
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Consultancy Journey Pipeline</h3>
        <span class="text-xs text-slate-500">Active cases by phase</span>
    </div>
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <div class="flex min-w-max">
                @php
                $pipeline = [
                    ['label'=>'Lead',         'count'=>22, 'color'=>'#64748b', 'route'=>'consultancy.leads.index'],
                    ['label'=>'Registered',   'count'=>89, 'color'=>'#8b5cf6', 'route'=>'consultancy.students.index'],
                    ['label'=>'Fee Pending',  'count'=>14, 'color'=>'#f59e0b', 'route'=>'consultancy.payments.index'],
                    ['label'=>'Docs Review',  'count'=>23, 'color'=>'#f97316', 'route'=>'consultancy.documents.review'],
                    ['label'=>'Counselling',  'count'=>41, 'color'=>'#6366f1', 'route'=>'consultancy.counselling.index'],
                    ['label'=>'Shortlisted',  'count'=>28, 'color'=>'#3b82f6', 'route'=>'consultancy.shortlists.index'],
                    ['label'=>'Applied',      'count'=>34, 'color'=>'#06b6d4', 'route'=>'consultancy.applications.index'],
                    ['label'=>'Offer',        'count'=>19, 'color'=>'#10b981', 'route'=>'consultancy.offers.index'],
                    ['label'=>'Visa',         'count'=>18, 'color'=>'#a855f7', 'route'=>'consultancy.visas.index'],
                    ['label'=>'Registration', 'count'=>8,  'color'=>'#14b8a6', 'route'=>'consultancy.registrations.index'],
                    ['label'=>'Enrolled',     'count'=>12, 'color'=>'#22c55e', 'route'=>'consultancy.enrollment.index'],
                    ['label'=>'Closed',       'count'=>6,  'color'=>'#f43f5e', 'route'=>'consultancy.students.index'],
                ];
                @endphp
                @foreach($pipeline as $stage)
                <a href="{{ route($stage['route']) }}" class="flex items-center no-underline group px-1">
                    <div class="text-center px-4 py-5 min-w-[90px]">
                        <div class="text-2xl font-extrabold group-hover:scale-110 transition-transform" style="color:{{ $stage['color'] }}">{{ $stage['count'] }}</div>
                        <div class="text-xs text-slate-500 font-medium mt-1 leading-snug">{{ $stage['label'] }}</div>
                        <div class="mt-2 h-1 rounded-full mx-2 transition-opacity group-hover:opacity-100 opacity-50" style="background:{{ $stage['color'] }}"></div>
                    </div>
                    @if(!$loop->last)<span class="text-slate-300 text-xl font-light flex-shrink-0">›</span>@endif
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ========== CHARTS + ATTENTION ========== --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    {{-- Trend Chart --}}
    <div class="card xl:col-span-2">
        <div class="card-header">
            <div>
                <h3 class="card-title">Student Registrations & Enrollments</h3>
                <p class="text-xs text-slate-500">Last 6 months trend</p>
            </div>
        </div>
        <div class="card-body">
            <canvas id="conTrendChart" height="200"></canvas>
        </div>
    </div>

    {{-- Attention Items --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Needs Attention</h3>
            <span class="badge badge-refund">Action required</span>
        </div>
        <div class="card-body">
            @php
            $attention = [
                ['l'=>'Reg. Fee Overdue (7d+)',   'n'=>7,  'col'=>'bg-amber-100 text-amber-700',   'ic'=>'credit-card',    'r'=>'consultancy.payments.index'],
                ['l'=>'Documents: Correction Req','n'=>11, 'col'=>'bg-orange-100 text-orange-700', 'ic'=>'file-x',         'r'=>'consultancy.documents.review'],
                ['l'=>'Counselling Sessions Due', 'n'=>9,  'col'=>'bg-blue-100 text-blue-700',     'ic'=>'calendar',       'r'=>'consultancy.counselling.index'],
                ['l'=>'Conditional Offer Pending','n'=>5,  'col'=>'bg-violet-100 text-violet-700', 'ic'=>'inbox',          'r'=>'consultancy.offers.index'],
                ['l'=>'Offer Deadline <7 Days',   'n'=>3,  'col'=>'bg-rose-100 text-rose-700',     'ic'=>'clock',          'r'=>'consultancy.offers.index'],
                ['l'=>'Visa Decisions Overdue',   'n'=>2,  'col'=>'bg-rose-100 text-rose-700',     'ic'=>'shield-x',       'r'=>'consultancy.visas.index'],
                ['l'=>'Final Payment Outstanding','n'=>6,  'col'=>'bg-amber-100 text-amber-700',   'ic'=>'banknote',       'r'=>'consultancy.payments.index'],
                ['l'=>'Expired Reg. Links',       'n'=>4,  'col'=>'bg-slate-100 text-slate-600',   'ic'=>'link-2-off',     'r'=>'consultancy.registration-links.index'],
            ];
            @endphp
            <div class="space-y-2">
                @foreach($attention as $a)
                <a href="{{ route($a['r']) }}" class="flex items-center gap-3 p-2.5 rounded-lg {{ $a['col'] }} hover:opacity-80 transition-opacity no-underline">
                    <i data-lucide="{{ $a['ic'] }}" style="width:15px;height:15px;flex-shrink:0"></i>
                    <span class="text-sm font-medium flex-1">{{ $a['l'] }}</span>
                    <span class="text-sm font-bold">{{ $a['n'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- ========== ROW 2: SOURCE + COUNTRY + RECENT ========== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    {{-- Source Breakdown --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Student Sources</h3></div>
        <div class="card-body"><canvas id="conSourceChart" height="210"></canvas></div>
    </div>

    {{-- Country Preference --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Preferred Destinations</h3></div>
        <div class="card-body">
            @php
            $countries = [
                ['name'=>'Australia',   'pct'=>34, 'color'=>'#6366f1'],
                ['name'=>'UK',          'pct'=>22, 'color'=>'#8b5cf6'],
                ['name'=>'Canada',      'pct'=>18, 'color'=>'#10b981'],
                ['name'=>'New Zealand', 'pct'=>12, 'color'=>'#06b6d4'],
                ['name'=>'USA',         'pct'=>8,  'color'=>'#f59e0b'],
                ['name'=>'Other',       'pct'=>6,  'color'=>'#e2e8f0'],
            ];
            @endphp
            <div class="space-y-3">
                @foreach($countries as $c)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-600 font-medium">{{ $c['name'] }}</span>
                        <span class="font-bold text-slate-800">{{ $c['pct'] }}%</span>
                    </div>
                    <div class="progress-bar-track">
                        <div class="progress-bar-fill" style="width:{{ $c['pct'] }}%;background:{{ $c['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- New Today --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">New Today</h3>
            <a href="{{ route('consultancy.students.index') }}" class="text-xs text-indigo-600 font-semibold">View all</a>
        </div>
        <div class="card-body p-0">
            @php
            $newStudents = [
                ['name'=>'Sachini Ranasinghe',    'id'=>'CON-0091', 'source'=>'Walk-in',  'time'=>'09:22'],
                ['name'=>'Kavinda Gunasekara',     'id'=>'CON-0090', 'source'=>'Referral', 'time'=>'11:05'],
                ['name'=>'Nimasha Wickramasinghe', 'id'=>'CON-0089', 'source'=>'Online',   'time'=>'13:40'],
                ['name'=>'Tharaka Perera',         'id'=>'CON-0088', 'source'=>'Agent',    'time'=>'15:15'],
            ];
            @endphp
            <div class="divide-y divide-slate-50">
                @foreach($newStudents as $s)
                <a href="{{ route('consultancy.students.show', 1) }}"
                   class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors no-underline">
                    <div class="avatar avatar-sm avatar-violet">{{ substr($s['name'],0,2) }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $s['name'] }}</p>
                        <p class="text-xs text-slate-500">{{ $s['id'] }} · {{ $s['source'] }}</p>
                    </div>
                    <span class="text-xs text-slate-400">{{ $s['time'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- ========== RECENT ACTIVITY ========== --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Consultancy Activity</h3>
        <a href="{{ route('consultancy.students.index') }}" class="text-sm text-indigo-600 font-medium">View all →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>Student</th><th>Event</th><th>Details</th><th>Handler</th><th>Time</th><th>Status</th>
            </tr></thead>
            <tbody>
                @php
                $activities = [
                    ['name'=>'Sachini Ranasinghe',    'id'=>'CON-0089', 'event'=>'Visa Approved',           'detail'=>'Australia Student Visa (Subclass 500)',  'handler'=>'Priya H.',  'time'=>'12 min ago',  'status'=>'visa_approved'],
                    ['name'=>'Kavinda Gunasekara',     'id'=>'CON-0088', 'event'=>'Offer Accepted',          'detail'=>'University of Manchester — MBA',         'handler'=>'Amila P.',  'time'=>'1h ago',      'status'=>'approved'],
                    ['name'=>'Thisara Wickramasinghe', 'id'=>'CON-0087', 'event'=>'Document Correction',     'detail'=>'Degree Certificate — correction required','handler'=>'Kasun B.', 'time'=>'2h ago',      'status'=>'correction_required'],
                    ['name'=>'Dinusha Jayasena',       'id'=>'CON-0086', 'event'=>'Counselling Completed',   'detail'=>'Study plan agreed — New Zealand, Business','handler'=>'Nimal J.','time'=>'3h ago',      'status'=>'in_progress'],
                    ['name'=>'Amara Dissanayake',      'id'=>'CON-0085', 'event'=>'Registration Fee Paid',   'detail'=>'LKR 25,000 — Bank Transfer',             'handler'=>'Amila P.',  'time'=>'Yesterday',   'status'=>'paid'],
                    ['name'=>'Ruwan Bandara',          'id'=>'CON-0084', 'event'=>'Enrolled — Journey Done', 'detail'=>'Monash University, Bachelor of IT',      'handler'=>'Priya H.',  'time'=>'Yesterday',   'status'=>'approved'],
                ];
                @endphp
                @foreach($activities as $row)
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-violet">{{ substr($row['name'],0,2) }}</div>
                            <div>
                                <a href="{{ route('consultancy.students.show', 1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $row['name'] }}</a>
                                <p class="text-xs text-slate-400">{{ $row['id'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td><span class="text-sm font-medium text-slate-700">{{ $row['event'] }}</span></td>
                    <td class="text-sm text-slate-500">{{ $row['detail'] }}</td>
                    <td class="text-sm text-slate-500">{{ $row['handler'] }}</td>
                    <td class="text-xs text-slate-400 whitespace-nowrap">{{ $row['time'] }}</td>
                    <td><x-status-badge :status="$row['status']" /></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trend Chart
    new Chart(document.getElementById('conTrendChart'), {
        type: 'line',
        data: {
            labels: ['May','Jun','Jul','Aug','Sep','Oct'],
            datasets: [
                { label:'New Students',  data:[18,22,31,28,35,42], borderColor:'#8b5cf6', backgroundColor:'rgba(139,92,246,0.08)', fill:true, tension:0.4, pointRadius:4, pointBackgroundColor:'#8b5cf6' },
                { label:'Enrollments',   data:[4,6,8,9,10,12],     borderColor:'#10b981', backgroundColor:'rgba(16,185,129,0.08)', fill:true, tension:0.4, pointRadius:4, pointBackgroundColor:'#10b981' },
                { label:'Closed Cases',  data:[1,2,1,3,2,2],       borderColor:'#f43f5e', backgroundColor:'rgba(244,63,94,0.05)',  fill:true, tension:0.4, pointRadius:4, pointBackgroundColor:'#f43f5e' },
            ]
        },
        options: {
            responsive:true,
            plugins:{ legend:{ position:'bottom', labels:{ font:{ family:'Inter', size:12 } } } },
            scales:{ y:{ beginAtZero:true, grid:{ color:'rgba(0,0,0,0.04)' } }, x:{ grid:{ display:false } } }
        }
    });

    // Source Doughnut
    new Chart(document.getElementById('conSourceChart'), {
        type:'doughnut',
        data:{
            labels:['Walk-in','Referral','Online Enquiry','Agent','Social Media'],
            datasets:[{ data:[28,32,20,14,6], backgroundColor:['#8b5cf6','#10b981','#6366f1','#f59e0b','#06b6d4'], borderWidth:3, borderColor:'#fff' }]
        },
        options:{ responsive:true, cutout:'60%', plugins:{ legend:{ position:'bottom', labels:{ font:{ family:'Inter', size:11 } } } } }
    });

    lucide.createIcons();
});
</script>

</x-layouts.app>
