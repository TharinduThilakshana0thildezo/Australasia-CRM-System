<x-layouts.app title="Documents — DMS">

<x-page-header
    title="Documents"
    subtitle="Centralised document management for all candidates and students"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Documents']]">
    <x-slot:actions>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="upload" style="width:14px;height:14px"></i>
            Upload Document
        </button>
    </x-slot:actions>
</x-page-header>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="1,847" label="Total Documents"    icon="folder"         color="indigo" />
    <x-stat-card value="34"    label="Pending Review"     icon="eye"            color="amber" />
    <x-stat-card value="12"    label="Correction Req."    icon="edit"           color="rose" />
    <x-stat-card value="98%"   label="Approved Rate"      icon="check-circle"   color="emerald" />
</div>

<!-- Filters -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search by person name, document type, NIC…">
            </div>
            <select class="form-select" style="width:auto">
                <option>All Modules</option>
                <option>Employment</option><option>Consultancy</option><option>Academy</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Document Types</option>
                <option>Passport</option><option>NIC</option><option>PCC</option>
                <option>Medical Certificate</option><option>Skills Certificate</option>
                <option>Employment Contract</option><option>Visa</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Statuses</option>
                <option>Uploaded</option><option>Pending Review</option>
                <option>Approved</option><option>Correction Required</option>
            </select>
        </div>
    </div>
</div>

<!-- Document Grid / Table Toggle -->
<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong class="text-slate-800">1–12</strong> of <strong class="text-slate-800">1,847</strong> documents</div>
        <div class="flex items-center gap-2">
            <button class="btn btn-ghost btn-xs active" title="Grid view">
                <i data-lucide="grid" style="width:14px;height:14px"></i>
            </button>
            <button class="btn btn-ghost btn-xs" title="List view">
                <i data-lucide="list" style="width:14px;height:14px"></i>
            </button>
        </div>
    </div>

    <!-- Document Cards Grid -->
    <div class="card-body">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
            @php
            $docs = [
                ['name' => 'Passport — Kavindu Perera',        'type' => 'Passport',           'person' => 'Kavindu Perera',      'module' => 'Employment',  'size' => '2.4 MB', 'date' => '03 Oct 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'Medical Certificate — Kavindu',    'type' => 'Medical Certificate', 'person' => 'Kavindu Perera',      'module' => 'Employment',  'size' => '1.8 MB', 'date' => '04 Oct 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'PCC — Chamari Dias',               'type' => 'Police Clearance',    'person' => 'Chamari Dias',        'module' => 'Employment',  'size' => '0.9 MB', 'date' => '05 Oct 2026', 'status' => 'review',           'ext' => 'PDF'],
                ['name' => 'Passport — Sachini Ranasinghe',    'type' => 'Passport',            'person' => 'Sachini Ranasinghe',  'module' => 'Consultancy', 'size' => '1.1 MB', 'date' => '01 Oct 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'Skills Certificate — Ajith N.',    'type' => 'Skills Certificate',  'person' => 'Ajith Nanayakkara',   'module' => 'Employment',  'size' => '3.2 MB', 'date' => '30 Sep 2026', 'status' => 'correction_req',   'ext' => 'JPG'],
                ['name' => 'Enrollment Confirmation — Kavinda','type' => 'Enrollment Letter',   'person' => 'Kavinda Gunasekara',  'module' => 'Consultancy', 'size' => '0.5 MB', 'date' => '28 Sep 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'Employment Contract — Chamari',    'type' => 'Employment Contract', 'person' => 'Chamari Dias',        'module' => 'Employment',  'size' => '2.1 MB', 'date' => '05 Oct 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'Visa 482 — Kavindu Perera',        'type' => 'Visa',                'person' => 'Kavindu Perera',      'module' => 'Employment',  'size' => '1.3 MB', 'date' => '06 Oct 2026', 'status' => 'approved',         'ext' => 'PDF'],
                ['name' => 'IELTS Score — Sachini',            'type' => 'Language Test',       'person' => 'Sachini Ranasinghe',  'module' => 'Consultancy', 'size' => '0.8 MB', 'date' => '02 Oct 2026', 'status' => 'review',           'ext' => 'PDF'],
            ];
            $docColors = ['Passport' => '#6366f1', 'Medical Certificate' => '#10b981', 'Police Clearance' => '#f59e0b', 'Skills Certificate' => '#8b5cf6', 'Employment Contract' => '#3b82f6', 'Enrollment Letter' => '#14b8a6', 'Visa' => '#a855f7', 'Language Test' => '#06b6d4'];
            $statusDot = ['approved' => 'badge-approved', 'review' => 'badge-review', 'correction_req' => 'badge-correction-req', 'pending' => 'badge-pending'];
            $statusLabel = ['approved' => 'Approved', 'review' => 'Pending Review', 'correction_req' => 'Correction Req.', 'pending' => 'Pending'];
            @endphp

            @foreach($docs as $doc)
            <div class="doc-card">
                <!-- Icon -->
                <div class="doc-icon" style="background: {{ $docColors[$doc['type']] ?? '#6366f1' }}18">
                    @if($doc['ext'] === 'PDF')
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="{{ $docColors[$doc['type']] ?? '#6366f1' }}" opacity="0.9">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM8 17v-1h8v1H8zm0-3v-1h8v1H8zm0-3v-1h4v1H8z"/>
                    </svg>
                    @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="{{ $docColors[$doc['type']] ?? '#6366f1' }}" opacity="0.9">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                    </svg>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $doc['name'] }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $doc['type'] }} · {{ $doc['size'] }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-2">
                            <span class="badge {{ $statusDot[$doc['status']] ?? 'badge-draft' }} badge-dot text-xs">
                                {{ $statusLabel[$doc['status']] ?? $doc['status'] }}
                            </span>
                            <span class="text-xs text-slate-400">{{ $doc['date'] }}</span>
                        </div>
                        <div class="flex gap-1">
                            <button class="btn btn-ghost btn-xs" title="Download">
                                <i data-lucide="download" style="width:11px;height:11px"></i>
                            </button>
                            <button class="btn btn-ghost btn-xs" title="Preview">
                                <i data-lucide="eye" style="width:11px;height:11px"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–9 of 1,847 documents</div>
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
