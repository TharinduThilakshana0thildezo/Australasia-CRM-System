<x-layouts.app title="Employers — Foreign Employment">

<x-page-header
    title="Employers"
    subtitle="Manage partner employers and their vacancy relationships"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Employers']]">
    <x-slot:actions>
        <a href="{{ route('employment.employers.export') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i> Export
        </a>
        <a href="{{ route('employment.employers.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i> New Employer
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="24" label="Total Employers"    icon="building-2"  color="indigo" />
    <x-stat-card value="18" label="Active Employers"   icon="check-circle" color="emerald" />
    <x-stat-card value="47" label="Open Vacancies"     icon="briefcase"   color="amber" />
    <x-stat-card value="203" label="Placed Candidates" icon="plane"       color="teal" />
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search employer name, country…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Countries</option>
                <option>Australia</option><option>UAE</option><option>Qatar</option>
                <option>Kuwait</option><option>Malaysia</option><option>Saudi Arabia</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>Active</option><option>Inactive</option><option>New</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Industries</option>
                <option>Logistics & Warehousing</option><option>Manufacturing</option>
                <option>Construction</option><option>Hospitality</option><option>Healthcare</option>
            </select>
        </div>
    </div>
</div>

<!-- Employer Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @php
    $employers = [
        ['id' => 'EMP-001', 'name' => 'Global Workforce Solutions Pty Ltd', 'country' => 'Australia', 'city' => 'Melbourne, VIC', 'industry' => 'Logistics & Warehousing', 'contact' => 'James O\'Brien', 'email' => 'james@gws.com.au', 'vacancies' => 5, 'placed' => 78, 'status' => 'active', 'color' => 'indigo', 'since' => '2024'],
        ['id' => 'EMP-002', 'name' => 'Al Futtaim Manufacturing LLC', 'country' => 'UAE', 'city' => 'Dubai', 'industry' => 'Manufacturing', 'contact' => 'Mohammed Al Rashid', 'email' => 'm.rashid@alfuttaim.ae', 'vacancies' => 8, 'placed' => 54, 'status' => 'active', 'color' => 'emerald', 'since' => '2023'],
        ['id' => 'EMP-003', 'name' => 'Qatar Industrial Services WLL', 'country' => 'Qatar', 'city' => 'Doha', 'industry' => 'Industrial Services', 'contact' => 'Ahmed Al Fardan', 'email' => 'a.fardan@qis.qa', 'vacancies' => 12, 'placed' => 31, 'status' => 'active', 'color' => 'violet', 'since' => '2025'],
        ['id' => 'EMP-004', 'name' => 'Saudi Logistics & Transport Co.', 'country' => 'Saudi Arabia', 'city' => 'Riyadh', 'industry' => 'Logistics', 'contact' => 'Abdullah Al-Otaibi', 'email' => 'a.otaibi@slt.sa', 'vacancies' => 3, 'placed' => 22, 'status' => 'active', 'color' => 'amber', 'since' => '2024'],
        ['id' => 'EMP-005', 'name' => 'Pacific Hospitality Group', 'country' => 'Australia', 'city' => 'Sydney, NSW', 'industry' => 'Hospitality', 'contact' => 'Sarah Thompson', 'email' => 's.thompson@phg.com.au', 'vacancies' => 0, 'placed' => 11, 'status' => 'inactive', 'color' => 'rose', 'since' => '2023'],
        ['id' => 'EMP-006', 'name' => 'Kuwait General Contracting Co.', 'country' => 'Kuwait', 'city' => 'Kuwait City', 'industry' => 'Construction', 'contact' => 'Yousef Al-Ahmad', 'email' => 'y.ahmad@kgcc.kw', 'vacancies' => 6, 'placed' => 7, 'status' => 'active', 'color' => 'cyan', 'since' => '2025'],
    ];
    @endphp

    @foreach($employers as $emp)
    <div class="card hover:shadow-lg transition-shadow">
        <div class="card-body">
            <!-- Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="avatar avatar-lg avatar-{{ $emp['color'] }} rounded-xl text-base font-black">
                        {{ substr($emp['name'], 0, 2) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900 leading-snug">{{ $emp['name'] }}</h4>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $emp['id'] }} · Partner since {{ $emp['since'] }}</p>
                    </div>
                </div>
                <x-status-badge :status="$emp['status']" />
            </div>

            <!-- Details -->
            <div class="space-y-2 text-sm mb-4">
                <div class="flex items-center gap-2 text-slate-600">
                    <i data-lucide="map-pin" style="width:13px;height:13px;color:#94a3b8;flex-shrink:0"></i>
                    {{ $emp['city'] }}, {{ $emp['country'] }}
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <i data-lucide="briefcase" style="width:13px;height:13px;color:#94a3b8;flex-shrink:0"></i>
                    {{ $emp['industry'] }}
                </div>
                <div class="flex items-center gap-2 text-slate-600">
                    <i data-lucide="user" style="width:13px;height:13px;color:#94a3b8;flex-shrink:0"></i>
                    {{ $emp['contact'] }}
                </div>
                <div class="flex items-center gap-2 text-slate-500 text-xs">
                    <i data-lucide="mail" style="width:12px;height:12px;color:#94a3b8;flex-shrink:0"></i>
                    {{ $emp['email'] }}
                </div>
            </div>

            <!-- Metrics -->
            <div class="grid grid-cols-2 gap-3 mb-4">
                <div class="bg-slate-50 rounded-lg p-3 text-center">
                    <div class="text-xl font-extrabold {{ $emp['vacancies'] > 0 ? 'text-indigo-600' : 'text-slate-400' }}">{{ $emp['vacancies'] }}</div>
                    <div class="text-xs text-slate-500 font-medium mt-0.5">Open Vacancies</div>
                </div>
                <div class="bg-slate-50 rounded-lg p-3 text-center">
                    <div class="text-xl font-extrabold text-emerald-600">{{ $emp['placed'] }}</div>
                    <div class="text-xs text-slate-500 font-medium mt-0.5">Placed (Total)</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-2">
                <a href="{{ route('employment.employers.show', 1) }}" class="btn btn-secondary btn-sm flex-1 justify-center">
                    View Profile
                </a>
                @if($emp['vacancies'] > 0)
                <a href="{{ route('employment.vacancies.index') }}" class="btn btn-primary btn-sm flex-1 justify-center">
                    View Vacancies ({{ $emp['vacancies'] }})
                </a>
                @else
                <a href="{{ route('employment.vacancies.create') }}" class="btn btn-outline btn-sm flex-1 justify-center">
                    + Add Vacancy
                </a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
