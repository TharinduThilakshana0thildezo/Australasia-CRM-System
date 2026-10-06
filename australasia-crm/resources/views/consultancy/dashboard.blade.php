<x-layouts.app title="Consultancy Dashboard">

<x-page-header
    title="Consultancy"
    subtitle="Student counselling, institution applications and visa management"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Consultancy']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            New Student
        </a>
    </x-slot:actions>
</x-page-header>

<!-- KPIs -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="89"  label="Active Students"     icon="users"          color="violet" />
    <x-stat-card value="34"  label="Applications"        icon="file-text"      color="indigo" />
    <x-stat-card value="18"  label="Visa Processing"     icon="shield"         color="amber" />
    <x-stat-card value="12"  label="University Enrolled" icon="graduation-cap" color="emerald" />
</div>

<!-- Workflow Pipeline -->
<div class="card mb-6">
    <div class="card-header"><h3 class="card-title">Consultancy Pipeline</h3></div>
    <div class="card-body p-0">
        <div class="flex overflow-x-auto">
            @php
            $cpipeline = [
                ['label' => 'Lead',       'count' => 22, 'color' => '#64748b'],
                ['label' => 'Registered', 'count' => 89, 'color' => '#8b5cf6'],
                ['label' => 'Counselling','count' => 41, 'color' => '#6366f1'],
                ['label' => 'Shortlisted','count' => 28, 'color' => '#3b82f6'],
                ['label' => 'Applied',    'count' => 34, 'color' => '#06b6d4'],
                ['label' => 'Offer',      'count' => 19, 'color' => '#10b981'],
                ['label' => 'Visa',       'count' => 18, 'color' => '#a855f7'],
                ['label' => 'Enrolled',   'count' => 12, 'color' => '#22c55e'],
            ];
            @endphp
            @foreach($cpipeline as $stage)
            <div class="flex items-center flex-shrink-0">
                <div class="text-center px-5 py-5">
                    <div class="text-2xl font-extrabold" style="color: {{ $stage['color'] }}">{{ $stage['count'] }}</div>
                    <div class="text-xs text-slate-500 font-medium mt-1">{{ $stage['label'] }}</div>
                </div>
                @if(!$loop->last)
                <span class="text-slate-300 text-xl">›</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Students Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Students</h3>
        <a href="{{ route('consultancy.students.index') }}" class="text-sm text-indigo-600 font-semibold">View all →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Desired Country</th>
                    <th>Institution</th>
                    <th>Handler</th>
                    <th>Stage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $students = [
                    ['name' => 'Sachini Ranasinghe',   'id' => 'CON-0089', 'country' => 'Australia',   'institution' => 'Monash University',      'handler' => 'Priya H.',  'stage' => 'visa_processing'],
                    ['name' => 'Kavinda Gunasekara',    'id' => 'CON-0088', 'country' => 'UK',          'institution' => 'University of Manchester','handler' => 'Amila P.',  'stage' => 'checklist'],
                    ['name' => 'Thisara Wickramasinghe','id' => 'CON-0087', 'country' => 'Canada',      'institution' => 'Toronto Metropolitan',   'handler' => 'Kasun B.',  'stage' => 'registered'],
                    ['name' => 'Dinusha Jayasena',      'id' => 'CON-0086', 'country' => 'New Zealand', 'institution' => 'TBC',                    'handler' => 'Nimal J.',  'stage' => 'documents_pending'],
                ];
                @endphp
                @foreach($students as $s)
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-violet">{{ substr($s['name'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('consultancy.students.show', 1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s['name'] }}</a>
                                <p class="text-xs text-slate-400">{{ $s['id'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-slate-600">{{ $s['country'] }}</td>
                    <td class="text-sm text-slate-600">{{ $s['institution'] }}</td>
                    <td class="text-sm text-slate-600">{{ $s['handler'] }}</td>
                    <td><x-status-badge :status="$s['stage']" /></td>
                    <td>
                        <a href="{{ route('consultancy.students.show', 1) }}" class="btn btn-ghost btn-xs">
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
