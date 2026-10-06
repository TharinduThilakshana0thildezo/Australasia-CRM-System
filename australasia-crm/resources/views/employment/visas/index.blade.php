<x-layouts.app title="Visa Processing — Foreign Employment">

<x-page-header
    title="Visa Processing"
    subtitle="Track all active visa applications and their status"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Visa Processing']]">
    <x-slot:actions>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Visa Application
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
    <x-stat-card value="67"  label="Total Active"       icon="shield" color="indigo" />
    <x-stat-card value="31"  label="Preparing"          icon="file-text" color="amber" />
    <x-stat-card value="24"  label="Submitted"          icon="send" color="violet" />
    <x-stat-card value="8"   label="Processing"         icon="loader" color="cyan" />
    <x-stat-card value="4"   label="Visa Delays"        icon="clock" color="rose" />
    <x-stat-card value="203" label="Approved (Total)"   icon="shield-check" color="emerald" />
</div>

<!-- ⚠ VISA DELAY ALERT -->
<div class="alert alert-danger mb-5">
    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="flex-1">
        <p class="font-bold">4 visa applications have exceeded the allowed processing timeframe</p>
        <p class="text-sm mt-0.5">These cases may be eligible for refund review. Immediate action required.</p>
    </div>
    <a href="#overdue" class="btn btn-danger btn-sm flex-shrink-0">View Delayed Cases</a>
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search candidate, application, reference…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>Preparing</option><option>Submitted</option><option>Processing</option>
                <option>Additional Docs Required</option><option>Approved</option>
                <option>Rejected</option><option>Delayed</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Countries</option>
                <option>Australia</option><option>UAE</option><option>Qatar</option>
                <option>Kuwait</option><option>Malaysia</option><option>Saudi Arabia</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Staff</option>
                <option>Nimal Jayawardena</option>
                <option>Priya Hewage</option>
            </select>
        </div>
    </div>
</div>

<!-- Visa Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Visa ID</th>
                    <th>Candidate</th>
                    <th>Country / Type</th>
                    <th>Application</th>
                    <th>Submitted</th>
                    <th>Deadline</th>
                    <th>Days Elapsed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $visas = [
                    ['visa_id' => 'VSA-00291', 'candidate' => 'Nadeeka Silva',       'cid' => 'CAND-1296', 'country' => 'Australia', 'type' => '482 Work',  'app' => 'APP-0849', 'submitted' => '01 Oct 2026', 'deadline' => '30 Nov 2026', 'days' => 5,  'status' => 'submitted', 'overdue' => false],
                    ['visa_id' => 'VSA-00290', 'candidate' => 'Chamari Dias',        'cid' => 'CAND-1292', 'country' => 'UAE',       'type' => 'Work',      'app' => 'APP-0847', 'submitted' => '28 Sep 2026', 'deadline' => '28 Oct 2026', 'days' => 8,  'status' => 'processing', 'overdue' => false],
                    ['visa_id' => 'VSA-00289', 'candidate' => 'Indika Chandrasena',  'cid' => 'CAND-1289', 'country' => 'Qatar',     'type' => 'Work',      'app' => 'APP-0845', 'submitted' => '10 Sep 2026', 'deadline' => '10 Oct 2026', 'days' => 26, 'status' => 'visa_processing', 'overdue' => true],
                    ['visa_id' => 'VSA-00287', 'candidate' => 'Malith Perera',       'cid' => 'CAND-1281', 'country' => 'Kuwait',    'type' => 'Work',      'app' => 'APP-0841', 'submitted' => '01 Sep 2026', 'deadline' => '01 Oct 2026', 'days' => 35, 'status' => 'visa_processing', 'overdue' => true],
                    ['visa_id' => 'VSA-00284', 'candidate' => 'Kavindu Perera',      'cid' => 'CAND-1297', 'country' => 'Australia', 'type' => '482 Work',  'app' => 'APP-0842', 'submitted' => '05 Oct 2026', 'deadline' => '04 Dec 2026', 'days' => 1,  'status' => 'visa_approved', 'overdue' => false],
                    ['visa_id' => 'VSA-00279', 'candidate' => 'Ruwan Pathirana',     'cid' => 'CAND-1293', 'country' => 'Saudi Arabia','type' => 'Iqama',   'app' => 'APP-0836', 'submitted' => '15 Aug 2026', 'deadline' => '15 Sep 2026', 'days' => 51, 'status' => 'refund', 'overdue' => true],
                ];
                @endphp

                @foreach($visas as $v)
                <tr class="{{ $v['overdue'] ? 'bg-rose-50' : '' }}">
                    <td>
                        <a href="{{ route('employment.visas.show', 1) }}"
                           class="font-mono font-semibold text-indigo-600 hover:underline">
                            {{ $v['visa_id'] }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($v['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $v['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $v['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-slate-800">{{ $v['country'] }}</div>
                        <div class="text-xs text-slate-500">{{ $v['type'] }}</div>
                    </td>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}"
                           class="text-sm text-indigo-600 font-mono hover:underline">
                            {{ $v['app'] }}
                        </a>
                    </td>
                    <td class="text-sm text-slate-600">{{ $v['submitted'] }}</td>
                    <td class="text-sm {{ $v['overdue'] ? 'text-rose-600 font-bold' : 'text-slate-600' }}">
                        {{ $v['deadline'] }}
                    </td>
                    <td>
                        <span class="text-sm font-bold {{ $v['overdue'] ? 'text-rose-600' : 'text-slate-700' }}">
                            {{ $v['days'] }} days
                            @if($v['overdue'])
                            <span class="text-xs font-normal text-rose-500 block">EXCEEDED</span>
                            @endif
                        </span>
                    </td>
                    <td>
                        <x-status-badge :status="$v['status']" />
                    </td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.visas.show', 1) }}" class="btn btn-ghost btn-xs">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            @if($v['overdue'])
                            <a href="{{ route('employment.refunds.create') }}"
                               class="btn btn-danger btn-xs" title="Review refund eligibility">
                                <i data-lucide="rotate-ccw" style="width:13px;height:13px"></i>
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
        <div class="text-sm text-slate-500">Showing 1–6 of 67 active visa applications</div>
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
