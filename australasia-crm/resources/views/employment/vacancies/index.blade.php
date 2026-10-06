<x-layouts.app title="Vacancies — Foreign Employment">

<x-page-header
    title="Vacancies"
    subtitle="All employer vacancy listings and application status"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Vacancies']]">
    <x-slot:actions>
        <a href="{{ route('employment.vacancies.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i> New Vacancy
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="47" label="Total Open"    icon="briefcase"    color="indigo" />
    <x-stat-card value="18" label="Active Now"    icon="zap"          color="emerald" />
    <x-stat-card value="9"  label="Matching"      icon="target"       color="amber" />
    <x-stat-card value="6"  label="Filled"        icon="check-circle" color="teal" />
    <x-stat-card value="3"  label="Cancelled"     icon="x-circle"     color="rose" />
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search job title, employer, country…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Countries</option>
                <option>Australia</option><option>UAE</option><option>Qatar</option><option>Kuwait</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>Open</option><option>Matching</option><option>Filled</option><option>Draft</option><option>Cancelled</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Employers</option>
                <option>Global Workforce Solutions</option>
                <option>Al Futtaim Manufacturing</option>
                <option>Qatar Industrial Services</option>
            </select>
        </div>
    </div>
</div>

<!-- Vacancies Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Vacancy</th>
                    <th>Employer</th>
                    <th>Country</th>
                    <th>Openings</th>
                    <th>Salary</th>
                    <th>Applications</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $vacancies = [
                    ['id' => 'VAC-0042', 'title' => 'Warehouse Operator',     'employer' => 'Global Workforce Solutions', 'country' => 'Australia',     'openings' => 5,  'salary' => 'AUD 55,000/yr', 'apps' => 3, 'deadline' => '30 Oct 2026', 'status' => 'open'],
                    ['id' => 'VAC-0041', 'title' => 'Machine Operator',        'employer' => 'Al Futtaim Manufacturing',  'country' => 'UAE',            'openings' => 8,  'salary' => 'AED 3,500/mo',  'apps' => 6, 'deadline' => '15 Nov 2026', 'status' => 'open'],
                    ['id' => 'VAC-0040', 'title' => 'Factory Worker',          'employer' => 'Qatar Industrial Services', 'country' => 'Qatar',          'openings' => 12, 'salary' => 'QAR 2,800/mo',  'apps' => 8, 'deadline' => '20 Nov 2026', 'status' => 'open'],
                    ['id' => 'VAC-0039', 'title' => 'Heavy Vehicle Driver',    'employer' => 'Saudi Logistics & Transport','country' => 'Saudi Arabia',  'openings' => 3,  'salary' => 'SAR 4,200/mo',  'apps' => 2, 'deadline' => '10 Nov 2026', 'status' => 'matching'],
                    ['id' => 'VAC-0038', 'title' => 'Construction Worker',     'employer' => 'Kuwait General Contracting', 'country' => 'Kuwait',        'openings' => 6,  'salary' => 'KWD 250/mo',    'apps' => 5, 'deadline' => '25 Nov 2026', 'status' => 'matching'],
                    ['id' => 'VAC-0037', 'title' => 'Hospitality Staff',       'employer' => 'Pacific Hospitality Group', 'country' => 'Australia',      'openings' => 4,  'salary' => 'AUD 50,000/yr', 'apps' => 4, 'deadline' => '01 Oct 2026', 'status' => 'filled'],
                    ['id' => 'VAC-0036', 'title' => 'Packing Line Worker',     'employer' => 'Al Futtaim Manufacturing',  'country' => 'UAE',            'openings' => 10, 'salary' => 'AED 2,800/mo',  'apps' => 0, 'deadline' => '28 Oct 2026', 'status' => 'draft'],
                ];
                @endphp

                @foreach($vacancies as $v)
                <tr>
                    <td>
                        <a href="{{ route('employment.vacancies.show', 1) }}"
                           class="font-mono text-sm font-semibold text-indigo-600 hover:underline block">
                            {{ $v['id'] }}
                        </a>
                        <span class="text-sm font-semibold text-slate-800">{{ $v['title'] }}</span>
                    </td>
                    <td>
                        <a href="{{ route('employment.employers.show', 1) }}"
                           class="text-sm font-medium text-slate-700 hover:text-indigo-600 transition-colors">
                            {{ $v['employer'] }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5 text-sm text-slate-600">
                            <i data-lucide="globe" style="width:13px;height:13px;color:#94a3b8"></i>
                            {{ $v['country'] }}
                        </div>
                    </td>
                    <td>
                        <span class="text-sm font-bold text-slate-800">{{ $v['openings'] }}</span>
                        <span class="text-xs text-slate-400 block">positions</span>
                    </td>
                    <td class="text-sm font-semibold text-slate-700">{{ $v['salary'] }}</td>
                    <td>
                        @if($v['apps'] > 0)
                        <a href="{{ route('employment.applications.index') }}"
                           class="flex items-center gap-1.5 text-sm text-indigo-600 font-semibold hover:underline">
                            <i data-lucide="users" style="width:13px;height:13px"></i>
                            {{ $v['apps'] }}
                        </a>
                        @else
                        <span class="text-sm text-slate-400">—</span>
                        @endif
                    </td>
                    <td class="text-sm text-slate-600 whitespace-nowrap">{{ $v['deadline'] }}</td>
                    <td><x-status-badge :status="$v['status']" /></td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.vacancies.show', 1) }}" class="btn btn-ghost btn-xs">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            @if($v['status'] === 'open' || $v['status'] === 'matching')
                            <a href="{{ route('employment.matching') }}" class="btn btn-primary btn-xs">
                                <i data-lucide="target" style="width:12px;height:12px"></i> Match
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–7 of 47 vacancies</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Previous</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
