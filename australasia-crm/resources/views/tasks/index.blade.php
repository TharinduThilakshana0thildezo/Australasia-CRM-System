<x-layouts.app title="Tasks">

<x-page-header
    title="Tasks"
    subtitle="My tasks, team tasks, and follow-up reminders"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Tasks']]">
    <x-slot:actions>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Task
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="24"  label="My Tasks"          icon="check-square"  color="indigo" />
    <x-stat-card value="8"   label="Due Today"         icon="clock"         color="amber" />
    <x-stat-card value="3"   label="Overdue"           icon="alert-triangle" color="rose" />
    <x-stat-card value="71"  label="Team Tasks"        icon="users"         color="violet" />
    <x-stat-card value="52"  label="Completed (Oct)"   icon="check-circle"  color="emerald" />
</div>

<!-- Filter Tabs -->
<div class="card mb-5">
    <div class="tabs-nav px-4 pt-2">
        <button class="tab-item active">My Tasks <span class="tab-count">24</span></button>
        <button class="tab-item">Due Today <span class="tab-count">8</span></button>
        <button class="tab-item">Team Tasks <span class="tab-count">71</span></button>
        <button class="tab-item">Completed</button>
    </div>
    <div class="card-body pt-3">
        <div class="flex flex-wrap gap-3">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search tasks…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Priorities</option>
                <option>High</option><option>Medium</option><option>Low</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Modules</option>
                <option>Foreign Employment</option><option>Consultancy</option><option>Academy</option><option>Finance</option>
            </select>
        </div>
    </div>
</div>

<!-- Task List -->
<div class="space-y-3">
    @php
    $tasks = [
        ['id' => 'TSK-0191', 'title' => 'Follow up with Kavindu Perera re: flight confirmation',     'due' => '07 Oct 2026', 'priority' => 'high',   'module' => 'Employment',   'link_type' => 'Candidate', 'link_name' => 'Kavindu Perera',   'assigned_to' => 'Nimal J.',  'status' => 'open',  'overdue' => false],
        ['id' => 'TSK-0190', 'title' => 'Verify medical certificate — Chamari Dias',                 'due' => '07 Oct 2026', 'priority' => 'high',   'module' => 'Employment',   'link_type' => 'Candidate', 'link_name' => 'Chamari Dias',      'assigned_to' => 'Priya H.', 'status' => 'open',  'overdue' => false],
        ['id' => 'TSK-0189', 'title' => 'Call Ajith re: overdue checklist items',                   'due' => '05 Oct 2026', 'priority' => 'high',   'module' => 'Employment',   'link_type' => 'Checklist', 'link_name' => 'CKL-0028',         'assigned_to' => 'Nimal J.',  'status' => 'open',  'overdue' => true],
        ['id' => 'TSK-0188', 'title' => 'Arrange pre-departure briefing for 10 Oct batch',          'due' => '08 Oct 2026', 'priority' => 'medium', 'module' => 'Employment',   'link_type' => 'Deployment','link_name' => 'DEP-0018/DEP-0017', 'assigned_to' => 'Kasun B.', 'status' => 'open',  'overdue' => false],
        ['id' => 'TSK-0187', 'title' => 'Update Sachini Ranasinghe visa submission documents',       'due' => '09 Oct 2026', 'priority' => 'medium', 'module' => 'Consultancy',  'link_type' => 'Student',   'link_name' => 'Sachini Ranasinghe','assigned_to' => 'Amila P.', 'status' => 'open',  'overdue' => false],
        ['id' => 'TSK-0186', 'title' => 'Review refund case REF-0013 for Director',                 'due' => '06 Oct 2026', 'priority' => 'medium', 'module' => 'Finance',      'link_type' => 'Refund',    'link_name' => 'REF-0013',          'assigned_to' => 'Nimal J.', 'status' => 'open',  'overdue' => true],
        ['id' => 'TSK-0185', 'title' => 'Print attendance register for Batch-26-10-A',              'due' => '07 Oct 2026', 'priority' => 'low',    'module' => 'Academy',      'link_type' => 'Batch',     'link_name' => 'Batch-26-10-A',     'assigned_to' => 'Kasun B.', 'status' => 'open',  'overdue' => false],
        ['id' => 'TSK-0184', 'title' => 'Send registration link to Roshan Wijesinghe',              'due' => '08 Oct 2026', 'priority' => 'medium', 'module' => 'Employment',   'link_type' => 'Lead',      'link_name' => 'Roshan Wijesinghe', 'assigned_to' => 'Kasun B.', 'status' => 'open',  'overdue' => false],
    ];
    $priorityColors = ['high' => 'badge-refund', 'medium' => 'badge-pending', 'low' => 'badge-draft'];
    $moduleColors   = ['Employment' => 'stream-employment', 'Consultancy' => 'stream-consultancy', 'Academy' => 'stream-academy', 'Finance' => 'badge-employer'];
    @endphp

    @foreach($tasks as $task)
    <div class="card {{ $task['overdue'] ? 'border-rose-200' : '' }} hover:shadow-md transition-shadow">
        <div class="card-body py-3">
            <div class="flex items-start gap-4">
                <!-- Checkbox -->
                <div class="flex-shrink-0 pt-0.5">
                    <div class="w-5 h-5 border-2 {{ $task['overdue'] ? 'border-rose-400' : 'border-slate-300' }} rounded cursor-pointer hover:border-indigo-400 transition-colors"></div>
                </div>

                <!-- Task content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-start gap-2 flex-wrap">
                        <p class="text-sm font-semibold text-slate-800 flex-1">{{ $task['title'] }}</p>
                        @if($task['overdue'])
                        <span class="badge badge-overdue badge-dot flex-shrink-0">OVERDUE</span>
                        @endif
                    </div>
                    <div class="flex flex-wrap items-center gap-3 mt-1.5 text-xs text-slate-500">
                        <span class="badge {{ $priorityColors[$task['priority']] }} badge-dot">{{ ucfirst($task['priority']) }}</span>
                        <span class="stream-badge {{ $moduleColors[$task['module']] ?? '' }}">{{ $task['module'] }}</span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="link" style="width:11px;height:11px"></i>
                            {{ $task['link_type'] }}: {{ $task['link_name'] }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="user" style="width:11px;height:11px"></i>
                            {{ $task['assigned_to'] }}
                        </span>
                        <span class="flex items-center gap-1 {{ $task['overdue'] ? 'text-rose-600 font-bold' : '' }}">
                            <i data-lucide="calendar" style="width:11px;height:11px"></i>
                            Due: {{ $task['due'] }}
                        </span>
                        <code class="text-slate-400">{{ $task['id'] }}</code>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-1 flex-shrink-0">
                    <button class="btn btn-success btn-xs">Done</button>
                    <button class="btn btn-ghost btn-xs">
                        <i data-lucide="more-horizontal" style="width:13px;height:13px"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
