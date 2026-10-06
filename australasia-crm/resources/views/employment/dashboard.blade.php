<x-layouts.app title="Foreign Employment Dashboard">

<x-page-header
    title="Foreign Employment"
    subtitle="Complete pipeline overview and operational metrics"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Employment']]">
    <x-slot:actions>
        <a href="{{ route('employment.candidates.create') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>
            Register Candidate
        </a>
        <a href="{{ route('employment.leads.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Lead
        </a>
    </x-slot:actions>
</x-page-header>

<!-- ========== KPI PIPELINE STRIP ========== -->
<div class="card mb-6">
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <div class="flex min-w-max">
                @php
                $pipeline = [
                    ['label' => 'Leads', 'count' => 84, 'color' => '#64748b', 'route' => 'employment.leads.index'],
                    ['label' => 'Registered', 'count' => 156, 'color' => '#3b82f6', 'route' => 'employment.candidates.index'],
                    ['label' => 'Docs Pending', 'count' => 98, 'color' => '#f59e0b', 'route' => 'employment.candidates.index'],
                    ['label' => 'Screening', 'count' => 44, 'color' => '#8b5cf6', 'route' => 'employment.candidates.index'],
                    ['label' => 'Ready', 'count' => 318, 'color' => '#10b981', 'route' => 'employment.talent-pool'],
                    ['label' => 'Talent Pool', 'count' => 276, 'color' => '#14b8a6', 'route' => 'employment.talent-pool'],
                    ['label' => 'Employer Review', 'count' => 47, 'color' => '#6366f1', 'route' => 'employment.applications.index'],
                    ['label' => 'Checklist', 'count' => 31, 'color' => '#8b5cf6', 'route' => 'employment.checklists.index'],
                    ['label' => 'Visa', 'count' => 67, 'color' => '#a855f7', 'route' => 'employment.visas.index'],
                    ['label' => 'Deployed', 'count' => 203, 'color' => '#22c55e', 'route' => 'employment.deployments.index'],
                    ['label' => 'Refund', 'count' => 14, 'color' => '#f43f5e', 'route' => 'employment.refunds.index'],
                ];
                @endphp

                @foreach($pipeline as $i => $stage)
                <a href="{{ route($stage['route']) }}"
                   class="flex items-center no-underline group px-1">
                    <div class="text-center px-4 py-5 min-w-[90px]">
                        <div class="text-2xl font-extrabold group-hover:scale-110 transition-transform"
                             style="color: {{ $stage['color'] }}">
                            {{ $stage['count'] }}
                        </div>
                        <div class="text-xs text-slate-500 font-medium mt-1 leading-snug">{{ $stage['label'] }}</div>
                        <div class="mt-2 h-1 rounded-full mx-2 transition-opacity group-hover:opacity-100 opacity-50"
                             style="background: {{ $stage['color'] }}"></div>
                    </div>
                    @if(!$loop->last)
                    <span class="text-slate-300 text-xl font-light flex-shrink-0">›</span>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- ========== CHARTS ROW ========== -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    <!-- Pipeline Trend -->
    <div class="card xl:col-span-2">
        <div class="card-header">
            <div>
                <h3 class="card-title">Candidate Registrations & Deployments</h3>
                <p class="text-xs text-slate-500">Last 6 months trend</p>
            </div>
        </div>
        <div class="card-body">
            <canvas id="empTrendChart" height="200"></canvas>
        </div>
    </div>

    <!-- Exception Summary -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Exceptions</h3>
            <span class="badge badge-refund">Needs attention</span>
        </div>
        <div class="card-body">
            @php
            $exceptions = [
                ['label' => 'Expired Reg. Links', 'count' => 3, 'color' => 'bg-amber-100 text-amber-700', 'icon' => 'link', 'route' => 'employment.registration-links.index'],
                ['label' => 'Missing Documents', 'count' => 18, 'color' => 'bg-orange-100 text-orange-700', 'icon' => 'file-x', 'route' => 'employment.candidates.index'],
                ['label' => 'Correction Pending', 'count' => 11, 'color' => 'bg-rose-100 text-rose-700', 'icon' => 'alert-triangle', 'route' => 'employment.candidates.index'],
                ['label' => 'Visa Delays', 'count' => 4, 'color' => 'bg-rose-100 text-rose-700', 'icon' => 'clock', 'route' => 'employment.visas.index'],
                ['label' => 'Refund Cases', 'count' => 14, 'color' => 'bg-rose-100 text-rose-700', 'icon' => 'rotate-ccw', 'route' => 'employment.refunds.index'],
                ['label' => 'Unresponsive', 'count' => 7, 'color' => 'bg-slate-100 text-slate-600', 'icon' => 'user-x', 'route' => 'employment.candidates.index'],
            ];
            @endphp
            <div class="space-y-2">
                @foreach($exceptions as $ex)
                <a href="{{ route($ex['route']) }}"
                   class="flex items-center gap-3 p-2.5 rounded-lg {{ $ex['color'] }} hover:opacity-80 transition-opacity no-underline">
                    <i data-lucide="{{ $ex['icon'] }}" style="width:16px;height:16px;flex-shrink:0"></i>
                    <span class="text-sm font-medium flex-1">{{ $ex['label'] }}</span>
                    <span class="text-sm font-bold">{{ $ex['count'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

<!-- ========== SECOND CHARTS ROW ========== -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    <!-- Source breakdown -->
    <div class="card">
        <div class="card-header"><h3 class="card-title">Candidate Sources</h3></div>
        <div class="card-body">
            <canvas id="sourceChart" height="200"></canvas>
        </div>
    </div>

    <!-- Country preference -->
    <div class="card">
        <div class="card-header"><h3 class="card-title">Country Preference</h3></div>
        <div class="card-body">
            @php
            $countries = [
                ['name' => 'Australia', 'pct' => 38, 'color' => '#6366f1'],
                ['name' => 'UAE', 'pct' => 22, 'color' => '#10b981'],
                ['name' => 'Qatar', 'pct' => 15, 'color' => '#f59e0b'],
                ['name' => 'Kuwait', 'pct' => 12, 'color' => '#06b6d4'],
                ['name' => 'Malaysia', 'pct' => 8, 'color' => '#8b5cf6'],
                ['name' => 'Other', 'pct' => 5, 'color' => '#e2e8f0'],
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
                        <div class="progress-bar-fill" style="width:{{ $c['pct'] }}%; background: {{ $c['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent registrations -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">New Today</h3>
            <a href="{{ route('employment.candidates.index') }}" class="text-xs text-indigo-600 font-semibold">View all</a>
        </div>
        <div class="card-body p-0">
            @php
            $newCandidates = [
                ['name' => 'Thilini Madushan', 'source' => 'Walk-in', 'time' => '09:14', 'code' => 'CAND-1298'],
                ['name' => 'Pradeep Kumara', 'source' => 'Referral', 'time' => '10:30', 'code' => 'CAND-1299'],
                ['name' => 'Amara Dissanayake', 'source' => 'Online', 'time' => '11:02', 'code' => 'CAND-1300'],
                ['name' => 'Roshan Wijesinghe', 'source' => 'Agent', 'time' => '13:15', 'code' => 'CAND-1301'],
            ];
            @endphp
            <div class="divide-y divide-slate-50">
                @foreach($newCandidates as $c)
                <a href="{{ route('employment.candidates.index') }}"
                   class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors no-underline">
                    <div class="avatar avatar-sm avatar-indigo">{{ substr($c['name'], 0, 2) }}</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $c['name'] }}</p>
                        <p class="text-xs text-slate-500">{{ $c['code'] }} · {{ $c['source'] }}</p>
                    </div>
                    <span class="text-xs text-slate-400">{{ $c['time'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </div>

</div>

<!-- ========== RECENT ACTIVITY ========== -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Employment Activity</h3>
        <a href="#" class="text-sm text-indigo-600 font-medium">View all</a>
    </div>
    <div class="card-body">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Candidate</th>
                        <th>Event</th>
                        <th>Details</th>
                        <th>Handler</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $recentActivity = [
                        ['name' => 'Kavindu Perera', 'code' => 'CAND-1247', 'event' => 'Visa Approved', 'detail' => 'Australia Work Visa', 'handler' => 'Nimal J.', 'time' => '2 min ago', 'status' => 'visa_approved'],
                        ['name' => 'Sachini Rathnayake', 'code' => 'CAND-1189', 'event' => 'Deployed', 'detail' => 'Global Workforce Solutions', 'handler' => 'Kasun B.', 'time' => '45 min', 'status' => 'deployed'],
                        ['name' => 'Nadeeka Silva', 'code' => 'CAND-1234', 'event' => 'Document Correction', 'detail' => 'Passport — Correction Required', 'handler' => 'Priya H.', 'time' => '1h ago', 'status' => 'correction_required'],
                        ['name' => 'Thilini Madushan', 'code' => 'CAND-1298', 'event' => 'Registered', 'detail' => 'Walk-in Registration', 'handler' => 'Kasun B.', 'time' => '2h ago', 'status' => 'registered'],
                        ['name' => 'Ruwan Pathirana', 'code' => 'CAND-1201', 'event' => 'Refund Initiated', 'detail' => 'Visa delay — timeframe exceeded', 'handler' => 'Director', 'time' => '3h ago', 'status' => 'refund'],
                    ];
                    @endphp
                    @foreach($recentActivity as $row)
                    <tr>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="avatar avatar-sm avatar-indigo">{{ substr($row['name'], 0, 2) }}</div>
                                <div>
                                    <a href="{{ route('employment.candidates.show', 1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $row['name'] }}</a>
                                    <p class="text-xs text-slate-400">{{ $row['code'] }}</p>
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Employment Trend Chart
    new Chart(document.getElementById('empTrendChart'), {
        type: 'line',
        data: {
            labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [
                {
                    label: 'New Registrations',
                    data: [92, 85, 118, 124, 109, 142],
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99,102,241,0.08)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#6366f1',
                },
                {
                    label: 'Deployments',
                    data: [35, 40, 52, 48, 61, 55],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.08)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#10b981',
                },
                {
                    label: 'Refunds',
                    data: [3, 5, 4, 6, 8, 7],
                    borderColor: '#f43f5e',
                    backgroundColor: 'rgba(244,63,94,0.05)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#f43f5e',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom', labels: { font: { family: 'Inter', size: 12 } } } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Source Chart
    new Chart(document.getElementById('sourceChart'), {
        type: 'doughnut',
        data: {
            labels: ['Walk-in', 'Referral', 'Agent', 'Online', 'Employer'],
            datasets: [{
                data: [31, 26, 19, 15, 9],
                backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#06b6d4', '#8b5cf6'],
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            cutout: '60%',
            plugins: { legend: { position: 'bottom', labels: { font: { family: 'Inter', size: 11 } } } }
        }
    });

    lucide.createIcons();
});
</script>

</x-layouts.app>
