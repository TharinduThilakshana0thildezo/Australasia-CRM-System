<x-layouts.app title="Checklist — CKL-0031 — Kavindu Perera">

<x-page-header
    title="Checklist — CKL-0031"
    subtitle="Post-selection pre-departure checklist for Kavindu Perera"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.checklists.index'), 'label' => 'Checklists'], ['url' => '#', 'label' => 'CKL-0031']]">
    <x-slot:actions>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="check-circle" style="width:14px;height:14px"></i>
            Mark All Complete
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Summary -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
    <div class="card lg:col-span-2">
        <div class="card-header">
            <div>
                <h3 class="card-title">Kavindu Perera — Checklist Progress</h3>
                <p class="text-xs text-slate-500 mt-0.5">APP-0842 · Global Workforce Solutions · Warehouse Operator · Australia</p>
            </div>
            <x-status-badge status="completed" />
        </div>
        <div class="card-body">
            <!-- Overall progress -->
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-semibold text-emerald-700">All 12 items completed</span>
                <span class="text-2xl font-extrabold text-emerald-600">100%</span>
            </div>
            <div class="progress-bar-track mb-6">
                <div class="progress-bar-fill bg-emerald-500" style="width:100%"></div>
            </div>

            <!-- Checklist items -->
            @php
            $items = [
                ['item' => 'Valid Passport (6+ months remaining)', 'done' => true, 'verified_by' => 'Priya H.', 'date' => '03 Oct 2026'],
                ['item' => 'Medical Examination Clearance', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '04 Oct 2026'],
                ['item' => 'Police Clearance Certificate (PCC)', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '04 Oct 2026'],
                ['item' => 'Skills Assessment Certificate', 'done' => true, 'verified_by' => 'Priya H.', 'date' => '03 Oct 2026'],
                ['item' => 'Educational Certificates (notarized)', 'done' => true, 'verified_by' => 'Priya H.', 'date' => '03 Oct 2026'],
                ['item' => 'Experience Letters', 'done' => true, 'verified_by' => 'Kasun B.', 'date' => '02 Oct 2026'],
                ['item' => 'Employment Contract (employer-signed copy)', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '05 Oct 2026'],
                ['item' => 'Visa (Subclass 482 — approved)', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '06 Oct 2026'],
                ['item' => 'Employer Appointment Letter', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '05 Oct 2026'],
                ['item' => 'Health Insurance (OVHC policy)', 'done' => true, 'verified_by' => 'Kasun B.', 'date' => '05 Oct 2026'],
                ['item' => 'Pre-departure Briefing Attendance', 'done' => true, 'verified_by' => 'Kasun B.', 'date' => '06 Oct 2026'],
                ['item' => 'Flight Booking Confirmed', 'done' => true, 'verified_by' => 'Nimal J.', 'date' => '06 Oct 2026'],
            ];
            @endphp
            <div class="space-y-2">
                @foreach($items as $i => $item)
                <div class="flex items-center gap-3 p-3 rounded-xl
                    {{ $item['done'] ? 'bg-emerald-50 border border-emerald-100' : 'bg-slate-50 border border-slate-200' }}">
                    <div class="{{ $item['done'] ? 'text-emerald-500' : 'text-slate-300' }} flex-shrink-0">
                        @if($item['done'])
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#d1fae5"/><polyline points="20 6 9 17 4 12" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @else
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium {{ $item['done'] ? 'text-slate-700' : 'text-slate-500' }}">
                            {{ $i + 1 }}. {{ $item['item'] }}
                        </p>
                        @if($item['done'])
                        <p class="text-xs text-emerald-600 mt-0.5">
                            ✓ Verified by {{ $item['verified_by'] }} on {{ $item['date'] }}
                        </p>
                        @endif
                    </div>
                    @if($item['done'])
                    <button class="btn btn-ghost btn-xs flex-shrink-0">
                        <i data-lucide="eye" style="width:11px;height:11px"></i>
                    </button>
                    @else
                    <button class="btn btn-success btn-xs flex-shrink-0">Mark Done</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Side panel -->
    <div class="flex flex-col gap-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Case Summary</h3></div>
            <div class="card-body space-y-3 text-sm">
                @php
                $summary = [
                    ['label' => 'Candidate', 'value' => 'Kavindu Perera'],
                    ['label' => 'Vacancy', 'value' => 'Warehouse Operator'],
                    ['label' => 'Employer', 'value' => 'Global Workforce Solutions'],
                    ['label' => 'Country', 'value' => 'Australia'],
                    ['label' => 'Application', 'value' => 'APP-0842'],
                    ['label' => 'Checklist Due', 'value' => '12 Oct 2026'],
                    ['label' => 'Handler', 'value' => 'Nimal Jayawardena'],
                ];
                @endphp
                @foreach($summary as $s)
                <div class="flex gap-3">
                    <span class="text-xs font-semibold text-slate-400 w-28 flex-shrink-0 pt-0.5">{{ $s['label'] }}</span>
                    <span class="text-sm font-semibold text-slate-800">{{ $s['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Next Step</h3></div>
            <div class="card-body">
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center mb-4">
                    <svg class="mx-auto text-emerald-600 mb-2" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 2L11 13M22 2L15 22 11 13 2 9l20-7z"></path>
                    </svg>
                    <p class="font-bold text-emerald-800 text-sm">Checklist Complete</p>
                    <p class="text-xs text-emerald-600 mt-1">Ready to process visa and deployment</p>
                </div>
                <a href="{{ route('employment.visas.index') }}" class="btn btn-primary w-full justify-center">
                    <i data-lucide="shield-check" style="width:14px;height:14px"></i>
                    Proceed to Visa
                </a>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
