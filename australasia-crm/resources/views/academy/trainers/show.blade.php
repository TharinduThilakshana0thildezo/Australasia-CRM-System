<x-layouts.app title="Mr. Rupasinghe — Trainer">

<x-page-header
    title="Mr. Rupasinghe"
    subtitle="TRN-1001 · Pre-Departure Training Specialist · 2 active batches"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.trainers.index'),'label'=>'Trainers'],['url'=>'#','label'=>'Mr. Rupasinghe']]">
    <x-slot:actions>
        <a href="{{ route('academy.batches.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Assign Batch</a>
    </x-slot:actions>
</x-page-header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Trainer Profile</h3><x-status-badge status="active" /></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['Trainer ID','TRN-1001'],['Phone','0771234501'],['Email','rupasinghe@training.lk'],
                        ['Specialization','Pre-Departure Training'],['Joined','01 Mar 2024'],['NIC','198001234512'],
                    ] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <p class="text-xs text-slate-400 mb-1">Qualified to Train</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Pre-Departure — Warehouse','Pre-Departure — Hospitality','Pre-Departure — Care Work','Workplace Safety','Defensive Driving'] as $c)
                        <span class="badge badge-lead">{{ $c }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Current Batches --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Current Batches</h3></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Batch</th><th>Course</th><th>Students</th><th>Start</th><th>End</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['BCH-2026-001','Pre-Departure — Warehouse',24,'01 Oct 2026','15 Oct 2026','active'],
                            ['BCH-2026-006','Pre-Departure — Warehouse',8,'20 Oct 2026','03 Nov 2026','scheduled'],
                        ] as $b)
                        <tr>
                            <td><a href="{{ route('academy.batches.show',1) }}" class="text-xs font-mono text-indigo-600">{{ $b[0] }}</a></td>
                            <td class="text-sm font-semibold text-slate-800">{{ $b[1] }}</td>
                            <td class="text-sm font-bold text-slate-700">{{ $b[2] }}</td>
                            <td class="text-xs text-slate-500">{{ $b[3] }}</td>
                            <td class="text-xs text-slate-500">{{ $b[4] }}</td>
                            <td><x-status-badge :status="$b[5]" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Batch History --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Training History</h3></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Batch</th><th>Course</th><th>Students</th><th>Period</th><th>Pass Rate</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['BCH-2026-003-P','Pre-Departure — Warehouse',30,'Sep 2026','93%'],
                            ['BCH-2025-009','Pre-Departure — Warehouse',28,'Aug 2025','96%'],
                            ['BCH-2025-005','Pre-Departure — Hospitality',22,'May 2025','91%'],
                        ] as $h)
                        <tr>
                            <td class="text-xs font-mono text-slate-500">{{ $h[0] }}</td>
                            <td class="text-sm text-slate-700">{{ $h[1] }}</td>
                            <td class="text-sm font-bold text-slate-700">{{ $h[2] }}</td>
                            <td class="text-xs text-slate-500">{{ $h[3] }}</td>
                            <td class="text-sm font-bold text-emerald-600">{{ $h[4] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        @foreach([['93%','Avg. Pass Rate','award','emerald'],['2','Active Batches','layers','indigo'],['80','Total Students Trained','users','violet'],['5','Courses Covered','book-open','teal']] as $k)
        <div class="stat-card"><div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-4 h-4 text-{{ $k[3] }}-600"></i></div><div class="stat-value text-xl">{{ $k[0] }}</div><div class="stat-label text-xs">{{ $k[1] }}</div></div>
        @endforeach
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
