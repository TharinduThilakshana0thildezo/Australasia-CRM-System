<x-layouts.app title="Leads — Consultancy">

<x-page-header
    title="Leads"
    subtitle="All enquiries and leads — initial stage before student registration"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Leads']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.leads.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Lead
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

{{-- Filter --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="lead-search" type="text" class="search-input" placeholder="Search name, phone, email…">
            </div>
            <select id="lead-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="new">New</option>
                <option value="contacted">Contacted</option>
                <option value="qualified">Qualified</option>
                <option value="converted">Converted</option>
                <option value="unresponsive">Unresponsive</option>
                <option value="closed">Closed</option>
            </select>
            <select id="lead-source" class="form-select" style="width:auto">
                <option value="">All Sources</option>
                <option value="walk-in">Walk-in</option>
                <option value="referral">Referral</option>
                <option value="online">Online Enquiry</option>
                <option value="agent">Agent</option>
                <option value="social">Social Media</option>
            </select>
            <select id="lead-handler" class="form-select" style="width:auto">
                <option value="">All Consultants</option>
                <option value="priya">Priya Hewage</option>
                <option value="kasun">Kasun Bandara</option>
                <option value="nimal">Nimal Jayawardena</option>
                <option value="amila">Amila Perera</option>
            </select>
            <button id="lead-clear" class="btn btn-ghost btn-sm"><i data-lucide="x" style="width:14px;height:14px"></i>Clear</button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong>22</strong> leads</div>
        <a href="{{ route('consultancy.leads.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Add Lead</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>Lead</th><th>Contact</th><th>Destination</th><th>Source</th><th>Enquiry Date</th><th>Assigned To</th><th>Status</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $leads=[
                    ['id'=>'LEAD-0022','name'=>'Nimasha Pathirana',  'phone'=>'077 123 4500','email'=>'nimasha@gmail.com','country'=>'Australia','source'=>'walk-in', 'date'=>'10 Oct 2026','handler'=>'Priya H.',  'status'=>'new'],
                    ['id'=>'LEAD-0021','name'=>'Tharaka Silva',      'phone'=>'071 234 5601','email'=>'tharaka@yahoo.com','country'=>'UK',       'source'=>'online',   'date'=>'09 Oct 2026','handler'=>'Kasun B.', 'status'=>'contacted'],
                    ['id'=>'LEAD-0020','name'=>'Sanduni Perera',     'phone'=>'076 345 6702','email'=>'sanduni@gmail.com','country'=>'Canada',   'source'=>'referral', 'date'=>'08 Oct 2026','handler'=>'Nimal J.',  'status'=>'qualified'],
                    ['id'=>'LEAD-0019','name'=>'Chamal Bandara',     'phone'=>'078 456 7803','email'=>'','country'=>'New Zealand',               'source'=>'agent',    'date'=>'07 Oct 2026','handler'=>'Amila P.',  'status'=>'converted'],
                    ['id'=>'LEAD-0018','name'=>'Dilhani Fernando',   'phone'=>'070 567 8904','email'=>'dilhani@email.lk','country'=>'Australia', 'source'=>'social',   'date'=>'05 Oct 2026','handler'=>'Priya H.',  'status'=>'unresponsive'],
                    ['id'=>'LEAD-0017','name'=>'Asanka Jayawardena', 'phone'=>'077 678 9005','email'=>'asanka@gmail.com','country'=>'Australia',  'source'=>'walk-in',  'date'=>'04 Oct 2026','handler'=>'Kasun B.', 'status'=>'new'],
                    ['id'=>'LEAD-0016','name'=>'Menuka Wickramasinghe','phone'=>'071 789 0106','email'=>'menuka@gmail.com','country'=>'UK',      'source'=>'online',   'date'=>'02 Oct 2026','handler'=>'Priya H.',  'status'=>'qualified'],
                    ['id'=>'LEAD-0015','name'=>'Prasad Ranatunga',   'phone'=>'076 890 1207','email'=>'','country'=>'Canada',                    'source'=>'referral', 'date'=>'01 Oct 2026','handler'=>'Nimal J.',  'status'=>'closed'],
                ];
                @endphp
                @foreach($leads as $lead)
                <tr class="lead-row" data-status="{{ $lead['status'] }}" data-source="{{ $lead['source'] }}" data-handler="{{ strtolower(explode(' ',$lead['handler'])[0]) }}">
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-violet">{{ strtoupper(substr($lead['name'],0,1).substr(strstr($lead['name'],' '),1,1)) }}</div>
                            <div>
                                <a href="{{ route('consultancy.leads.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $lead['name'] }}</a>
                                <p class="text-xs text-slate-400">{{ $lead['id'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm text-slate-700">{{ $lead['phone'] }}</div>
                        @if($lead['email'])<div class="text-xs text-slate-400">{{ $lead['email'] }}</div>@endif
                    </td>
                    <td class="text-sm text-slate-600">{{ $lead['country'] }}</td>
                    <td><span class="badge badge-lead">{{ ucfirst(str_replace('-',' ',$lead['source'])) }}</span></td>
                    <td class="text-xs text-slate-500">{{ $lead['date'] }}</td>
                    <td>
                        <div class="flex items-center gap-1.5">
                            <div class="avatar avatar-sm avatar-violet">{{ substr($lead['handler'],0,2) }}</div>
                            <span class="text-sm text-slate-600">{{ $lead['handler'] }}</span>
                        </div>
                    </td>
                    <td>
                        @php
                        $statusMap=['new'=>'lead','contacted'=>'in_progress','qualified'=>'checklist','converted'=>'approved','unresponsive'=>'withdrawn','closed'=>'closed'];
                        @endphp
                        <x-status-badge :status="$statusMap[$lead['status']] ?? 'lead'" />
                    </td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('consultancy.leads.show',1) }}" class="btn btn-ghost btn-xs" title="View"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if($lead['status'] !== 'converted')
                            <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-xs" title="Convert to Student">Convert</a>
                            @else
                            <span class="badge badge-approved">Converted ✓</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 8 of 22 leads</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Prev</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const s=document.getElementById('lead-search'),st=document.getElementById('lead-status'),so=document.getElementById('lead-source'),h=document.getElementById('lead-handler'),c=document.getElementById('lead-clear');
    const rows=document.querySelectorAll('tr.lead-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||''),src=(so?.value||''),hnd=(h?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status.includes(status))&&(!src||r.dataset.source.includes(src))&&(!hnd||r.dataset.handler.includes(hnd));r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);so?.addEventListener('change',filter);h?.addEventListener('change',filter);
    c?.addEventListener('click',()=>{[s,st,so,h].forEach(e=>{if(e)e.value=''});filter();});
});
</script>
</x-layouts.app>
