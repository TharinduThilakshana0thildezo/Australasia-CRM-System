<x-layouts.app title="Applications — Foreign Employment">

<x-page-header
    title="Applications"
    subtitle="Candidate applications submitted to employer vacancies"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Applications']]">
    <x-slot:actions>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i> Export
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="47"  label="Total"          icon="file-text"    color="indigo" />
    <x-stat-card value="12"  label="Submitted"       icon="send"         color="blue" />
    <x-stat-card value="9"   label="Under Review"    icon="search"       color="amber" />
    <x-stat-card value="18"  label="Selected"        icon="check-circle" color="emerald" />
    <x-stat-card value="8"   label="Not Selected"    icon="x-circle"     color="rose" />
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search candidate, vacancy, employer…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>Submitted</option><option>Under Review</option><option>Interview</option>
                <option>Selected</option><option>Not Selected</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Employers</option>
                <option>Global Workforce Solutions</option>
                <option>Al Futtaim Manufacturing</option>
                <option>Qatar Industrial Services</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Vacancies</option>
                <option>Warehouse Operator</option>
                <option>Machine Operator</option>
                <option>Factory Worker</option>
            </select>
        </div>
    </div>
</div>

<!-- Applications Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>App ID</th>
                    <th>Candidate</th>
                    <th>Vacancy</th>
                    <th>Employer</th>
                    <th>Country</th>
                    <th>Submitted By</th>
                    <th>Submitted</th>
                    <th>Employer Decision</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $apps = [
                    ['id' => 'APP-0842', 'candidate' => 'Kavindu Perera',         'cid' => 'CAND-1297', 'vacancy' => 'Warehouse Operator',     'vid' => 'VAC-0042', 'employer' => 'Global Workforce Solutions', 'country' => 'Australia',    'by' => 'Nimal J.', 'date' => '02 Oct 2026', 'decision' => 'selected',      'status' => 'selected'],
                    ['id' => 'APP-0841', 'candidate' => 'Chamari Dias',            'cid' => 'CAND-1292', 'vacancy' => 'Machine Operator',        'vid' => 'VAC-0041', 'employer' => 'Al Futtaim Manufacturing',  'country' => 'UAE',           'by' => 'Kasun B.', 'date' => '30 Sep 2026', 'decision' => 'under_review',  'status' => 'employer_review'],
                    ['id' => 'APP-0840', 'candidate' => 'Pradeep Fernando',        'cid' => 'CAND-1290', 'vacancy' => 'Warehouse Operator',     'vid' => 'VAC-0042', 'employer' => 'Global Workforce Solutions', 'country' => 'Australia',    'by' => 'Amila P.', 'date' => '02 Oct 2026', 'decision' => 'selected',      'status' => 'selected'],
                    ['id' => 'APP-0839', 'candidate' => 'Ajith Nanayakkara',       'cid' => 'CAND-1282', 'vacancy' => 'Construction Worker',    'vid' => 'VAC-0038', 'employer' => 'Kuwait General Contracting','country' => 'Kuwait',        'by' => 'Nimal J.', 'date' => '01 Oct 2026', 'decision' => 'under_review',  'status' => 'employer_review'],
                    ['id' => 'APP-0838', 'candidate' => 'Samanthi Fernando',       'cid' => 'CAND-1285', 'vacancy' => 'Factory Worker',         'vid' => 'VAC-0040', 'employer' => 'Qatar Industrial Services', 'country' => 'Qatar',         'by' => 'Kasun B.', 'date' => '29 Sep 2026', 'decision' => 'submitted',     'status' => 'submitted'],
                    ['id' => 'APP-0836', 'candidate' => 'Chaminda Rathnayake',     'cid' => 'CAND-1274', 'vacancy' => 'Heavy Vehicle Driver',   'vid' => 'VAC-0039', 'employer' => 'Saudi Logistics & Transport','country' => 'Saudi Arabia', 'by' => 'Amila P.', 'date' => '25 Sep 2026', 'decision' => 'not_selected',  'status' => 'not_selected'],
                    ['id' => 'APP-0835', 'candidate' => 'Dilrukshi Jayakody',      'cid' => 'CAND-1278', 'vacancy' => 'Hospitality Staff',      'vid' => 'VAC-0037', 'employer' => 'Pacific Hospitality Group', 'country' => 'Australia',    'by' => 'Priya H.', 'date' => '20 Sep 2026', 'decision' => 'selected',      'status' => 'selected'],
                ];

                $decisionMap = [
                    'submitted'     => ['class' => 'badge-registered', 'label' => 'Submitted'],
                    'under_review'  => ['class' => 'badge-screening',  'label' => 'Under Review'],
                    'selected'      => ['class' => 'badge-approved',   'label' => 'Selected'],
                    'not_selected'  => ['class' => 'badge-closed',     'label' => 'Not Selected'],
                    'interview'     => ['class' => 'badge-employer',   'label' => 'Interview'],
                ];
                @endphp

                @foreach($apps as $app)
                <tr>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}"
                           class="font-mono text-sm font-semibold text-indigo-600 hover:underline">
                            {{ $app['id'] }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($app['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $app['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $app['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">{{ $app['vacancy'] }}</div>
                        <div class="text-xs text-slate-400 font-mono">{{ $app['vid'] }}</div>
                    </td>
                    <td>
                        <a href="{{ route('employment.employers.show', 1) }}"
                           class="text-sm text-slate-700 font-medium hover:text-indigo-600">
                            {{ $app['employer'] }}
                        </a>
                    </td>
                    <td class="text-sm text-slate-600">{{ $app['country'] }}</td>
                    <td class="text-sm text-slate-600">{{ $app['by'] }}</td>
                    <td class="text-sm text-slate-500 whitespace-nowrap">{{ $app['date'] }}</td>
                    <td>
                        <span class="badge {{ $decisionMap[$app['decision']]['class'] ?? 'badge-draft' }} badge-dot">
                            {{ $decisionMap[$app['decision']]['label'] ?? $app['decision'] }}
                        </span>
                    </td>
                    <td><x-status-badge :status="$app['status']" /></td>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}" class="btn btn-ghost btn-xs">
                            <i data-lucide="eye" style="width:13px;height:13px"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–7 of 47 applications</div>
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
