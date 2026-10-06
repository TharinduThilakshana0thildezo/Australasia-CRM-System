<x-layouts.app title="Candidate Matching — Foreign Employment">

<x-page-header
    title="Candidate Matching"
    subtitle="Match talent pool candidates to open employer vacancies"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Matching']]">
</x-page-header>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

    <!-- ===== LEFT: VACANCY PANEL ===== -->
    <div class="space-y-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Select Vacancy</h3>
                <a href="{{ route('employment.vacancies.index') }}" class="text-xs text-indigo-600 font-semibold">View all →</a>
            </div>
            <div class="card-body pt-0">
                <div class="search-wrapper mb-3">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search vacancies…">
                </div>

                @php
                $vacancies = [
                    ['id' => 'VAC-0042', 'title' => 'Warehouse Operator', 'employer' => 'Global Workforce Solutions Pty Ltd', 'country' => 'Australia', 'openings' => 5, 'salary' => 'AUD 55,000/yr', 'deadline' => '30 Oct 2026', 'status' => 'open', 'active' => true],
                    ['id' => 'VAC-0041', 'title' => 'Machine Operator',   'employer' => 'Al Futtaim Manufacturing LLC',      'country' => 'UAE',       'openings' => 8, 'salary' => 'AED 3,500/mo', 'deadline' => '15 Nov 2026', 'status' => 'open', 'active' => false],
                    ['id' => 'VAC-0039', 'title' => 'Factory Worker',     'employer' => 'Qatar Industrial Services',         'country' => 'Qatar',     'openings' => 12,'salary' => 'QAR 2,800/mo', 'deadline' => '20 Nov 2026', 'status' => 'open', 'active' => false],
                    ['id' => 'VAC-0037', 'title' => 'Heavy Vehicle Driver','employer' => 'Saudi Logistics Co.',              'country' => 'Saudi Arabia','openings' => 3,'salary' => 'SAR 4,200/mo','deadline' => '10 Nov 2026', 'status' => 'matching', 'active' => false],
                ];
                @endphp

                @foreach($vacancies as $vac)
                <div class="border-2 rounded-xl p-4 mb-3 cursor-pointer transition-all
                     {{ $vac['active'] ? 'border-indigo-400 bg-indigo-50' : 'border-slate-200 bg-white hover:border-indigo-200' }}">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">{{ $vac['title'] }}</h4>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $vac['employer'] }}</p>
                        </div>
                        <x-status-badge :status="$vac['status']" />
                    </div>
                    <div class="flex flex-wrap gap-3 text-xs text-slate-500">
                        <span class="flex items-center gap-1">
                            <i data-lucide="globe" style="width:11px;height:11px"></i> {{ $vac['country'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="users" style="width:11px;height:11px"></i> {{ $vac['openings'] }} openings
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="dollar-sign" style="width:11px;height:11px"></i> {{ $vac['salary'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="calendar" style="width:11px;height:11px"></i> Deadline: {{ $vac['deadline'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Vacancy Details (active) -->
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">VAC-0042 — Warehouse Operator</h3>
                    <p class="text-xs text-slate-500">Global Workforce Solutions Pty Ltd · Australia</p>
                </div>
                <a href="{{ route('employment.vacancies.show', 1) }}" class="btn btn-ghost btn-xs">
                    <i data-lucide="external-link" style="width:13px;height:13px"></i>
                </a>
            </div>
            <div class="card-body text-sm">
                <div class="grid grid-cols-2 gap-3">
                    @php
                    $vacDetails = [
                        ['l' => 'Openings',    'v' => '5 positions'],
                        ['l' => 'Location',    'v' => 'Melbourne, VIC'],
                        ['l' => 'Salary',      'v' => 'AUD 55,000/yr'],
                        ['l' => 'Employment',  'v' => 'Full-time, 2-year contract'],
                        ['l' => 'Experience',  'v' => 'Min. 2 years'],
                        ['l' => 'Age',         'v' => '21–45 years'],
                        ['l' => 'Deadline',    'v' => '30 Oct 2026'],
                        ['l' => 'Visa',        'v' => 'Subclass 482 sponsored'],
                    ];
                    @endphp
                    @foreach($vacDetails as $d)
                    <div>
                        <p class="text-xs text-slate-400 font-medium">{{ $d['l'] }}</p>
                        <p class="font-semibold text-slate-800 mt-0.5">{{ $d['v'] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <p class="text-xs font-semibold text-slate-500 mb-1">Required Skills</p>
                    <div class="flex flex-wrap gap-1">
                        @foreach(['Forklift', 'Packing', 'Inventory', 'English (Basic)', 'Heavy Lifting'] as $s)
                        <span class="badge badge-pool">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== RIGHT: CANDIDATE MATCHES ===== -->
    <div>
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Candidate Matches</h3>
                    <p class="text-xs text-slate-500 mt-0.5">For: Warehouse Operator — VAC-0042</p>
                </div>
                <span class="text-xs text-slate-500 font-medium">6 potential matches</span>
            </div>

            <div class="p-3 bg-amber-50 border-b border-amber-100 text-xs text-amber-800 flex items-center gap-2">
                <i data-lucide="info" style="width:13px;height:13px;flex-shrink:0"></i>
                Match scores are based on skills, country preference, experience, and document readiness.
            </div>

            <div class="divide-y divide-slate-50">
                @php
                $matches = [
                    ['id' => 'CAND-1290', 'name' => 'Pradeep Fernando',    'role' => 'Warehouse Op.',  'exp' => '5 yrs', 'score' => 94, 'docs' => true,  'training' => true,  'country_match' => true,  'color' => 'indigo'],
                    ['id' => 'CAND-1274', 'name' => 'Chaminda Rathnayake', 'role' => 'Driver',          'exp' => '12 yrs','score' => 78, 'docs' => true,  'training' => false, 'country_match' => false, 'color' => 'cyan'],
                    ['id' => 'CAND-1282', 'name' => 'Ajith Nanayakkara',   'role' => 'Construction',    'exp' => '8 yrs', 'score' => 71, 'docs' => true,  'training' => false, 'country_match' => true,  'color' => 'violet'],
                    ['id' => 'CAND-1285', 'name' => 'Samanthi Fernando',   'role' => 'Factory Worker',  'exp' => '3 yrs', 'score' => 65, 'docs' => true,  'training' => true,  'country_match' => false, 'color' => 'emerald'],
                    ['id' => 'CAND-1278', 'name' => 'Dilrukshi Jayakody',  'role' => 'Hospitality',     'exp' => '4 yrs', 'score' => 51, 'docs' => true,  'training' => true,  'country_match' => false, 'color' => 'rose'],
                    ['id' => 'CAND-1271', 'name' => 'Renuka Bandara',      'role' => 'Agriculture',     'exp' => '2 yrs', 'score' => 38, 'docs' => false, 'training' => false, 'country_match' => true,  'color' => 'amber'],
                ];
                @endphp

                @foreach($matches as $m)
                <div class="p-4 hover:bg-slate-50 transition-colors">
                    <div class="flex items-start gap-3">
                        <div class="avatar avatar-indigo avatar-sm flex-shrink-0">
                            {{ strtoupper(substr($m['name'], 0, 1) . substr(strstr($m['name'], ' '), 1, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <div>
                                    <a href="{{ route('employment.candidates.show', 1) }}"
                                       class="text-sm font-bold text-slate-800 hover:text-indigo-600">
                                        {{ $m['name'] }}
                                    </a>
                                    <p class="text-xs text-slate-400">{{ $m['id'] }} · {{ $m['role'] }} · {{ $m['exp'] }}</p>
                                </div>
                                <!-- Match score -->
                                <div class="flex-shrink-0 text-center">
                                    <div class="text-lg font-extrabold
                                        {{ $m['score'] >= 80 ? 'text-emerald-600' : ($m['score'] >= 60 ? 'text-amber-600' : 'text-rose-500') }}">
                                        {{ $m['score'] }}%
                                    </div>
                                    <div class="text-xs text-slate-400">match</div>
                                </div>
                            </div>

                            <!-- Match progress bar -->
                            <div class="progress-bar-track mt-2">
                                <div class="progress-bar-fill
                                    {{ $m['score'] >= 80 ? 'bg-emerald-500' : ($m['score'] >= 60 ? 'bg-amber-400' : 'bg-rose-400') }}"
                                     style="width: {{ $m['score'] }}%"></div>
                            </div>

                            <!-- Indicators -->
                            <div class="flex gap-3 mt-2 text-xs">
                                <span class="{{ $m['docs'] ? 'text-emerald-600' : 'text-rose-500' }}">
                                    {{ $m['docs'] ? '✓ Docs' : '✗ Docs' }}
                                </span>
                                <span class="{{ $m['training'] ? 'text-emerald-600' : 'text-slate-400' }}">
                                    {{ $m['training'] ? '✓ Training' : '— Training' }}
                                </span>
                                <span class="{{ $m['country_match'] ? 'text-emerald-600' : 'text-slate-400' }}">
                                    {{ $m['country_match'] ? '✓ Country Pref.' : '— Country Pref.' }}
                                </span>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="btn btn-ghost btn-xs">View</a>
                                <button class="btn btn-outline btn-xs">Shortlist</button>
                                <button class="btn btn-primary btn-xs">
                                    <i data-lucide="send" style="width:11px;height:11px"></i>
                                    Submit to Employer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
