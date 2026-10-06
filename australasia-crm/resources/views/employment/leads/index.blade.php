<x-layouts.app title="Leads — Foreign Employment">

<x-page-header
    title="Leads"
    subtitle="Track and convert incoming leads to registered candidates"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Leads']]">
    <x-slot:actions>
        <a href="{{ route('employment.leads.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Lead
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="84" label="Total Leads"     icon="users"        color="indigo" />
    <x-stat-card value="23" label="New Today"       icon="user-plus"    color="emerald" />
    <x-stat-card value="31" label="Follow-up Due"   icon="clock"        color="amber" />
    <x-stat-card value="41" label="Converted"       icon="check-circle" color="teal" />
    <x-stat-card value="19" label="Lost"            icon="x-circle"     color="rose" />
</div>

<!-- Filter -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search leads…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Sources</option>
                <option>Walk-in</option><option>Referral</option><option>Agent</option>
                <option>Online Enquiry</option><option>Employer Contact</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>New</option><option>Contacted</option><option>Follow-up</option>
                <option>Converted</option><option>Lost</option>
            </select>
            <input type="date" class="form-input" style="width:auto" placeholder="From date">
        </div>
    </div>
</div>

<!-- Leads Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Source</th>
                    <th>Contact</th>
                    <th>Handler</th>
                    <th>Date Received</th>
                    <th>Follow-up</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $leads = [
                    ['name' => 'Thilini Madushan',    'nic' => '199508204567', 'phone' => '077 234 5678', 'source' => 'Walk-in',         'handler' => 'Kasun B.',  'date' => '06 Oct',  'followup' => 'Today',    'status' => 'new',       'notes' => 'Interested in Australia Warehouse role'],
                    ['name' => 'Roshan Wijesinghe',   'nic' => '200201034567', 'phone' => '077 456 7891', 'source' => 'Walk-in',         'handler' => 'Kasun B.',  'date' => '06 Oct',  'followup' => 'Tomorrow', 'status' => 'contacted', 'notes' => 'Call confirmed for tomorrow 2pm'],
                    ['name' => 'Malith Jayasekara',   'nic' => '199801234100', 'phone' => '071 900 1234', 'source' => 'Online Enquiry',  'handler' => 'Priya H.',  'date' => '05 Oct',  'followup' => '08 Oct',   'status' => 'follow_up', 'notes' => 'Sent brochure via WhatsApp'],
                    ['name' => 'Chamali Abeywickrama','nic' => '200012341234', 'phone' => '076 543 2109', 'source' => 'Referral',        'handler' => 'Amila P.',  'date' => '04 Oct',  'followup' => '09 Oct',   'status' => 'follow_up', 'notes' => 'Referred by Kasun Bandara'],
                    ['name' => 'Lahiru Senaratne',    'nic' => '199705678901', 'phone' => '070 234 5671', 'source' => 'Agent',           'handler' => 'Nimal J.',  'date' => '03 Oct',  'followup' => '—',        'status' => 'converted', 'notes' => 'Converted — see CAND-1295'],
                    ['name' => 'Samanthi Gunawardena','nic' => '199612045678', 'phone' => '078 876 5432', 'source' => 'Employer Contact','handler' => 'Nimal J.',  'date' => '02 Oct',  'followup' => '—',        'status' => 'lost',      'notes' => 'Not interested — chose another agency'],
                ];
                @endphp

                @foreach($leads as $lead)
                @php
                $statusBadge = [
                    'new'       => 'badge-registered',
                    'contacted' => 'badge-processing',
                    'follow_up' => 'badge-pending',
                    'converted' => 'badge-approved',
                    'lost'      => 'badge-closed',
                ];
                $statusLabel = ['new' => 'New', 'contacted' => 'Contacted', 'follow_up' => 'Follow-up', 'converted' => 'Converted', 'lost' => 'Lost'];
                @endphp
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($lead['name'], 0, 2) }}</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $lead['name'] }}</p>
                                <p class="text-xs text-slate-400 font-mono">{{ $lead['nic'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-lead badge-dot">{{ $lead['source'] }}</span>
                    </td>
                    <td class="text-sm text-slate-600">{{ $lead['phone'] }}</td>
                    <td class="text-sm text-slate-600">{{ $lead['handler'] }}</td>
                    <td class="text-sm text-slate-500">{{ $lead['date'] }}</td>
                    <td>
                        <span class="text-sm font-semibold {{ $lead['followup'] === 'Today' ? 'text-rose-600' : ($lead['followup'] === 'Tomorrow' ? 'text-amber-600' : 'text-slate-600') }}">
                            {{ $lead['followup'] }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $statusBadge[$lead['status']] }} badge-dot">
                            {{ $statusLabel[$lead['status']] }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.leads.show', 1) }}" class="btn btn-ghost btn-xs" title="View">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            @if($lead['status'] !== 'converted')
                            <a href="{{ route('employment.candidates.create') }}" class="btn btn-success btn-xs" title="Convert to candidate">
                                <i data-lucide="user-check" style="width:13px;height:13px"></i>
                            </a>
                            @endif
                            <button class="btn btn-ghost btn-xs" title="Add note">
                                <i data-lucide="message-square" style="width:13px;height:13px"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–6 of 84 leads</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Previous</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">3</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
