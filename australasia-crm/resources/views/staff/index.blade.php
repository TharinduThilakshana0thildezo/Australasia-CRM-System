<x-layouts.app title="Staff — Australasia CRM">

<x-page-header
    title="Staff"
    subtitle="Staff accounts, roles and performance overview"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Staff']]">
    <x-slot:actions>
        <a href="{{ route('staff.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>
            Add Staff
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="12" label="Total Staff"        icon="users"          color="indigo" />
    <x-stat-card value="11" label="Active"             icon="check-circle"   color="emerald" />
    <x-stat-card value="3"  label="Managers"           icon="shield"         color="violet" />
    <x-stat-card value="1"  label="Director"           icon="star"           color="amber" />
</div>

<!-- Staff Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Staff Member</th>
                    <th>Role</th>
                    <th>Modules Access</th>
                    <th>Active Cases</th>
                    <th>Joined</th>
                    <th>Last Active</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $staff = [
                    ['name' => 'Senaka Karunaratne', 'email' => 'senaka@australasia.lk',  'role' => 'Director',           'modules' => ['All'],                                    'cases' => '—', 'joined' => 'Jan 2022', 'last' => 'Today',      'status' => 'active',   'color' => 'amber'],
                    ['name' => 'Nimal Jayawardena',  'email' => 'nimal@australasia.lk',   'role' => 'Employment Manager', 'modules' => ['Employment', 'Finance'],                  'cases' => '18','joined' => 'Mar 2022', 'last' => 'Today',      'status' => 'active',   'color' => 'indigo'],
                    ['name' => 'Priya Hewage',       'email' => 'priya@australasia.lk',   'role' => 'Case Officer',       'modules' => ['Employment', 'Documents'],                'cases' => '14','joined' => 'Jun 2022', 'last' => 'Today',      'status' => 'active',   'color' => 'violet'],
                    ['name' => 'Kasun Bandara',      'email' => 'kasun@australasia.lk',   'role' => 'Case Officer',       'modules' => ['Employment', 'Consultancy'],              'cases' => '12','joined' => 'Aug 2022', 'last' => 'Today',      'status' => 'active',   'color' => 'emerald'],
                    ['name' => 'Amila Peiris',       'email' => 'amila@australasia.lk',   'role' => 'Consultancy Officer','modules' => ['Consultancy', 'Documents'],               'cases' => '9', 'joined' => 'Jan 2023', 'last' => 'Today',      'status' => 'active',   'color' => 'cyan'],
                    ['name' => 'Dilini Wickrama',    'email' => 'dilini@australasia.lk',  'role' => 'Academy Coordinator','modules' => ['Academy'],                                'cases' => '4', 'joined' => 'Mar 2023', 'last' => '5 Oct',      'status' => 'active',   'color' => 'rose'],
                    ['name' => 'Ravi Siriwardene',   'email' => 'ravi@australasia.lk',    'role' => 'Finance Officer',    'modules' => ['Finance'],                                'cases' => '—', 'joined' => 'May 2023', 'last' => '4 Oct',      'status' => 'active',   'color' => 'amber'],
                    ['name' => 'Supun Jayasinghe',   'email' => 'supun@australasia.lk',   'role' => 'Case Officer',       'modules' => ['Employment'],                             'cases' => '6', 'joined' => 'Sep 2023', 'last' => '1 Oct',      'status' => 'inactive', 'color' => 'slate'],
                ];
                @endphp

                @foreach($staff as $s)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar avatar-sm avatar-{{ $s['color'] }}">
                                {{ substr($s['name'], 0, 2) }}
                            </div>
                            <div>
                                <a href="{{ route('staff.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $s['name'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $s['email'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="text-sm font-medium text-slate-700">{{ $s['role'] }}</span>
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach($s['modules'] as $mod)
                            @php
                            $mc = ['All' => 'badge-employer', 'Employment' => 'badge-registered', 'Consultancy' => 'badge-visa', 'Academy' => 'badge-pool', 'Finance' => 'badge-approved', 'Documents' => 'badge-documents'];
                            @endphp
                            <span class="badge {{ $mc[$mod] ?? 'badge-draft' }} text-xs">{{ $mod }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-sm font-bold text-slate-800">{{ $s['cases'] }}</td>
                    <td class="text-sm text-slate-500">{{ $s['joined'] }}</td>
                    <td class="text-sm text-slate-500">{{ $s['last'] }}</td>
                    <td><x-status-badge :status="$s['status']" /></td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('staff.show', 1) }}" class="btn btn-ghost btn-xs">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            <button class="btn btn-ghost btn-xs">
                                <i data-lucide="edit-2" style="width:13px;height:13px"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
