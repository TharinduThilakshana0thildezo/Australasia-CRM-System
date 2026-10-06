<x-layouts.app title="Reports — Australasia CRM">

<x-page-header
    title="Reports"
    subtitle="Analytics, exports and operational reports across all modules"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Reports']]">
</x-page-header>

<!-- Report Categories -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    @php
    $categories = [
        ['icon' => 'briefcase', 'title' => 'Foreign Employment', 'color' => 'indigo', 'desc' => 'Candidate pipeline, visa processing, deployment stats, source analysis', 'href' => route('reports.employment'), 'reports' => 8],
        ['icon' => 'graduation-cap', 'title' => 'Consultancy', 'color' => 'violet', 'desc' => 'Student applications, institution acceptance rates, visa success', 'href' => route('reports.consultancy'), 'reports' => 5],
        ['icon' => 'book-open', 'title' => 'Academy', 'color' => 'emerald', 'desc' => 'Enrollment trends, attendance, exam results, certificate issuance', 'href' => route('reports.academy'), 'reports' => 6],
        ['icon' => 'wallet', 'title' => 'Finance', 'color' => 'amber', 'desc' => 'Revenue trends, payments, refunds, outstanding balances', 'href' => route('reports.finance'), 'reports' => 7],
    ];
    @endphp
    @foreach($categories as $cat)
    <a href="{{ $cat['href'] }}"
       class="card hover:shadow-xl transition-all hover:-translate-y-0.5 group" style="text-decoration:none">
        <div class="card-body">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-{{ $cat['color'] }}-50 flex items-center justify-center border border-{{ $cat['color'] }}-100">
                    <i data-lucide="{{ $cat['icon'] }}"
                       style="width:22px;height:22px;color:var(--color-status-{{ $cat['color'] === 'indigo' ? 'employer' : ($cat['color'] === 'violet' ? 'visa' : ($cat['color'] === 'emerald' ? 'deployed' : 'documents')) }})"></i>
                </div>
                <span class="badge badge-draft">{{ $cat['reports'] }} reports</span>
            </div>
            <h3 class="text-base font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $cat['title'] }}</h3>
            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">{{ $cat['desc'] }}</p>
            <div class="mt-4 flex items-center gap-1 text-xs font-semibold text-indigo-600">
                View Reports <i data-lucide="arrow-right" style="width:12px;height:12px"></i>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Quick Export Reports -->
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Quick Export</h3>
        <span class="text-xs text-slate-500">Export current data as Excel or PDF</span>
    </div>
    <div class="card-body">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
            @php
            $quickExports = [
                ['title' => 'Candidate Master List',       'module' => 'Employment',  'icon' => 'users'],
                ['title' => 'Active Applications',         'module' => 'Employment',  'icon' => 'file-text'],
                ['title' => 'Visa Processing Status',      'module' => 'Employment',  'icon' => 'shield'],
                ['title' => 'Deployment Schedule',         'module' => 'Employment',  'icon' => 'plane'],
                ['title' => 'Monthly Revenue Summary',     'module' => 'Finance',     'icon' => 'bar-chart-2'],
                ['title' => 'Outstanding Payments',        'module' => 'Finance',     'icon' => 'credit-card'],
                ['title' => 'Student Application Status',  'module' => 'Consultancy', 'icon' => 'graduation-cap'],
                ['title' => 'Batch Attendance Sheet',      'module' => 'Academy',     'icon' => 'clipboard-list'],
                ['title' => 'Staff Activity Log',          'module' => 'Admin',       'icon' => 'activity'],
            ];
            @endphp
            @foreach($quickExports as $ex)
            <div class="flex items-center justify-between p-3 bg-slate-50 border border-slate-200 rounded-xl hover:border-indigo-200 hover:bg-indigo-50 transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="{{ $ex['icon'] }}" style="width:14px;height:14px;color:#6366f1"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">{{ $ex['title'] }}</p>
                        <p class="text-xs text-slate-500">{{ $ex['module'] }}</p>
                    </div>
                </div>
                <div class="flex gap-1.5 flex-shrink-0">
                    <button class="btn btn-ghost btn-xs" title="Export Excel">
                        <i data-lucide="file-spreadsheet" style="width:13px;height:13px;color:#059669"></i>
                    </button>
                    <button class="btn btn-ghost btn-xs" title="Export PDF">
                        <i data-lucide="file-type" style="width:13px;height:13px;color:#dc2626"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Recent Generated Reports -->
<div class="card">
    <div class="card-header"><h3 class="card-title">Recently Generated</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Report</th>
                    <th>Module</th>
                    <th>Generated By</th>
                    <th>Date</th>
                    <th>Format</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @php
                $recent = [
                    ['name' => 'October Deployment Schedule',   'module' => 'Employment',  'by' => 'Nimal J.', 'date' => '06 Oct 2026', 'format' => 'PDF'],
                    ['name' => 'Monthly Revenue Summary',        'module' => 'Finance',     'by' => 'Ravi S.',  'date' => '05 Oct 2026', 'format' => 'Excel'],
                    ['name' => 'Active Visa Applications',       'module' => 'Employment',  'by' => 'Priya H.', 'date' => '04 Oct 2026', 'format' => 'Excel'],
                    ['name' => 'Candidate Master List — Oct 26', 'module' => 'Employment',  'by' => 'Nimal J.', 'date' => '01 Oct 2026', 'format' => 'Excel'],
                ];
                @endphp
                @foreach($recent as $r)
                <tr>
                    <td class="text-sm font-semibold text-slate-800">{{ $r['name'] }}</td>
                    <td><span class="stream-badge {{ $r['module'] === 'Employment' ? 'stream-employment' : 'badge-draft' }}">{{ $r['module'] }}</span></td>
                    <td class="text-sm text-slate-600">{{ $r['by'] }}</td>
                    <td class="text-sm text-slate-500">{{ $r['date'] }}</td>
                    <td>
                        <span class="badge {{ $r['format'] === 'PDF' ? 'badge-refund' : 'badge-pool' }}">{{ $r['format'] }}</span>
                    </td>
                    <td>
                        <button class="btn btn-ghost btn-xs">
                            <i data-lucide="download" style="width:13px;height:13px"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
