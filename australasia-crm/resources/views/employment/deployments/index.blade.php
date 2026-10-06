<x-layouts.app title="Deployments — Foreign Employment">

<x-page-header
    title="Deployments"
    subtitle="Flight bookings, pre-departure briefings and dispatch management"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Deployments']]">
    <x-slot:actions>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plane" style="width:14px;height:14px"></i>
            Schedule Deployment
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="18" label="Scheduled"          icon="calendar"     color="indigo" />
    <x-stat-card value="5"  label="This Month"         icon="plane"        color="violet" />
    <x-stat-card value="3"  label="Departing This Week" icon="zap"         color="amber" />
    <x-stat-card value="11" label="Deployed (Oct)"     icon="check-circle" color="emerald" />
    <x-stat-card value="203" label="Total Deployed"    icon="globe"        color="teal" />
</div>

<!-- Upcoming Deployments — Highlighted -->
<div class="alert alert-info mb-5">
    <i data-lucide="calendar-check" style="width:18px;height:18px;flex-shrink:0"></i>
    <div>
        <p class="font-bold">3 candidates departing within the next 7 days</p>
        <p class="text-sm mt-0.5">Ensure briefing, flight, and final document checks are complete before departure.</p>
    </div>
</div>

<!-- Deployments Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Deployment Schedule</h3>
        <div class="flex gap-2">
            <button class="filter-pill active">All</button>
            <button class="filter-pill">Upcoming</button>
            <button class="filter-pill">This Month</button>
            <button class="filter-pill">Departed</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Deployment ID</th>
                    <th>Candidate</th>
                    <th>Employer / Vacancy</th>
                    <th>Destination</th>
                    <th>Flight</th>
                    <th>Departure Date</th>
                    <th>Briefing</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $deployments = [
                    ['id' => 'DEP-0018', 'candidate' => 'Kavindu Perera',         'cid' => 'CAND-1297', 'employer' => 'Global Workforce Solutions', 'vacancy' => 'Warehouse Operator', 'country' => 'Melbourne, AU', 'flight' => 'UL 605', 'departure' => '10 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment', 'urgent' => true],
                    ['id' => 'DEP-0017', 'candidate' => 'Pradeep Fernando',        'cid' => 'CAND-1290', 'employer' => 'Global Workforce Solutions', 'vacancy' => 'Warehouse Operator', 'country' => 'Melbourne, AU', 'flight' => 'UL 605', 'departure' => '10 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment', 'urgent' => true],
                    ['id' => 'DEP-0016', 'candidate' => 'Dilrukshi Jayakody',      'cid' => 'CAND-1278', 'employer' => 'Pacific Hospitality Group',  'vacancy' => 'Hospitality Staff',  'country' => 'Sydney, AU',    'flight' => 'SQ 483',  'departure' => '12 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployment', 'urgent' => true],
                    ['id' => 'DEP-0015', 'candidate' => 'Chamari Dias',            'cid' => 'CAND-1292', 'employer' => 'Al Futtaim Manufacturing',  'vacancy' => 'Machine Operator',   'country' => 'Dubai, UAE',    'flight' => 'EK 343',  'departure' => '18 Oct 2026', 'briefing' => 'Pending',   'status' => 'checklist', 'urgent' => false],
                    ['id' => 'DEP-0014', 'candidate' => 'Nadeeka Silva',           'cid' => 'CAND-1296', 'employer' => 'Qatar Industrial Services', 'vacancy' => 'Factory Worker',     'country' => 'Doha, QA',      'flight' => 'QR 157',  'departure' => '22 Oct 2026', 'briefing' => 'Scheduled', 'status' => 'visa_processing', 'urgent' => false],
                    ['id' => 'DEP-0012', 'candidate' => 'Kumari Dissanayake',      'cid' => 'CAND-1271', 'employer' => 'Pacific Hospitality Group',  'vacancy' => 'Hospitality Staff',  'country' => 'Sydney, AU',    'flight' => 'UL 601', 'departure' => '02 Oct 2026', 'briefing' => 'Completed', 'status' => 'deployed', 'urgent' => false],
                    ['id' => 'DEP-0011', 'candidate' => 'Roshan Thilakasiri',      'cid' => 'CAND-1268', 'employer' => 'Al Futtaim Manufacturing',  'vacancy' => 'Machine Operator',   'country' => 'Dubai, UAE',    'flight' => 'EK 345', 'departure' => '28 Sep 2026', 'briefing' => 'Completed', 'status' => 'deployed', 'urgent' => false],
                ];
                @endphp

                @foreach($deployments as $dep)
                <tr class="{{ $dep['urgent'] ? 'bg-amber-50' : '' }}">
                    <td>
                        <a href="{{ route('employment.deployments.show', 1) }}"
                           class="font-mono text-sm font-semibold text-indigo-600 hover:underline">
                            {{ $dep['id'] }}
                        </a>
                        @if($dep['urgent'])
                        <span class="badge badge-warning badge-dot block w-fit mt-0.5">Urgent</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($dep['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $dep['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $dep['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">{{ $dep['vacancy'] }}</div>
                        <div class="text-xs text-slate-500">{{ $dep['employer'] }}</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5 text-sm text-slate-600">
                            <i data-lucide="map-pin" style="width:13px;height:13px;color:#94a3b8"></i>
                            {{ $dep['country'] }}
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5 text-sm font-mono font-semibold text-slate-800">
                            <i data-lucide="plane" style="width:13px;height:13px;color:#6366f1"></i>
                            {{ $dep['flight'] }}
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold {{ $dep['urgent'] ? 'text-amber-700' : 'text-slate-700' }} whitespace-nowrap">
                            {{ $dep['departure'] }}
                        </div>
                    </td>
                    <td>
                        @php
                        $bc = ['Completed' => 'badge-approved', 'Pending' => 'badge-pending', 'Scheduled' => 'badge-registered'];
                        @endphp
                        <span class="badge {{ $bc[$dep['briefing']] ?? 'badge-draft' }} badge-dot">{{ $dep['briefing'] }}</span>
                    </td>
                    <td><x-status-badge :status="$dep['status']" /></td>
                    <td>
                        <a href="{{ route('employment.deployments.show', 1) }}" class="btn btn-ghost btn-xs">
                            <i data-lucide="eye" style="width:13px;height:13px"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
