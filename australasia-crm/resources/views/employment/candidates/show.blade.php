<x-layouts.app title="Kavindu Perera — Candidate Profile">

<x-page-header
    title="Kavindu Perera"
    subtitle="CAND-1297 · Foreign Employment Candidate"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.candidates.index'), 'label' => 'Candidates'], ['url' => '#', 'label' => 'Kavindu Perera']]">
    <x-slot:actions>
        <button class="btn btn-ghost btn-sm">
            <i data-lucide="pencil" style="width:14px;height:14px"></i>
            Edit
        </button>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="file-plus" style="width:14px;height:14px"></i>
            Add Document
        </button>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="btn btn-primary btn-sm">
                Actions
                <i data-lucide="chevron-down" style="width:14px;height:14px"></i>
            </button>
            <div x-show="open" @click.outside="open = false" x-transition
                 class="absolute right-0 top-10 w-52 bg-white rounded-xl shadow-xl border border-slate-100 z-50 py-1"
                 style="display:none">
                <a href="{{ route('employment.matching') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                    <i data-lucide="target" style="width:14px;height:14px"></i> Match Vacancy
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                    <i data-lucide="link" style="width:14px;height:14px"></i> Reg. Link
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                    <i data-lucide="message-square" style="width:14px;height:14px"></i> Add Note
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">
                    <i data-lucide="check-square" style="width:14px;height:14px"></i> Add Task
                </a>
                <div class="border-t border-slate-100 my-1"></div>
                <a href="{{ route('employment.refunds.create') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50">
                    <i data-lucide="rotate-ccw" style="width:14px;height:14px"></i> Start Refund
                </a>
            </div>
        </div>
    </x-slot:actions>
</x-page-header>

<!-- ========== PROFILE HEADER CARD ========== -->
<div class="card mb-5">
    <div class="card-body">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Avatar & identity -->
            <div class="flex items-start gap-4 flex-shrink-0">
                <div class="avatar avatar-xl avatar-indigo text-2xl">KP</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Kavindu Perera</h2>
                    <p class="text-sm text-slate-500 font-mono mt-0.5">CAND-1297</p>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <x-status-badge status="visa_approved" />
                        <span class="stream-badge stream-employment">
                            <i data-lucide="briefcase" style="width:10px;height:10px"></i> Foreign Employment
                        </span>
                        <span class="stream-badge stream-academy">
                            <i data-lucide="book-open" style="width:10px;height:10px"></i> Academy
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <!-- Quick info grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-xs text-slate-400 font-medium">NIC</p>
                        <p class="text-sm font-semibold text-slate-800 font-mono mt-0.5">198912034578</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Passport</p>
                        <p class="text-sm font-semibold text-slate-800 font-mono mt-0.5">N98765432</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Phone</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">071 456 7890</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">WhatsApp</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">071 456 7890</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Handler</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <div class="avatar avatar-sm avatar-violet">NJ</div>
                            <span class="text-sm font-semibold text-slate-800">Nimal Jayawardena</span>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Source</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">Referral</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Registered</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">15 Sep 2026</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 font-medium">Last Activity</p>
                        <p class="text-sm font-semibold text-slate-800 mt-0.5">06 Oct 2026</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ========== JOURNEY PROGRESS STEPPER ========== -->
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Employment Journey</h3>
        <span class="text-xs text-slate-500">Current stage: <strong class="text-emerald-600">Visa Approved → Deployment</strong></span>
    </div>
    <div class="card-body pt-2">
        <div class="stepper overflow-x-auto">
            @php
            $steps = [
                ['label' => 'Lead', 'done' => true],
                ['label' => 'Registered', 'done' => true],
                ['label' => 'Documents', 'done' => true],
                ['label' => 'Ready', 'done' => true],
                ['label' => 'Talent Pool', 'done' => true],
                ['label' => 'Selected', 'done' => true],
                ['label' => 'Checklist', 'done' => true],
                ['label' => 'Visa', 'done' => true],
                ['label' => 'Deployment', 'done' => false, 'current' => true],
                ['label' => 'Deployed', 'done' => false],
            ];
            @endphp

            @foreach($steps as $i => $step)
            <div class="stepper-step {{ $step['done'] ? 'completed' : '' }} {{ isset($step['current']) && $step['current'] ? 'current' : '' }}">
                <div class="stepper-step-inner">
                    <div class="stepper-circle">
                        @if($step['done'])
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        @else
                            {{ $i + 1 }}
                        @endif
                    </div>
                    <div class="stepper-label">{{ $step['label'] }}</div>
                </div>
            </div>
            @if(!$loop->last)
            <div class="stepper-line {{ $step['done'] ? 'completed' : '' }}"></div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<!-- ========== PROFILE TABS ========== -->
<div class="mb-1" x-data="{ tab: 'overview' }">
    <div class="tabs-nav mb-5">
        <button @click="tab = 'overview'" :class="tab === 'overview' ? 'active' : ''" class="tab-item">
            Overview
        </button>
        <button @click="tab = 'documents'" :class="tab === 'documents' ? 'active' : ''" class="tab-item">
            Documents <span class="tab-count">5</span>
        </button>
        <button @click="tab = 'employment'" :class="tab === 'employment' ? 'active' : ''" class="tab-item">
            Employment Case
        </button>
        <button @click="tab = 'applications'" :class="tab === 'applications' ? 'active' : ''" class="tab-item">
            Applications <span class="tab-count">1</span>
        </button>
        <button @click="tab = 'visa'" :class="tab === 'visa' ? 'active' : ''" class="tab-item">
            Visa
        </button>
        <button @click="tab = 'deployment'" :class="tab === 'deployment' ? 'active' : ''" class="tab-item">
            Deployment
        </button>
        <button @click="tab = 'payments'" :class="tab === 'payments' ? 'active' : ''" class="tab-item">
            Payments <span class="tab-count">2</span>
        </button>
        <button @click="tab = 'tasks'" :class="tab === 'tasks' ? 'active' : ''" class="tab-item">
            Tasks <span class="tab-count">3</span>
        </button>
        <button @click="tab = 'activity'" :class="tab === 'activity' ? 'active' : ''" class="tab-item">
            Activity
        </button>
    </div>

    <!-- ===== TAB: OVERVIEW ===== -->
    <div x-show="tab === 'overview'">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- Personal Information -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Personal Information</h3>
                    <button class="btn btn-ghost btn-xs"><i data-lucide="pencil" style="width:12px;height:12px"></i></button>
                </div>
                <div class="card-body space-y-3">
                    @php
                    $personal = [
                        ['label' => 'Full Name', 'value' => 'Kavindu Lakmal Perera'],
                        ['label' => 'Date of Birth', 'value' => '12 Mar 1989 (37 years)'],
                        ['label' => 'Gender', 'value' => 'Male'],
                        ['label' => 'Email', 'value' => 'kavindu.perera@gmail.com'],
                        ['label' => 'Address', 'value' => 'No. 23, Malabe Road, Kaduwela'],
                        ['label' => 'City', 'value' => 'Kaduwela'],
                        ['label' => 'District', 'value' => 'Colombo'],
                    ];
                    @endphp
                    @foreach($personal as $item)
                    <div class="flex gap-3">
                        <span class="text-xs font-semibold text-slate-400 w-28 flex-shrink-0 pt-0.5">{{ $item['label'] }}</span>
                        <span class="text-sm text-slate-700">{{ $item['value'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Employment Profile -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employment Profile</h3>
                    <button class="btn btn-ghost btn-xs"><i data-lucide="pencil" style="width:12px;height:12px"></i></button>
                </div>
                <div class="card-body space-y-3">
                    @php
                    $empProfile = [
                        ['label' => 'Current Occupation', 'value' => 'Machine Operator'],
                        ['label' => 'Desired Role', 'value' => 'Warehouse Operator'],
                        ['label' => 'Experience', 'value' => '6 years'],
                        ['label' => 'Languages', 'value' => 'Sinhala, English (Basic)'],
                        ['label' => 'Skills', 'value' => 'Forklift, Packing, Quality Control'],
                        ['label' => 'Preferred Countries', 'value' => 'Australia, Qatar'],
                    ];
                    @endphp
                    @foreach($empProfile as $item)
                    <div class="flex gap-3">
                        <span class="text-xs font-semibold text-slate-400 w-28 flex-shrink-0 pt-0.5">{{ $item['label'] }}</span>
                        <span class="text-sm text-slate-700">{{ $item['value'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Registration Fee + Pre-departure -->
            <div class="flex flex-col gap-5">
                <!-- Registration Fee -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registration Fee</h3>
                        <x-status-badge status="paid" />
                    </div>
                    <div class="card-body space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Amount</span>
                            <span class="font-bold text-slate-800">LKR 15,000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Paid on</span>
                            <span class="font-semibold text-slate-700">16 Sep 2026</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Method</span>
                            <span class="font-semibold text-slate-700">Bank Transfer</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Receipt #</span>
                            <span class="font-mono text-slate-700">RCP-000428</span>
                        </div>
                        <div class="mt-3 p-2 bg-emerald-50 rounded-lg text-xs text-emerald-700 font-medium">
                            ✓ Refundable under Foreign Employment refund policy
                        </div>
                    </div>
                </div>

                <!-- Pre-departure Academy -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pre-Departure Training</h3>
                        <span class="stream-badge stream-academy">Academy</span>
                    </div>
                    <div class="card-body space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Course</span>
                            <span class="font-semibold">PDT-Warehouse Operations</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Batch</span>
                            <span class="font-semibold">Batch-24-09</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Result</span>
                            <span class="badge badge-approved">Certificate Issued</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Certificate</span>
                            <a href="{{ route('academy.certificates.index') }}" class="text-indigo-600 font-semibold text-xs">View →</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ===== TAB: DOCUMENTS ===== -->
    <div x-show="tab === 'documents'" style="display:none">
        <div class="card mb-5">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Documents</h3>
                    <p class="text-xs text-slate-500 mt-0.5">5 of 5 documents reviewed and approved</p>
                </div>
                <button class="btn btn-primary btn-sm">
                    <i data-lucide="upload" style="width:14px;height:14px"></i>
                    Upload Document
                </button>
            </div>
            <div class="card-body">
                <!-- Overall readiness -->
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 flex items-center gap-3">
                    <svg class="text-emerald-600 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"></circle><polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <div>
                        <p class="font-bold text-emerald-800">All documents approved</p>
                        <p class="text-sm text-emerald-600">This candidate is cleared for the talent pool.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                    $documents = [
                        ['type' => 'NIC', 'file' => 'nic_kavindu_front.jpg', 'status' => 'approved', 'uploaded' => '16 Sep 2026', 'reviewed_by' => 'Priya Hewage', 'color' => 'bg-blue-100 text-blue-600'],
                        ['type' => 'Passport', 'file' => 'passport_kavindu.pdf', 'status' => 'approved', 'uploaded' => '16 Sep 2026', 'reviewed_by' => 'Priya Hewage', 'color' => 'bg-indigo-100 text-indigo-600'],
                        ['type' => 'CV / Resume', 'file' => 'cv_kavindu_perera.pdf', 'status' => 'approved', 'uploaded' => '17 Sep 2026', 'reviewed_by' => 'Priya Hewage', 'color' => 'bg-violet-100 text-violet-600'],
                        ['type' => 'Educational Certificates', 'file' => 'edu_al_kavindu.pdf + 2 files', 'status' => 'approved', 'uploaded' => '17 Sep 2026', 'reviewed_by' => 'Priya Hewage', 'color' => 'bg-emerald-100 text-emerald-600'],
                        ['type' => 'Experience Letter', 'file' => 'exp_letter_2024.pdf', 'status' => 'approved', 'uploaded' => '18 Sep 2026', 'reviewed_by' => 'Nimal J.', 'color' => 'bg-teal-100 text-teal-600'],
                    ];
                    @endphp

                    @foreach($documents as $doc)
                    <div class="doc-card">
                        <div class="doc-icon {{ $doc['color'] }}">
                            <i data-lucide="file-text" style="width:20px;height:20px"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-semibold text-slate-800">{{ $doc['type'] }}</p>
                                <x-status-badge :status="$doc['status']" />
                            </div>
                            <p class="text-xs text-slate-500 mt-1 truncate">{{ $doc['file'] }}</p>
                            <div class="flex gap-3 text-xs text-slate-400 mt-1.5">
                                <span>Uploaded {{ $doc['uploaded'] }}</span>
                                <span>Reviewed by {{ $doc['reviewed_by'] }}</span>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <button class="btn btn-outline btn-xs">
                                    <i data-lucide="eye" style="width:11px;height:11px"></i> View
                                </button>
                                <button class="btn btn-ghost btn-xs">
                                    <i data-lucide="download" style="width:11px;height:11px"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TAB: EMPLOYMENT CASE ===== -->
    <div x-show="tab === 'employment'" style="display:none">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Current Application</h3></div>
                <div class="card-body space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Application ID</span>
                        <a href="{{ route('employment.applications.show', 1) }}" class="font-semibold text-indigo-600">APP-0842</a>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Employer</span>
                        <a href="{{ route('employment.employers.show', 1) }}" class="font-semibold text-slate-800">Global Workforce Solutions Pty Ltd</a>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Vacancy</span>
                        <span class="font-semibold text-slate-800">Warehouse Operator — Australia</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Submitted</span>
                        <span class="font-semibold text-slate-800">02 Oct 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Employer Decision</span>
                        <span class="badge badge-approved">Selected</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3 class="card-title">Candidate Readiness</h3></div>
                <div class="card-body">
                    @php
                    $readiness = [
                        ['item' => 'Identity Verified (NIC)', 'done' => true],
                        ['item' => 'CV Uploaded & Approved', 'done' => true],
                        ['item' => 'Passport Uploaded & Valid', 'done' => true],
                        ['item' => 'Education Documents Approved', 'done' => true],
                        ['item' => 'Experience Documents Approved', 'done' => true],
                        ['item' => 'Registration Fee Paid', 'done' => true],
                        ['item' => 'Pre-departure Training Completed', 'done' => true],
                    ];
                    @endphp
                    <div class="space-y-2">
                        @foreach($readiness as $item)
                        <div class="flex items-center gap-3 text-sm">
                            <div class="{{ $item['done'] ? 'text-emerald-500' : 'text-slate-300' }}">
                                @if($item['done'])
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" fill="#d1fae5"/><polyline points="20 6 9 17 4 12" stroke="#059669"></polyline></svg>
                                @else
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>
                                @endif
                            </div>
                            <span class="{{ $item['done'] ? 'text-slate-700' : 'text-slate-400' }}">{{ $item['item'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-semibold text-emerald-700">Candidate is READY</span>
                            <span class="font-bold text-emerald-700">7/7</span>
                        </div>
                        <div class="progress-bar-track">
                            <div class="progress-bar-fill bg-emerald-500" style="width:100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TAB: VISA ===== -->
    <div x-show="tab === 'visa'" style="display:none">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Visa Application — VSA-00284</h3>
                <x-status-badge status="visa_approved" />
            </div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-sm">
                    <div><p class="text-xs text-slate-400 font-medium">Visa Type</p><p class="font-semibold mt-0.5">Subclass 482 — Work</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Country</p><p class="font-semibold mt-0.5">Australia</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Submitted</p><p class="font-semibold mt-0.5">05 Oct 2026</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Approved</p><p class="font-semibold text-emerald-600 mt-0.5">06 Oct 2026</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Reference No.</p><p class="font-mono font-semibold mt-0.5">AU-482-2026-00847</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Assigned Staff</p><p class="font-semibold mt-0.5">Nimal Jayawardena</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Allowed Timeframe</p><p class="font-semibold mt-0.5">60 days</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Processing Time</p><p class="font-semibold text-emerald-600 mt-0.5">1 day ✓</p></div>
                </div>

                <!-- Visa timeline -->
                <h4 class="text-sm font-bold text-slate-700 mb-3">Visa Processing Timeline</h4>
                <div class="timeline">
                    @php
                    $visaSteps = [
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Visa Approved', 'time' => '06 Oct 2026 · 10:14 AM', 'detail' => 'Australia Subclass 482 Work Visa approved. Reference: AU-482-2026-00847'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Visa Submitted to Department of Home Affairs', 'time' => '05 Oct 2026 · 03:30 PM', 'detail' => 'All documents compiled and submitted online via ImmiAccount'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Visa Documents Prepared', 'time' => '04 Oct 2026', 'detail' => 'Employer sponsorship documents, Skills Assessment, Medical clearance compiled'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Application Checklist Completed', 'time' => '03 Oct 2026', 'detail' => 'All checklist items verified — ready for visa preparation'],
                    ];
                    @endphp
                    @foreach($visaSteps as $step)
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot-{{ $step['dot'] }}">{{ $step['icon'] }}</div>
                        <div class="timeline-content">
                            <div class="timeline-title">{{ $step['title'] }}</div>
                            <div class="timeline-meta">{{ $step['time'] }}</div>
                            <div class="timeline-body">{{ $step['detail'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TAB: ACTIVITY ===== -->
    <div x-show="tab === 'activity'" style="display:none">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Activity Timeline</h3>
                <span class="text-xs text-slate-500">All actions recorded</span>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @php
                    $activities = [
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Visa Approved — Australia Subclass 482', 'time' => '06 Oct 2026, 10:14 AM', 'by' => 'System', 'detail' => 'Visa reference: AU-482-2026-00847'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Visa submitted to Department of Home Affairs', 'time' => '05 Oct 2026, 3:30 PM', 'by' => 'Nimal Jayawardena', 'detail' => 'Documents submitted via ImmiAccount online portal'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Checklist completed and verified', 'time' => '03 Oct 2026', 'by' => 'Kasun Bandara', 'detail' => 'All 12 checklist items cleared'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Employer selected candidate', 'time' => '01 Oct 2026', 'by' => 'Consultant', 'detail' => 'Global Workforce Solutions Pty Ltd — Warehouse Operator position'],
                        ['dot' => 'info', 'icon' => '+', 'title' => 'Submitted to employer for review', 'time' => '28 Sep 2026', 'by' => 'Nimal Jayawardena', 'detail' => 'Profile and CV shared with Global Workforce Solutions'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'All documents approved — candidate marked READY', 'time' => '20 Sep 2026', 'by' => 'Priya Hewage', 'detail' => '5/5 documents reviewed and approved. Added to active talent pool.'],
                        ['dot' => 'warning', 'icon' => '⚠', 'title' => 'Passport correction requested', 'time' => '18 Sep 2026', 'by' => 'Priya Hewage', 'detail' => 'Passport scan clarity insufficient — re-upload requested'],
                        ['dot' => 'success', 'icon' => '✓', 'title' => 'Registration fee received', 'time' => '16 Sep 2026', 'by' => 'Finance', 'detail' => 'LKR 15,000 — Bank transfer — Receipt RCP-000428'],
                        ['dot' => 'info', 'icon' => '+', 'title' => 'Candidate registered', 'time' => '15 Sep 2026', 'by' => 'Nimal Jayawardena', 'detail' => 'Walk-in registration via consultant. Source: Referral — Chamara Perera'],
                    ];
                    @endphp
                    @foreach($activities as $act)
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot-{{ $act['dot'] }}">{{ $act['icon'] }}</div>
                        <div class="timeline-content">
                            <div class="timeline-title">{{ $act['title'] }}</div>
                            <div class="timeline-meta">{{ $act['time'] }} · by {{ $act['by'] }}</div>
                            <div class="timeline-body">{{ $act['detail'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Remaining tabs (applications, deployment, payments, tasks) placeholder -->
    <div x-show="tab === 'applications'" style="display:none">
        @include('employment.candidates._tabs.applications')
    </div>
    <div x-show="tab === 'deployment'" style="display:none">
        @include('employment.candidates._tabs.deployment')
    </div>
    <div x-show="tab === 'payments'" style="display:none">
        @include('employment.candidates._tabs.payments')
    </div>
    <div x-show="tab === 'tasks'" style="display:none">
        @include('employment.candidates._tabs.tasks')
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>

</x-layouts.app>
