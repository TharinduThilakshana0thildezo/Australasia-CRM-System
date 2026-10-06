<x-layouts.app title="Director Dashboard">

<!-- Page Header -->
<x-page-header
    title="Director Dashboard"
    subtitle="Australasia Group — Operations Overview for October 2026">
    <x-slot:actions>
        <span class="text-sm text-slate-500">Today, {{ now()->format('d M Y') }}</span>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i>
            Export
        </button>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            Quick Add
        </button>
    </x-slot:actions>
</x-page-header>

<!-- ========== KPI CARDS - ROW 1 ========== -->
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
    <x-stat-card value="1,284" label="Total Candidates" icon="users" color="indigo" delta="+12 this week" deltaDir="up" href="{{ route('employment.candidates.index') }}" />
    <x-stat-card value="142"   label="Active Cases"     icon="briefcase" color="violet" delta="+8 today" deltaDir="up" />
    <x-stat-card value="318"   label="Talent Pool"      icon="star" color="teal" delta="+5 today" deltaDir="up" href="{{ route('employment.talent-pool') }}" />
    <x-stat-card value="67"    label="Visa Processing"  icon="shield-check" color="amber" delta="+3 today" deltaDir="up" href="{{ route('employment.visas.index') }}" />
    <x-stat-card value="203"   label="Deployed"         icon="plane" color="emerald" delta="+2 today" deltaDir="up" href="{{ route('employment.deployments.index') }}" />
    <x-stat-card value="14"    label="Refund Cases"     icon="rotate-ccw" color="rose" delta="2 overdue" deltaDir="down" href="{{ route('employment.refunds.index') }}" />
</div>

<!-- KPI CARDS - ROW 2 -->
<div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
    <x-stat-card value="89"   label="Consultancy Students" icon="graduation-cap" color="violet" href="{{ route('consultancy.students.index') }}" />
    <x-stat-card value="234"  label="Academy Students"     icon="book-open" color="cyan" href="{{ route('academy.students.index') }}" />
    <x-stat-card value="47"   label="Applications Active"  icon="file-text" color="indigo" />
    <x-stat-card value="28"   label="Pending Payments"     icon="credit-card" color="amber" href="{{ route('finance.dashboard') }}" />
    <x-stat-card value="43"   label="Pending Tasks"        icon="check-square" color="orange" href="{{ route('tasks.index') }}" />
    <x-stat-card value="7"    label="Overdue Tasks"        icon="alert-circle" color="rose" href="{{ route('tasks.index') }}" />
</div>

<!-- ========== CHARTS + PIPELINE ========== -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    <!-- Candidate Pipeline Chart -->
    <div class="card xl:col-span-2">
        <div class="card-header">
            <div>
                <h3 class="card-title">Candidate Pipeline</h3>
                <p class="text-xs text-slate-500 mt-0.5">Foreign Employment — live status distribution</p>
            </div>
            <div class="flex gap-2">
                <button class="btn btn-ghost btn-xs" onclick="switchChart('monthly')">Monthly</button>
                <button class="btn btn-ghost btn-xs" onclick="switchChart('weekly')">Weekly</button>
            </div>
        </div>
        <div class="card-body">
            <!-- Pipeline stages visual -->
            <div class="pipeline-track mb-6">
                @php
                $stages = [
                    ['label' => 'Lead', 'count' => 84, 'color' => '#64748b'],
                    ['label' => 'Registered', 'count' => 156, 'color' => '#3b82f6'],
                    ['label' => 'Documents', 'count' => 98, 'color' => '#f59e0b'],
                    ['label' => 'Ready', 'count' => 318, 'color' => '#10b981'],
                    ['label' => 'Employer', 'count' => 47, 'color' => '#6366f1'],
                    ['label' => 'Checklist', 'count' => 31, 'color' => '#8b5cf6'],
                    ['label' => 'Visa', 'count' => 67, 'color' => '#a855f7'],
                    ['label' => 'Deployed', 'count' => 203, 'color' => '#22c55e'],
                ];
                @endphp
                @foreach($stages as $stage)
                <div class="pipeline-stage text-center">
                    <div class="pipeline-count" style="color: {{ $stage['color'] }}">{{ $stage['count'] }}</div>
                    <div class="pipeline-label">{{ $stage['label'] }}</div>
                    <div class="mt-2 h-1.5 rounded-full mx-2" style="background: {{ $stage['color'] }}; opacity: 0.3"></div>
                </div>
                @endforeach
            </div>

            <!-- Bar chart -->
            <canvas id="candidateRegistrationsChart" height="160"></canvas>
        </div>
    </div>

    <!-- Visa Status Donut -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Visa Status</h3>
        </div>
        <div class="card-body">
            <canvas id="visaStatusChart" height="220"></canvas>
            <div class="mt-4 space-y-2">
                @php
                $visaStats = [
                    ['label' => 'Approved', 'count' => 203, 'color' => '#10b981'],
                    ['label' => 'Processing', 'count' => 67, 'color' => '#a855f7'],
                    ['label' => 'Preparing', 'count' => 31, 'color' => '#6366f1'],
                    ['label' => 'Rejected', 'count' => 8, 'color' => '#f43f5e'],
                    ['label' => 'Delayed', 'count' => 12, 'color' => '#f59e0b'],
                ];
                @endphp
                @foreach($visaStats as $vs)
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-sm flex-shrink-0" style="background:{{ $vs['color'] }}"></span>
                        <span class="text-slate-600">{{ $vs['label'] }}</span>
                    </div>
                    <span class="font-semibold text-slate-800">{{ $vs['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<!-- ========== SECOND ROW OF CHARTS ========== -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    <!-- Revenue / Payments -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Revenue Overview</h3>
        </div>
        <div class="card-body">
            <canvas id="revenueChart" height="200"></canvas>
        </div>
    </div>

    <!-- Deployment Stats -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Deployments by Country</h3>
        </div>
        <div class="card-body">
            <canvas id="deploymentChart" height="200"></canvas>
        </div>
    </div>

    <!-- Module Stats -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Enrollment by Module</h3>
        </div>
        <div class="card-body">
            <canvas id="enrollmentChart" height="200"></canvas>
        </div>
    </div>

</div>

<!-- ========== BOTTOM SECTION ========== -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">

    <!-- Recent Activity -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Recent Activity</h3>
            <a href="#" class="text-sm text-indigo-600 font-medium">View all →</a>
        </div>
        <div class="card-body">
            <div class="timeline">
                @php
                $activities = [
                    ['icon' => '✓', 'type' => 'success', 'title' => 'Visa Approved — Kavindu Perera', 'detail' => 'Australia Tourist Work Visa • Application APP-0842', 'time' => '2 min ago', 'by' => 'Nimal Jayawardena'],
                    ['icon' => '✓', 'type' => 'success', 'title' => 'Candidate Deployed — Sachini Rathnayake', 'detail' => 'Warehouse Operator • Global Workforce Solutions Pty Ltd', 'time' => '45 min ago', 'by' => 'Kasun Bandara'],
                    ['icon' => '⚠', 'type' => 'warning', 'title' => 'Document Correction — Ruwan Pathirana', 'detail' => 'Passport copy rejected — clarity issue', 'time' => '1h ago', 'by' => 'Priya Hewage'],
                    ['icon' => '+', 'type' => 'info', 'title' => 'New Candidate Registered — Thilini Madushan', 'detail' => 'Source: Walk-in • Handler: Kasun Bandara', 'time' => '2h ago', 'by' => 'Kasun Bandara'],
                    ['icon' => '₨', 'type' => 'success', 'title' => 'Payment Received — LKR 15,000', 'detail' => 'Registration fee • Amara Kumari Dissanayake', 'time' => '3h ago', 'by' => 'Finance Dept'],
                    ['icon' => '!', 'type' => 'danger', 'title' => 'Refund Initiated — Indika Chandrasena', 'detail' => 'Visa delay exceeded allowed timeframe', 'time' => '5h ago', 'by' => 'Director'],
                ];
                @endphp

                @foreach($activities as $act)
                <div class="timeline-item">
                    <div class="timeline-dot timeline-dot-{{ $act['type'] }}">{{ $act['icon'] }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">{{ $act['title'] }}</div>
                        <div class="timeline-meta">{{ $act['time'] }} · by {{ $act['by'] }}</div>
                        <div class="timeline-body">{{ $act['detail'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Upcoming Tasks / Deadlines -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Upcoming Deadlines & Tasks</h3>
            <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 font-medium">View all →</a>
        </div>
        <div class="card-body p-0">
            @php
            $tasks = [
                ['title' => 'Visa deadline — Nadeeka Silva', 'due' => 'Today', 'priority' => 'high', 'module' => 'Visa'],
                ['title' => 'Document correction — Pradeep Fernando', 'due' => 'Tomorrow', 'priority' => 'high', 'module' => 'Documents'],
                ['title' => 'Pre-departure briefing — Group 12', 'due' => '08 Oct', 'priority' => 'medium', 'module' => 'Deployment'],
                ['title' => 'Follow-up call — Amila Wickramasinghe', 'due' => '09 Oct', 'priority' => 'low', 'module' => 'Lead'],
                ['title' => 'Application checklist review — Chamari Dias', 'due' => '10 Oct', 'priority' => 'medium', 'module' => 'Checklist'],
                ['title' => 'Employer submission — Global Workforce Solutions', 'due' => '11 Oct', 'priority' => 'medium', 'module' => 'Application'],
                ['title' => 'Counselling session — Sachini Ranasinghe', 'due' => '12 Oct', 'priority' => 'low', 'module' => 'Consultancy'],
            ];
            @endphp
            <div class="divide-y divide-slate-50">
                @foreach($tasks as $task)
                <div class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                    <div class="w-1.5 h-1.5 rounded-full flex-shrink-0
                        {{ $task['priority'] === 'high' ? 'bg-rose-500' : ($task['priority'] === 'medium' ? 'bg-amber-400' : 'bg-slate-300') }}"></div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $task['title'] }}</p>
                        <p class="text-xs text-slate-400">{{ $task['module'] }}</p>
                    </div>
                    <span class="text-xs font-semibold flex-shrink-0
                        {{ $task['due'] === 'Today' ? 'text-rose-600' : ($task['due'] === 'Tomorrow' ? 'text-amber-600' : 'text-slate-500') }}">
                        {{ $task['due'] }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('tasks.index') }}" class="text-sm text-indigo-600 font-semibold">+ Add New Task</a>
        </div>
    </div>

</div>

<!-- ========== QUICK STATS STRIP ========== -->
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Exception Monitoring</h3>
        <span class="text-xs text-slate-500">Requires attention</span>
    </div>
    <div class="card-body">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 text-center">
            @php
            $exceptions = [
                ['label' => 'Expired Reg. Links', 'count' => 3, 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                ['label' => 'Missing Documents', 'count' => 18, 'color' => 'text-orange-600', 'bg' => 'bg-orange-50'],
                ['label' => 'Correction Pending', 'count' => 11, 'color' => 'text-rose-600', 'bg' => 'bg-rose-50'],
                ['label' => 'Visa Delays', 'count' => 4, 'color' => 'text-rose-600', 'bg' => 'bg-rose-50'],
                ['label' => 'Refund Cases', 'count' => 14, 'color' => 'text-rose-600', 'bg' => 'bg-rose-50'],
                ['label' => 'Unresponsive', 'count' => 7, 'color' => 'text-slate-600', 'bg' => 'bg-slate-50'],
                ['label' => 'Overdue Checklist', 'count' => 5, 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
            ];
            @endphp
            @foreach($exceptions as $ex)
            <div class="{{ $ex['bg'] }} rounded-xl p-3">
                <div class="text-2xl font-bold {{ $ex['color'] }}">{{ $ex['count'] }}</div>
                <div class="text-xs text-slate-500 mt-1 font-medium leading-snug">{{ $ex['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Chart JS initialization -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chartDefaults = {
        font: { family: 'Inter, sans-serif' },
    };

    // Candidate Registrations
    new Chart(document.getElementById('candidateRegistrationsChart'), {
        type: 'bar',
        data: {
            labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [
                {
                    label: 'New Candidates',
                    data: [68, 92, 85, 118, 124, 109, 142],
                    backgroundColor: 'rgba(99,102,241,0.7)',
                    borderRadius: 5,
                },
                {
                    label: 'Deployments',
                    data: [22, 35, 40, 52, 48, 61, 55],
                    backgroundColor: 'rgba(16,185,129,0.7)',
                    borderRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom', labels: { font: chartDefaults.font } } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Visa Status Donut
    new Chart(document.getElementById('visaStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Processing', 'Preparing', 'Rejected', 'Delayed'],
            datasets: [{
                data: [203, 67, 31, 8, 12],
                backgroundColor: ['#10b981', '#a855f7', '#6366f1', '#f43f5e', '#f59e0b'],
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            cutout: '65%',
            plugins: { legend: { display: false } }
        }
    });

    // Revenue Chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Revenue (LKR)',
                data: [320000, 480000, 410000, 590000, 620000, 540000, 710000],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#6366f1',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { callback: v => 'LKR ' + (v/1000)+'k' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Deployments by Country
    new Chart(document.getElementById('deploymentChart'), {
        type: 'bar',
        data: {
            labels: ['Australia', 'UAE', 'Qatar', 'Kuwait', 'Malaysia', 'Saudi'],
            datasets: [{
                label: 'Deployed',
                data: [78, 54, 31, 22, 11, 7],
                backgroundColor: ['#6366f1','#10b981','#f59e0b','#06b6d4','#8b5cf6','#f43f5e'],
                borderRadius: 6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } }, y: { grid: { display: false } } }
        }
    });

    // Enrollment by Module
    new Chart(document.getElementById('enrollmentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Foreign Employment', 'Consultancy', 'Academy'],
            datasets: [{
                data: [1284, 89, 234],
                backgroundColor: ['#6366f1', '#a855f7', '#10b981'],
                borderWidth: 3,
                borderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            cutout: '55%',
            plugins: { legend: { position: 'bottom', labels: { font: { family: 'Inter', size: 12 } } } }
        }
    });

    lucide.createIcons();
});
</script>

</x-layouts.app>
