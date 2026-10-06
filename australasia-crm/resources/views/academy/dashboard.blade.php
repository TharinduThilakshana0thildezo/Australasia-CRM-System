<x-layouts.app title="Academy Dashboard">

<x-page-header
    title="Academy"
    subtitle="Courses, batches, attendance, exams and certificates"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Academy']]">
    <x-slot:actions>
        <a href="{{ route('academy.enrollments.index') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            Enroll Student
        </a>
    </x-slot:actions>
</x-page-header>

<!-- KPIs -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="234" label="Enrolled Students"  icon="users"         color="cyan" />
    <x-stat-card value="12"  label="Active Courses"     icon="book-open"     color="indigo" />
    <x-stat-card value="8"   label="Active Batches"     icon="layers"        color="violet" />
    <x-stat-card value="189" label="Certificates Issued" icon="award"        color="emerald" />
</div>

<!-- Active Batches -->
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Active Batches</h3>
        <a href="{{ route('academy.batches.index') }}" class="text-sm text-indigo-600 font-semibold">View all →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Course</th>
                    <th>Trainer</th>
                    <th>Students</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                $batches = [
                    ['id' => 'Batch-26-10-A', 'course' => 'Pre-Departure Training — Warehouse', 'trainer' => 'Mr. Rupasinghe', 'students' => 24, 'start' => '01 Oct 2026', 'end' => '15 Oct 2026', 'status' => 'active'],
                    ['id' => 'Batch-26-10-B', 'course' => 'English Communication',               'trainer' => 'Ms. Jayasiri',   'students' => 18, 'start' => '05 Oct 2026', 'end' => '20 Oct 2026', 'status' => 'active'],
                    ['id' => 'Batch-26-09-C', 'course' => 'Computer Literacy',                   'trainer' => 'Mr. Dissanayake','students' => 30, 'start' => '15 Sep 2026', 'end' => '30 Sep 2026', 'status' => 'completed'],
                ];
                @endphp
                @foreach($batches as $b)
                <tr>
                    <td><code class="text-sm font-mono text-indigo-600">{{ $b['id'] }}</code></td>
                    <td class="text-sm font-semibold text-slate-800">{{ $b['course'] }}</td>
                    <td class="text-sm text-slate-600">{{ $b['trainer'] }}</td>
                    <td class="text-sm font-semibold text-slate-800">{{ $b['students'] }}</td>
                    <td class="text-sm text-slate-500">{{ $b['start'] }}</td>
                    <td class="text-sm text-slate-500">{{ $b['end'] }}</td>
                    <td><x-status-badge :status="$b['status']" /></td>
                    <td>
                        <a href="{{ route('academy.batches.index') }}" class="btn btn-ghost btn-xs">
                            <i data-lucide="eye" style="width:13px;height:13px"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Cross-link notice -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cross-Module Integration</h3>
        <span class="stream-badge stream-employment">Foreign Employment</span>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i data-lucide="link" style="width:18px;height:18px;flex-shrink:0"></i>
            <div>
                <p class="font-bold">Academy → Foreign Employment</p>
                <p class="text-sm mt-0.5">Academy completions are automatically linked back to Foreign Employment candidate profiles as pre-departure training certificates. Candidates who complete required courses return to the employment pipeline as READY.</p>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-3 gap-3 text-center">
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-2xl font-extrabold text-cyan-600">89</div>
                <div class="text-xs text-slate-500 mt-1 font-medium">Employment-linked<br>Enrollments</div>
            </div>
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-2xl font-extrabold text-emerald-600">71</div>
                <div class="text-xs text-slate-500 mt-1 font-medium">Certificates<br>Issued</div>
            </div>
            <div class="bg-slate-50 rounded-xl p-4">
                <div class="text-2xl font-extrabold text-indigo-600">71</div>
                <div class="text-xs text-slate-500 mt-1 font-medium">Returned to<br>Talent Pool</div>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
