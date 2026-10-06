<x-layouts.app title="Application Checklists — Foreign Employment">

<x-page-header
    title="Application Checklists"
    subtitle="Post-selection pre-departure document verification checklists"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Checklists']]">
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="31" label="Total"          icon="clipboard-list" color="indigo" />
    <x-stat-card value="12" label="In Progress"    icon="loader"         color="amber" />
    <x-stat-card value="14" label="Completed"      icon="check-circle"  color="emerald" />
    <x-stat-card value="5"  label="Overdue Items"  icon="alert-triangle" color="rose" />
    <x-stat-card value="3"  label="Correction Req" icon="edit"           color="orange" />
</div>

<!-- Checklists Table -->
<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong class="text-slate-800">1–8</strong> of <strong class="text-slate-800">31</strong> checklists</div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Checklist ID</th>
                    <th>Candidate</th>
                    <th>Application</th>
                    <th>Employer</th>
                    <th>Items Done</th>
                    <th>Last Updated</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $checklists = [
                    ['id' => 'CKL-0031', 'candidate' => 'Kavindu Perera',     'cid' => 'CAND-1297', 'app' => 'APP-0842', 'employer' => 'Global Workforce Solutions', 'done' => 12, 'total' => 12, 'updated' => '06 Oct', 'deadline' => '12 Oct', 'status' => 'completed'],
                    ['id' => 'CKL-0030', 'candidate' => 'Chamari Dias',        'cid' => 'CAND-1292', 'app' => 'APP-0841', 'employer' => 'Al Futtaim Manufacturing',  'done' => 8,  'total' => 12, 'updated' => '05 Oct', 'deadline' => '14 Oct', 'status' => 'checklist'],
                    ['id' => 'CKL-0029', 'candidate' => 'Pradeep Fernando',    'cid' => 'CAND-1290', 'app' => 'APP-0840', 'employer' => 'Global Workforce Solutions', 'done' => 11, 'total' => 12, 'updated' => '06 Oct', 'deadline' => '13 Oct', 'status' => 'checklist'],
                    ['id' => 'CKL-0028', 'candidate' => 'Ajith Nanayakkara',   'cid' => 'CAND-1282', 'app' => 'APP-0839', 'employer' => 'Kuwait General Contracting','done' => 5,  'total' => 12, 'updated' => '03 Oct', 'deadline' => '08 Oct', 'status' => 'overdue'],
                    ['id' => 'CKL-0027', 'candidate' => 'Dilrukshi Jayakody',  'cid' => 'CAND-1278', 'app' => 'APP-0835', 'employer' => 'Pacific Hospitality Group', 'done' => 12, 'total' => 12, 'updated' => '04 Oct', 'deadline' => '06 Oct', 'status' => 'completed'],
                    ['id' => 'CKL-0026', 'candidate' => 'Renuka Bandara',      'cid' => 'CAND-1271', 'app' => 'APP-0833', 'employer' => 'Qatar Industrial Services', 'done' => 3,  'total' => 12, 'updated' => '01 Oct', 'deadline' => '06 Oct', 'status' => 'correction_required'],
                ];
                @endphp

                @foreach($checklists as $cl)
                @php
                $pct = $cl['total'] > 0 ? round($cl['done'] / $cl['total'] * 100) : 0;
                $isOverdue = in_array($cl['status'], ['overdue', 'correction_required']);
                @endphp
                <tr class="{{ $isOverdue ? 'bg-rose-50' : '' }}">
                    <td>
                        <a href="{{ route('employment.checklists.show', 1) }}"
                           class="font-mono text-sm font-semibold text-indigo-600 hover:underline">
                            {{ $cl['id'] }}
                        </a>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-indigo">{{ substr($cl['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600">
                                    {{ $cl['candidate'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $cl['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('employment.applications.show', 1) }}"
                           class="text-sm font-mono text-indigo-600 hover:underline">
                            {{ $cl['app'] }}
                        </a>
                    </td>
                    <td class="text-sm text-slate-700">{{ $cl['employer'] }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold
                                {{ $pct === 100 ? 'text-emerald-600' : ($pct < 50 ? 'text-rose-600' : 'text-amber-600') }}">
                                {{ $cl['done'] }}/{{ $cl['total'] }}
                            </span>
                            <div class="progress-bar-track w-20">
                                <div class="progress-bar-fill
                                    {{ $pct === 100 ? 'bg-emerald-500' : ($pct < 50 ? 'bg-rose-400' : 'bg-amber-400') }}"
                                     style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-slate-500">{{ $cl['updated'] }}</td>
                    <td class="{{ $isOverdue ? 'font-bold text-rose-600' : 'text-slate-600' }} text-sm whitespace-nowrap">
                        {{ $cl['deadline'] }}
                        @if($isOverdue) <span class="text-xs font-normal text-rose-500 block">OVERDUE</span> @endif
                    </td>
                    <td><x-status-badge :status="$cl['status']" /></td>
                    <td>
                        <a href="{{ route('employment.checklists.show', 1) }}" class="btn btn-ghost btn-xs">
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
