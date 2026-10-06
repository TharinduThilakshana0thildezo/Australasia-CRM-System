<x-layouts.app title="Talent Pool — Foreign Employment">

<x-page-header
    title="Active Talent Pool"
    subtitle="Candidates ready and available for employer matching"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Talent Pool']]">
    <x-slot:actions>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i>
            Export Pool
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="318" label="Total in Pool"    icon="users"     color="teal" />
    <x-stat-card value="124" label="Docs Complete"    icon="file-check" color="emerald" />
    <x-stat-card value="89"  label="Training Done"    icon="graduation-cap" color="indigo" />
    <x-stat-card value="47"  label="Being Reviewed"   icon="search"    color="amber" />
</div>

<!-- Filters -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search by name, skills, country preference…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Countries</option>
                <option>Australia</option><option>UAE</option><option>Qatar</option>
                <option>Kuwait</option><option>Malaysia</option><option>Saudi Arabia</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Job Types</option>
                <option>Warehouse Operator</option><option>Factory Worker</option>
                <option>Construction</option><option>Hospitality</option><option>Driver</option>
                <option>Healthcare</option><option>Agriculture</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Experience</option>
                <option>0–2 years</option><option>3–5 years</option><option>6–10 years</option><option>10+ years</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>Training: Any</option>
                <option>Training Completed</option>
                <option>No Training Required</option>
            </select>
            <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                <input type="checkbox" class="form-input" style="width:14px;height:14px;padding:0">
                Passport Ready
            </label>
        </div>
    </div>
</div>

<!-- Pool Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @php
    $pool = [
        ['id' => 'CAND-1290', 'name' => 'Pradeep Fernando',     'role' => 'Warehouse Operator',  'exp' => '5 years',  'countries' => 'Australia, UAE',    'docs' => true,  'training' => true,  'passport' => true,  'skills' => ['Forklift', 'Packing', 'QC'],             'handler' => 'Amila P.', 'color' => 'indigo'],
        ['id' => 'CAND-1285', 'name' => 'Samanthi Fernando',    'role' => 'Factory Worker',       'exp' => '3 years',  'countries' => 'Qatar, Kuwait',     'docs' => true,  'training' => true,  'passport' => true,  'skills' => ['Assembly', 'Machine Operation'],         'handler' => 'Kasun B.', 'color' => 'emerald'],
        ['id' => 'CAND-1282', 'name' => 'Ajith Nanayakkara',    'role' => 'Construction Worker',  'exp' => '8 years',  'countries' => 'UAE, Qatar',        'docs' => true,  'training' => false, 'passport' => true,  'skills' => ['Masonry', 'Carpentry', 'Steel Fixing'], 'handler' => 'Nimal J.', 'color' => 'violet'],
        ['id' => 'CAND-1278', 'name' => 'Dilrukshi Jayakody',   'role' => 'Hospitality',          'exp' => '4 years',  'countries' => 'Maldives, UAE',     'docs' => true,  'training' => true,  'passport' => true,  'skills' => ['Customer Service', 'F&B'],              'handler' => 'Priya H.', 'color' => 'rose'],
        ['id' => 'CAND-1274', 'name' => 'Chaminda Rathnayake',  'role' => 'Heavy Vehicle Driver', 'exp' => '12 years', 'countries' => 'Saudi Arabia, UAE', 'docs' => true,  'training' => false, 'passport' => true,  'skills' => ['HGV', 'Logistics', 'Route Planning'],  'handler' => 'Amila P.', 'color' => 'cyan'],
        ['id' => 'CAND-1271', 'name' => 'Renuka Bandara',       'role' => 'Agriculture Worker',   'exp' => '2 years',  'countries' => 'Australia',         'docs' => false, 'training' => false, 'passport' => false, 'skills' => ['Fruit Picking', 'Farming'],             'handler' => 'Kasun B.', 'color' => 'amber'],
    ];
    @endphp

    @foreach($pool as $c)
    <div class="card hover:shadow-card-hover transition-shadow">
        <div class="card-body">
            <!-- Header -->
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="avatar avatar-lg avatar-{{ $c['color'] }}">
                        {{ strtoupper(substr($c['name'], 0, 1) . substr(strstr($c['name'], ' '), 1, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">{{ $c['name'] }}</h4>
                        <p class="text-xs text-slate-400">{{ $c['id'] }}</p>
                        <p class="text-xs text-slate-600 font-medium mt-0.5">{{ $c['role'] }}</p>
                    </div>
                </div>
                <x-status-badge status="talent_pool" />
            </div>

            <!-- Details -->
            <div class="grid grid-cols-2 gap-2 text-xs mb-3">
                <div class="flex items-center gap-1.5 text-slate-600">
                    <i data-lucide="briefcase" style="width:12px;height:12px;color:#94a3b8"></i>
                    {{ $c['exp'] }} experience
                </div>
                <div class="flex items-center gap-1.5 text-slate-600">
                    <i data-lucide="globe" style="width:12px;height:12px;color:#94a3b8"></i>
                    {{ $c['countries'] }}
                </div>
                <div class="flex items-center gap-1.5 {{ $c['docs'] ? 'text-emerald-600' : 'text-rose-500' }}">
                    <i data-lucide="{{ $c['docs'] ? 'file-check' : 'file-x' }}" style="width:12px;height:12px"></i>
                    {{ $c['docs'] ? 'Docs Ready' : 'Docs Incomplete' }}
                </div>
                <div class="flex items-center gap-1.5 {{ $c['training'] ? 'text-emerald-600' : 'text-slate-400' }}">
                    <i data-lucide="{{ $c['training'] ? 'graduation-cap' : 'minus' }}" style="width:12px;height:12px"></i>
                    {{ $c['training'] ? 'Training Done' : 'No Training' }}
                </div>
            </div>

            <!-- Skills -->
            <div class="flex flex-wrap gap-1 mb-3">
                @foreach($c['skills'] as $skill)
                <span class="filter-pill py-0.5 px-2 text-xs">{{ $skill }}</span>
                @endforeach
            </div>

            <!-- Handler -->
            <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-4">
                <i data-lucide="user" style="width:11px;height:11px"></i>
                Handler: {{ $c['handler'] }}
            </div>

            <!-- Actions -->
            <div class="flex gap-2">
                <a href="{{ route('employment.candidates.show', 1) }}" class="btn btn-secondary btn-sm flex-1 text-center justify-center">
                    View Profile
                </a>
                <a href="{{ route('employment.matching') }}" class="btn btn-primary btn-sm flex-1 text-center justify-center">
                    <i data-lucide="target" style="width:13px;height:13px"></i>
                    Match Vacancy
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
