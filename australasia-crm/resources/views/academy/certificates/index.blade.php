<x-layouts.app title="Certificates — Academy">

<x-page-header
    title="Certificate Management"
    subtitle="Issue, view, void, and reissue Academy completion certificates"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Certificates']]">
    <x-slot:actions>
        <button onclick="openModal('issue-cert-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="award" style="width:14px;height:14px"></i>Issue Certificate
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['6','Ready to Issue','award','amber'],['189','Issued (All Time)','check-circle','emerald'],['3','Issued This Month','clock','indigo'],['1','Voided','x-circle','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

{{-- Ready to Issue --}}
<div class="card mb-5 border-amber-200">
    <div class="card-header bg-amber-50">
        <div class="flex items-center gap-2"><i data-lucide="award" style="width:18px;height:18px;color:#d97706"></i><h3 class="card-title text-amber-700">6 Enrollments Ready for Certificate Issuance</h3></div>
        <span class="text-sm text-amber-600">All completion conditions met</span>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Course</th><th>Batch</th><th>Result</th><th>Completed On</th><th>Action</th></tr></thead>
            <tbody>
                @foreach([
                    ['ACD-1001','Kamal Pradeep','Pre-Departure — Warehouse','BCH-2026-003-P','Pass — 76/100','15 Sep 2026'],
                    ['ACD-1002','Nimesha Silva','Pre-Departure — Warehouse','BCH-2026-003-P','Pass — 68/100','15 Sep 2026'],
                    ['ACD-1003','Samantha Perera','English Communication','BCH-2026-002','Pass — 82/100','20 Oct 2026'],
                ] as $r)
                <tr>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $r[1] }}</a><p class="text-xs text-slate-400">{{ $r[0] }}</p></td>
                    <td class="text-sm text-slate-700">{{ $r[2] }}</td>
                    <td class="text-xs font-mono text-slate-500">{{ $r[3] }}</td>
                    <td><span class="badge badge-approved">{{ $r[4] }}</span></td>
                    <td class="text-xs text-slate-500">{{ $r[5] }}</td>
                    <td>
                        <button onclick="openModal('issue-cert-modal')" class="btn btn-primary btn-xs"><i data-lucide="award" style="width:12px;height:12px"></i>Issue Certificate</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Issued Certificates --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="cert-search" type="text" class="search-input" placeholder="Search student, certificate ID, course…">
            </div>
            <select id="cert-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="issued">Issued</option>
                <option value="voided">Voided</option>
                <option value="reissued">Reissued</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">Issued Certificates</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Certificate ID</th><th>Student</th><th>Course</th><th>Issue Date</th><th>Issued By</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $certs=[
                    ['CERT-ACD-A8F2','ACD-1001','Kamal Pradeep','Pre-Departure — Warehouse','17 Sep 2026','Kasun Bandara','issued'],
                    ['CERT-ACD-B3E9','ACD-1002','Nimesha Silva','English Communication','17 Sep 2026','Kasun Bandara','issued'],
                    ['CERT-ACD-C7D1','ACD-1003','Chamara Bandara','Computer Literacy','15 Sep 2026','Priya Hewage','issued'],
                    ['CERT-ACD-D4F8','ACD-1004','Roshan Jayawardena','Hospitality Training','14 Sep 2026','Nimal Jayawardena','issued'],
                    ['CERT-ACD-E2B0','ACD-1009','Malinda Seneviratne','Pre-Departure — Warehouse','12 Sep 2026','Kasun Bandara','voided'],
                ];
                @endphp
                @foreach($certs as $c)
                <tr class="cert-row" data-status="{{ $c[6] }}">
                    <td><code class="text-xs font-mono {{ $c[6]==='voided'?'text-rose-400 line-through':'text-emerald-600' }}">{{ $c[0] }}</code></td>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $c[2] }}</a><p class="text-xs text-slate-400">{{ $c[1] }}</p></td>
                    <td class="text-sm text-slate-700">{{ $c[3] }}</td>
                    <td class="text-xs text-slate-500">{{ $c[4] }}</td>
                    <td class="text-sm text-slate-500">{{ $c[5] }}</td>
                    <td><x-status-badge :status="$c[6]" /></td>
                    <td>
                        <div class="flex gap-1">
                            @if($c[6]==='issued')
                            <button class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></button>
                            <button class="btn btn-outline btn-xs"><i data-lucide="download" style="width:13px;height:13px"></i></button>
                            <button onclick="openModal('void-modal')" class="btn btn-danger btn-xs">Void</button>
                            <button onclick="openModal('reissue-modal')" class="btn btn-outline btn-xs">Reissue</button>
                            @elseif($c[6]==='voided')
                            <span class="text-xs text-slate-400">Voided — history preserved</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Issue Certificate Modal --}}
<div id="issue-cert-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Issue Certificate</span><button onclick="closeModal('issue-cert-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.certificates.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-info text-sm"><i data-lucide="check-circle" style="width:14px;height:14px;flex-shrink:0"></i>Certificate is generated only when all completion conditions are verified. A certificate number will be auto-assigned.</div>
                <div class="form-group"><label class="form-label required">Enrollment / Student</label>
                    <select name="enrollment_id" class="form-select" required>
                        <option value="">Select enrolled student</option>
                        <option value="ENR-ACD-0047">ENR-ACD-0047 — Kamal Pradeep (PDT-WH)</option>
                        <option value="ENR-ACD-0048">ENR-ACD-0048 — Nimesha Silva (PDT-WH)</option>
                        <option value="ENR-ACD-0049">ENR-ACD-0049 — Samantha Perera (English)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Issue Date</label>
                    <input name="issue_date" type="date" class="form-input" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="form-group"><label class="form-label required">Issued By</label>
                    <select name="issued_by" class="form-select" required>
                        <option value="Kasun Bandara">Kasun Bandara</option>
                        <option value="Nimal Jayawardena">Nimal Jayawardena</option>
                        <option value="Priya Hewage">Priya Hewage</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('issue-cert-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Issue Certificate</button></div>
        </form>
    </div>
</div>

{{-- Void Modal --}}
<div id="void-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Void Certificate</span><button onclick="closeModal('void-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.certificates.void',1) }}">
            @csrf
            <div class="modal-body">
                <div class="alert alert-danger mb-3 text-sm"><i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>Voiding a certificate is irreversible. The original document is preserved. A void entry will appear in the audit log.</div>
                <div class="form-group"><label class="form-label required">Reason for Voiding</label><textarea name="void_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('void-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger" onclick="return confirm('Void this certificate?')">Void Certificate</button></div>
        </form>
    </div>
</div>

{{-- Reissue Modal --}}
<div id="reissue-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Reissue Certificate</span><button onclick="closeModal('reissue-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.certificates.reissue',1) }}">
            @csrf
            <div class="modal-body">
                <div class="alert alert-warning mb-3 text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Previous certificate will be voided. A new certificate number will be assigned. Both records are preserved.</div>
                <div class="form-group"><label class="form-label required">Reason for Reissue</label><textarea name="reissue_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('reissue-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-warning">Reissue Certificate</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('cert-search'),st=document.getElementById('cert-status');
    const rows=document.querySelectorAll('tr.cert-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status===status);r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
