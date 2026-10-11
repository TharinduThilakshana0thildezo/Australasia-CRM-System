<x-layouts.app title="Applications — Consultancy">

<x-page-header
    title="Applications"
    subtitle="All university applications submitted through the consultancy"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Applications']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.offers.index') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="inbox" style="width:14px;height:14px"></i>Offers & Acceptance
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['34','Total Applications','file-text','indigo'],['12','Submitted','send','cyan'],['11','Offer Received','inbox','emerald'],['3','Rejected','x-circle','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

{{-- Filters --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="app-search" type="text" class="search-input" placeholder="Search student, institution, course…">
            </div>
            <select id="app-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="submitted">Submitted</option>
                <option value="offer_received">Offer Received</option>
                <option value="conditional_offer">Conditional Offer</option>
                <option value="approved">Accepted</option>
                <option value="rejected">Rejected</option>
                <option value="withdrawn">Withdrawn</option>
            </select>
            <select id="app-country" class="form-select" style="width:auto">
                <option value="">All Countries</option>
                <option value="Australia">Australia</option>
                <option value="UK">UK</option>
                <option value="Canada">Canada</option>
                <option value="New Zealand">New Zealand</option>
                <option value="USA">USA</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong>34</strong> applications</div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>App ID</th><th>Student</th><th>Institution</th><th>Course</th><th>Intake</th><th>Country</th><th>Submitted</th><th>Status</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $apps=[
                    ['id'=>'APP-CON-0089','student'=>'Sachini Ranasinghe','sid'=>'CON-0089','institution'=>'Monash University','course'=>'Bachelor of IT','intake'=>'Feb 2027','country'=>'Australia','submitted'=>'10 Sep 2026','status'=>'offer_received'],
                    ['id'=>'APP-CON-0090','student'=>'Sachini Ranasinghe','sid'=>'CON-0089','institution'=>'RMIT University','course'=>'Bachelor of IT','intake'=>'Feb 2027','country'=>'Australia','submitted'=>'10 Sep 2026','status'=>'submitted'],
                    ['id'=>'APP-CON-0088','student'=>'Kavinda Gunasekara','sid'=>'CON-0088','institution'=>'Univ. of Manchester','course'=>'MBA','intake'=>'Sep 2027','country'=>'UK','submitted'=>'15 Aug 2026','status'=>'approved'],
                    ['id'=>'APP-CON-0087','student'=>'Thisara Wickramasinghe','sid'=>'CON-0087','institution'=>'Toronto Metropolitan','course'=>'Diploma IT','intake'=>'Jan 2027','country'=>'Canada','submitted'=>'20 Sep 2026','status'=>'submitted'],
                    ['id'=>'APP-CON-0083','student'=>'Chamari Dias','sid'=>'CON-0083','institution'=>'UCL London','course'=>'MSc Data Science','intake'=>'Sep 2027','country'=>'UK','submitted'=>'05 Aug 2026','status'=>'offer_received'],
                    ['id'=>'APP-CON-0081','student'=>'Pradeep Fernando','sid'=>'CON-0081','institution'=>'Univ. of Massachusetts','course'=>'BS Computer Science','intake'=>'Sep 2027','country'=>'USA','submitted'=>'20 Aug 2026','status'=>'conditional_offer'],
                    ['id'=>'APP-CON-0080','student'=>'Indika Chandrasena','sid'=>'CON-0080','institution'=>'Deakin University','course'=>'Graduate Diploma','intake'=>'Mar 2027','country'=>'Australia','submitted'=>'25 Jun 2026','status'=>'approved'],
                    ['id'=>'APP-CON-0078','student'=>'Ruwan Bandara','sid'=>'CON-0084','institution'=>'Monash University','course'=>'Bachelor of IT','intake'=>'Feb 2027','country'=>'Australia','submitted'=>'20 Jul 2026','status'=>'approved'],
                ];
                @endphp
                @foreach($apps as $app)
                <tr class="app-row" data-status="{{ $app['status'] }}" data-country="{{ $app['country'] }}">
                    <td><a href="{{ route('consultancy.applications.show',1) }}" class="text-sm font-semibold text-indigo-600">{{ $app['id'] }}</a></td>
                    <td>
                        <a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $app['student'] }}</a>
                        <p class="text-xs text-slate-400">{{ $app['sid'] }}</p>
                    </td>
                    <td class="text-sm text-slate-700">{{ $app['institution'] }}</td>
                    <td class="text-sm text-slate-600">{{ $app['course'] }}</td>
                    <td class="text-sm text-slate-600">{{ $app['intake'] }}</td>
                    <td class="text-sm text-slate-600">{{ $app['country'] }}</td>
                    <td class="text-xs text-slate-500">{{ $app['submitted'] }}</td>
                    <td><x-status-badge :status="$app['status']" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('consultancy.applications.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if(in_array($app['status'],['submitted','conditional_offer','offer_received']))
                            <button onclick="openModal('update-app-modal')" class="btn btn-primary btn-xs">Update</button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Update Status Modal --}}
<div id="update-app-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Update Application Status</span><button onclick="closeModal('update-app-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.applications.update-status',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group">
                    <label class="form-label required">New Status</label>
                    <select name="status" class="form-select" required>
                        <option value="submitted">Submitted</option>
                        <option value="conditional_offer">Conditional Offer</option>
                        <option value="offer_received">Unconditional Offer</option>
                        <option value="approved">Accepted</option>
                        <option value="rejected">Rejected</option>
                        <option value="withdrawn">Withdrawn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes / Decision Details</label>
                    <textarea name="notes" rows="4" class="form-textarea" placeholder="e.g. Conditional offer — requires higher IELTS score / unconditional offer letter attached…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('update-app-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('app-search'),st=document.getElementById('app-status'),c=document.getElementById('app-country');
    const rows=document.querySelectorAll('tr.app-row');
    function filter(){const q=(s?.value||'').toLowerCase(),status=(st?.value||''),country=(c?.value||'');rows.forEach(r=>{const ok=(!q||r.textContent.toLowerCase().includes(q))&&(!status||r.dataset.status.includes(status))&&(!country||r.dataset.country.includes(country));r.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);st?.addEventListener('change',filter);c?.addEventListener('change',filter);
});
</script>
</x-layouts.app>
