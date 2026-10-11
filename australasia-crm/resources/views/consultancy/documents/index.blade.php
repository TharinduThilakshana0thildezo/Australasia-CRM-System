<x-layouts.app title="Documents — Consultancy DMS">

<x-page-header
    title="Document Management"
    subtitle="All student documents across the consultancy pipeline"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Documents']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.documents.review') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="eye" style="width:14px;height:14px"></i>Review Queue
            <span class="tab-count ml-1">23</span>
        </a>
    </x-slot:actions>
</x-page-header>

{{-- Summary KPIs --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['Total Documents','1,847','file-text','indigo'],
        ['Approved','1,621','check-circle','emerald'],
        ['Pending Review','23','clock','amber'],
        ['Correction Required','14','alert-triangle','rose'],
    ] as $k)
    <div class="stat-card">
        <div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-5 h-5 text-{{ $k[3] }}-600"></i></div>
        <div class="stat-value">{{ $k[0] }}</div>
        <div class="stat-label">{{ $k[1] }}</div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="doc-search" type="text" class="search-input" placeholder="Search student name, document type…">
            </div>
            <select id="doc-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="approved">Approved</option>
                <option value="under_review">Under Review</option>
                <option value="correction_required">Correction Required</option>
                <option value="rejected">Rejected</option>
            </select>
            <select id="doc-type" class="form-select" style="width:auto">
                <option value="">All Types</option>
                <option value="NIC">NIC</option>
                <option value="Passport">Passport</option>
                <option value="CV">CV / Resume</option>
                <option value="Educational">Educational Certificates</option>
                <option value="English">English Test</option>
                <option value="Experience">Experience Letter</option>
                <option value="Bank">Bank Statement</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong>20</strong> of <strong>1,847</strong> documents</div>
        <a href="{{ route('consultancy.documents.review') }}" class="btn btn-primary btn-sm"><i data-lucide="check-square" style="width:13px;height:13px"></i>Review Queue (23)</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>Student</th><th>Document Type</th><th>File</th><th>Uploaded</th><th>Status</th><th>Reviewed By</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $docs=[
                    ['student'=>'Sachini Ranasinghe','sid'=>'CON-0089','type'=>'NIC','file'=>'nic_sachini.jpg','uploaded'=>'03 Aug 2026','status'=>'approved','rev'=>'Priya Hewage'],
                    ['student'=>'Sachini Ranasinghe','sid'=>'CON-0089','type'=>'Passport','file'=>'passport_sachini.pdf','uploaded'=>'03 Aug 2026','status'=>'approved','rev'=>'Priya Hewage'],
                    ['student'=>'Kavinda Gunasekara','sid'=>'CON-0088','type'=>'NIC','file'=>'nic_kavinda.jpg','uploaded'=>'12 Aug 2026','status'=>'approved','rev'=>'Kasun Bandara'],
                    ['student'=>'Kavinda Gunasekara','sid'=>'CON-0088','type'=>'Educational Certificates','file'=>'al_results_kavinda.pdf','uploaded'=>'13 Aug 2026','status'=>'approved','rev'=>'Kasun Bandara'],
                    ['student'=>'Thisara Wickramasinghe','sid'=>'CON-0087','type'=>'Degree Certificate','file'=>'degree_thisara.pdf','uploaded'=>'07 Oct 2026','status'=>'correction_required','rev'=>'Kasun Bandara'],
                    ['student'=>'Dinusha Jayasena','sid'=>'CON-0086','type'=>'CV / Resume','file'=>'cv_dinusha.pdf','uploaded'=>'18 Sep 2026','status'=>'under_review','rev'=>'Pending'],
                    ['student'=>'Dinusha Jayasena','sid'=>'CON-0086','type'=>'NIC','file'=>'nic_dinusha.jpg','uploaded'=>'18 Sep 2026','status'=>'approved','rev'=>'Nimal Jayawardena'],
                    ['student'=>'Amara Dissanayake','sid'=>'CON-0085','type'=>'Passport','file'=>'passport_amara.pdf','uploaded'=>'23 Sep 2026','status'=>'under_review','rev'=>'Pending'],
                    ['student'=>'Ruwan Bandara','sid'=>'CON-0084','type'=>'English Test Result','file'=>'ielts_ruwan.pdf','uploaded'=>'08 Jul 2026','status'=>'approved','rev'=>'Priya Hewage'],
                    ['student'=>'Chamari Dias','sid'=>'CON-0083','type'=>'Bank Statement','file'=>'bank_stmt_chamari.pdf','uploaded'=>'25 Jul 2026','status'=>'approved','rev'=>'Amila Perera'],
                ];
                @endphp
                @foreach($docs as $doc)
                <tr class="doc-row" data-status="{{ $doc['status'] }}" data-type="{{ $doc['type'] }}">
                    <td>
                        <a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $doc['student'] }}</a>
                        <p class="text-xs text-slate-400">{{ $doc['sid'] }}</p>
                    </td>
                    <td class="text-sm font-medium text-slate-700">{{ $doc['type'] }}</td>
                    <td class="text-xs font-mono text-slate-500 truncate max-w-36">{{ $doc['file'] }}</td>
                    <td class="text-xs text-slate-500">{{ $doc['uploaded'] }}</td>
                    <td><x-status-badge :status="$doc['status']" /></td>
                    <td class="text-sm text-slate-500">{{ $doc['rev'] }}</td>
                    <td>
                        <div class="flex gap-1">
                            <button class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:12px;height:12px"></i></button>
                            <button class="btn btn-ghost btn-xs"><i data-lucide="download" style="width:12px;height:12px"></i></button>
                            @if($doc['status']==='under_review')
                            <a href="{{ route('consultancy.documents.review') }}" class="btn btn-primary btn-xs">Review</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <span class="text-sm text-slate-500">Showing 10 of 1,847</span>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Prev</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('doc-search'),st=document.getElementById('doc-status'),tp=document.getElementById('doc-type');
    const rows=document.querySelectorAll('tr.doc-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||''),type=(tp?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status.includes(status))&&(!type||r.dataset.type.toLowerCase().includes(type.toLowerCase()));r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);tp?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
