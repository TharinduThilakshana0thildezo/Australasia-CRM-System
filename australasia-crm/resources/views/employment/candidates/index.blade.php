<x-layouts.app title="Candidates — Foreign Employment">

<x-page-header
    title="Candidates"
    subtitle="All registered candidates in the Foreign Employment pipeline"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Candidates']]">
    <x-slot:actions>
        <button class="btn btn-secondary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i>
            Export
        </button>
        <a href="{{ route('employment.candidates.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>
            Register Candidate
        </a>
    </x-slot:actions>
</x-page-header>

<!-- ========== FILTER BAR ========== -->
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <!-- Search -->
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="search-input" placeholder="Search name, NIC, phone, candidate ID…">
            </div>

            <!-- Status filter -->
            <select class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option>Lead</option>
                <option>Registered</option>
                <option>Documents Pending</option>
                <option>Under Screening</option>
                <option>Correction Required</option>
                <option>Ready</option>
                <option>Talent Pool</option>
                <option>Employer Review</option>
                <option>Selected</option>
                <option>Visa Processing</option>
                <option>Deployed</option>
                <option>Refund</option>
                <option>Closed</option>
            </select>

            <!-- Handler filter -->
            <select class="form-select" style="width:auto">
                <option value="">All Handlers</option>
                <option>Kasun Bandara</option>
                <option>Nimal Jayawardena</option>
                <option>Priya Hewage</option>
                <option>Amila Perera</option>
            </select>

            <!-- Source filter -->
            <select class="form-select" style="width:auto">
                <option value="">All Sources</option>
                <option>Walk-in</option>
                <option>Referral</option>
                <option>Agent</option>
                <option>Online Enquiry</option>
                <option>Employer Contact</option>
            </select>

            <button class="btn btn-ghost btn-sm">
                <i data-lucide="x" style="width:14px;height:14px"></i>
                Clear filters
            </button>
        </div>

        <!-- Status quick-filter pills -->
        <div class="filter-bar mt-3">
            <span class="text-xs text-slate-500 font-medium mr-1">Quick:</span>
            <button class="filter-pill active">All (1,284)</button>
            <button class="filter-pill">Docs Pending (98)</button>
            <button class="filter-pill">Correction (11)</button>
            <button class="filter-pill">Ready (318)</button>
            <button class="filter-pill">Visa (67)</button>
            <button class="filter-pill">Refund (14)</button>
        </div>
    </div>
</div>

<!-- ========== CANDIDATE TABLE ========== -->
<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong class="text-slate-800">1–20</strong> of <strong class="text-slate-800">1,284</strong> candidates</div>
        <div class="flex gap-2">
            <button class="btn btn-ghost btn-xs" title="Table view">
                <i data-lucide="list" style="width:14px;height:14px"></i>
            </button>
            <button class="btn btn-ghost btn-xs" title="Grid view">
                <i data-lucide="grid-3x3" style="width:14px;height:14px"></i>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th><input type="checkbox" class="form-input" style="width:16px;height:16px;padding:0"></th>
                    <th>Candidate</th>
                    <th>NIC / Passport</th>
                    <th>Contact</th>
                    <th>Active Streams</th>
                    <th>Handler</th>
                    <th>Status</th>
                    <th>Documents</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $candidates = [
                    ['id' => 'CAND-1298', 'name' => 'Thilini Madushan', 'nic' => '199508204567', 'passport' => 'N12345678', 'phone' => '077 234 5678', 'streams' => ['employment'], 'handler' => 'Kasun B.', 'status' => 'registered', 'docs' => '1/5', 'registered' => '06 Oct 2026', 'source' => 'Walk-in'],
                    ['id' => 'CAND-1297', 'name' => 'Kavindu Perera', 'nic' => '198912034578', 'passport' => 'N98765432', 'phone' => '071 456 7890', 'streams' => ['employment', 'academy'], 'handler' => 'Nimal J.', 'status' => 'visa_approved', 'docs' => '5/5', 'registered' => '15 Sep 2026', 'source' => 'Referral'],
                    ['id' => 'CAND-1296', 'name' => 'Nadeeka Silva', 'nic' => '200103214321', 'passport' => 'N45678901', 'phone' => '076 987 6543', 'streams' => ['employment'], 'handler' => 'Priya H.', 'status' => 'correction_required', 'docs' => '3/5', 'registered' => '02 Sep 2026', 'source' => 'Agent'],
                    ['id' => 'CAND-1295', 'name' => 'Sachini Rathnayake', 'nic' => '199607120987', 'passport' => 'N23456789', 'phone' => '070 123 4567', 'streams' => ['employment'], 'handler' => 'Kasun B.', 'status' => 'deployed', 'docs' => '5/5', 'registered' => '12 Aug 2026', 'source' => 'Walk-in'],
                    ['id' => 'CAND-1294', 'name' => 'Amara Kumari Dissanayake', 'nic' => '199801234567', 'passport' => '', 'phone' => '077 876 5432', 'streams' => ['employment', 'consultancy'], 'handler' => 'Amila P.', 'status' => 'documents_pending', 'docs' => '2/5', 'registered' => '28 Aug 2026', 'source' => 'Online Enquiry'],
                    ['id' => 'CAND-1293', 'name' => 'Ruwan Pathirana', 'nic' => '199203145678', 'passport' => 'N56789012', 'phone' => '071 234 5670', 'streams' => ['employment'], 'handler' => 'Nimal J.', 'status' => 'refund', 'docs' => '5/5', 'registered' => '05 Jul 2026', 'source' => 'Referral'],
                    ['id' => 'CAND-1292', 'name' => 'Chamari Dias', 'nic' => '199905678901', 'passport' => 'N67890123', 'phone' => '078 345 6789', 'streams' => ['employment', 'academy'], 'handler' => 'Priya H.', 'status' => 'checklist', 'docs' => '5/5', 'registered' => '20 Jul 2026', 'source' => 'Walk-in'],
                    ['id' => 'CAND-1291', 'name' => 'Roshan Wijesinghe', 'nic' => '200201034567', 'passport' => '', 'phone' => '077 456 7891', 'streams' => ['employment'], 'handler' => 'Kasun B.', 'status' => 'lead', 'docs' => '0/5', 'registered' => '06 Oct 2026', 'source' => 'Walk-in'],
                    ['id' => 'CAND-1290', 'name' => 'Pradeep Fernando', 'nic' => '199407125678', 'passport' => 'N78901234', 'phone' => '071 567 8901', 'streams' => ['employment'], 'handler' => 'Amila P.', 'status' => 'talent_pool', 'docs' => '5/5', 'registered' => '10 Aug 2026', 'source' => 'Agent'],
                    ['id' => 'CAND-1289', 'name' => 'Indika Chandrasena', 'nic' => '199109087654', 'passport' => 'N89012345', 'phone' => '070 678 9012', 'streams' => ['employment', 'consultancy', 'academy'], 'handler' => 'Nimal J.', 'status' => 'visa_processing', 'docs' => '5/5', 'registered' => '15 Jun 2026', 'source' => 'Referral'],
                ];
                @endphp

                @foreach($candidates as $candidate)
                <tr>
                    <td><input type="checkbox" class="form-input" style="width:16px;height:16px;padding:0"></td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar avatar-sm avatar-{{ ['indigo','emerald','violet','amber','cyan','rose'][array_sum(array_map('ord', str_split(substr($candidate['id'], -1)))) % 6] }}">
                                {{ strtoupper(substr($candidate['name'], 0, 1) . substr(strstr($candidate['name'], ' '), 1, 1)) }}
                            </div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}"
                                   class="text-sm font-semibold text-slate-800 hover:text-indigo-600 transition-colors">
                                    {{ $candidate['name'] }}
                                </a>
                                <p class="text-xs text-slate-400">{{ $candidate['id'] }} · {{ $candidate['source'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-mono text-slate-600">{{ $candidate['nic'] }}</div>
                        @if($candidate['passport'])
                        <div class="text-xs text-slate-400">{{ $candidate['passport'] }}</div>
                        @else
                        <div class="text-xs text-amber-500">No passport</div>
                        @endif
                    </td>
                    <td class="text-sm text-slate-600">{{ $candidate['phone'] }}</td>
                    <td>
                        <div class="flex flex-wrap gap-1">
                            @foreach($candidate['streams'] as $stream)
                                @if($stream === 'employment')
                                    <span class="stream-badge stream-employment">
                                        <i data-lucide="briefcase" style="width:10px;height:10px"></i> Emp
                                    </span>
                                @elseif($stream === 'consultancy')
                                    <span class="stream-badge stream-consultancy">
                                        <i data-lucide="graduation-cap" style="width:10px;height:10px"></i> Con
                                    </span>
                                @elseif($stream === 'academy')
                                    <span class="stream-badge stream-academy">
                                        <i data-lucide="book-open" style="width:10px;height:10px"></i> Aca
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5">
                            <div class="avatar avatar-sm avatar-violet">{{ substr($candidate['handler'], 0, 2) }}</div>
                            <span class="text-sm text-slate-600">{{ $candidate['handler'] }}</span>
                        </div>
                    </td>
                    <td><x-status-badge :status="$candidate['status']" /></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium {{ $candidate['docs'] === '5/5' ? 'text-emerald-600' : ($candidate['docs'] === '0/5' ? 'text-rose-500' : 'text-amber-600') }}">
                                {{ $candidate['docs'] }}
                            </span>
                            <div class="progress-bar-track w-12">
                                @php $parts = explode('/', $candidate['docs']); $pct = $parts[1] > 0 ? ($parts[0]/$parts[1]*100) : 0; @endphp
                                <div class="progress-bar-fill {{ $pct === 100 ? 'bg-emerald-500' : ($pct === 0 ? 'bg-rose-500' : 'bg-amber-400') }}"
                                     style="width: {{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-xs text-slate-500 whitespace-nowrap">{{ $candidate['registered'] }}</td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('employment.candidates.show', 1) }}" class="btn btn-ghost btn-xs" title="View">
                                <i data-lucide="eye" style="width:13px;height:13px"></i>
                            </a>
                            <a href="{{ route('employment.candidates.edit', 1) }}" class="btn btn-ghost btn-xs" title="Edit">
                                <i data-lucide="pencil" style="width:13px;height:13px"></i>
                            </a>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="btn btn-ghost btn-xs" title="More">
                                    <i data-lucide="more-horizontal" style="width:13px;height:13px"></i>
                                </button>
                                <div x-show="open" @click.outside="open = false" x-transition
                                     class="absolute right-0 top-8 w-44 bg-white rounded-xl shadow-xl border border-slate-100 z-50 py-1"
                                     style="display:none">
                                    <a href="#" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50">
                                        <i data-lucide="file-plus" style="width:12px;height:12px"></i> Add Document
                                    </a>
                                    <a href="{{ route('employment.matching') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50">
                                        <i data-lucide="target" style="width:12px;height:12px"></i> Match Vacancy
                                    </a>
                                    <a href="{{ route('employment.registration-links.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50">
                                        <i data-lucide="link" style="width:12px;height:12px"></i> Registration Link
                                    </a>
                                    <div class="border-t border-slate-100 my-1"></div>
                                    <a href="{{ route('employment.refunds.create') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-rose-600 hover:bg-rose-50">
                                        <i data-lucide="rotate-ccw" style="width:12px;height:12px"></i> Start Refund
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–20 of 1,284 candidates</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Previous</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">3</button>
            <span class="px-2 py-1 text-slate-400 text-sm">…</span>
            <button class="btn btn-ghost btn-sm">65</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>

</x-layouts.app>
