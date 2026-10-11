<x-layouts.app title="Student Clients — Consultancy">

<x-page-header
    title="Student Clients"
    subtitle="All consultancy students — journey from lead to university enrollment"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Students']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.leads.create') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>New Lead
        </a>
        <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>Register Student
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4">
    <i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}
</div>
@endif

{{-- Filter Bar --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input id="stu-search" type="text" class="search-input" placeholder="Search name, NIC, phone, student ID, institution…">
            </div>
            <select id="stu-status" class="form-select" style="width:auto">
                <option value="">All Statuses</option>
                <option value="lead">Lead</option>
                <option value="registered">Registered</option>
                <option value="fee_pending">Fee Pending</option>
                <option value="documents_pending">Docs Pending</option>
                <option value="correction_required">Correction Required</option>
                <option value="counselling">Counselling</option>
                <option value="shortlisted">Shortlisted</option>
                <option value="applied">Applied</option>
                <option value="offer_received">Offer Received</option>
                <option value="visa_processing">Visa Processing</option>
                <option value="visa_approved">Visa Approved</option>
                <option value="enrolled">Enrolled</option>
                <option value="closed">Closed</option>
                <option value="withdrawn">Withdrawn</option>
            </select>
            <select id="stu-handler" class="form-select" style="width:auto">
                <option value="">All Consultants</option>
                <option value="priya">Priya Hewage</option>
                <option value="kasun">Kasun Bandara</option>
                <option value="nimal">Nimal Jayawardena</option>
                <option value="amila">Amila Perera</option>
            </select>
            <select id="stu-source" class="form-select" style="width:auto">
                <option value="">All Sources</option>
                <option value="walk-in">Walk-in</option>
                <option value="referral">Referral</option>
                <option value="online">Online Enquiry</option>
                <option value="agent">Agent</option>
            </select>
            <select id="stu-country" class="form-select" style="width:auto">
                <option value="">All Countries</option>
                <option value="australia">Australia</option>
                <option value="uk">UK</option>
                <option value="canada">Canada</option>
                <option value="new zealand">New Zealand</option>
                <option value="usa">USA</option>
            </select>
            <button id="stu-clear" class="btn btn-ghost btn-sm">
                <i data-lucide="x" style="width:14px;height:14px"></i>Clear
            </button>
        </div>
        <div class="filter-bar mt-3">
            <span class="text-xs text-slate-500 font-medium mr-1">Quick:</span>
            <button class="filter-pill active" data-pill="">All (263)</button>
            <button class="filter-pill" data-pill="fee_pending">Fee Pending (14)</button>
            <button class="filter-pill" data-pill="correction_required">Correction (11)</button>
            <button class="filter-pill" data-pill="counselling">Counselling (41)</button>
            <button class="filter-pill" data-pill="visa_processing">Visa (18)</button>
            <button class="filter-pill" data-pill="enrolled">Enrolled (12)</button>
        </div>
    </div>
</div>

{{-- Student Table --}}
<div class="card">
    <div class="card-header">
        <div class="text-sm text-slate-500">Showing <strong class="text-slate-800">1–20</strong> of <strong class="text-slate-800">263</strong> students</div>
        <div class="flex gap-2">
            <button class="btn btn-ghost btn-xs" title="Table view"><i data-lucide="list" style="width:14px;height:14px"></i></button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th><input id="stu-select-all" type="checkbox" class="form-input" style="width:16px;height:16px;padding:0"></th>
                <th>Student</th>
                <th>NIC / Phone</th>
                <th>Destination</th>
                <th>Institution / Course</th>
                <th>Consultant</th>
                <th>Journey Stage</th>
                <th>Docs</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $students = [
                    ['id'=>'CON-0089','name'=>'Sachini Ranasinghe',    'nic'=>'199608203421','phone'=>'077 234 5678','country'=>'Australia',   'institution'=>'Monash University',       'course'=>'Bachelor of IT',     'handler'=>'Priya H.',  'status'=>'visa_approved',       'docs'=>'6/6','reg'=>'01 Aug 2026','source'=>'walk-in'],
                    ['id'=>'CON-0088','name'=>'Kavinda Gunasekara',     'nic'=>'200012034578','phone'=>'071 456 7890','country'=>'UK',          'institution'=>'Univ. of Manchester',     'course'=>'MBA',                'handler'=>'Amila P.',  'status'=>'offer_received',      'docs'=>'6/6','reg'=>'10 Aug 2026','source'=>'referral'],
                    ['id'=>'CON-0087','name'=>'Thisara Wickramasinghe', 'nic'=>'199803214321','phone'=>'076 987 6543','country'=>'Canada',      'institution'=>'Toronto Metropolitan',    'course'=>'Diploma IT',         'handler'=>'Kasun B.',  'status'=>'correction_required', 'docs'=>'4/6','reg'=>'02 Sep 2026','source'=>'online'],
                    ['id'=>'CON-0086','name'=>'Dinusha Jayasena',       'nic'=>'200107120987','phone'=>'070 123 4567','country'=>'New Zealand', 'institution'=>'TBC',                     'course'=>'TBC',                'handler'=>'Nimal J.',  'status'=>'counselling',         'docs'=>'3/6','reg'=>'15 Sep 2026','source'=>'agent'],
                    ['id'=>'CON-0085','name'=>'Amara Kumari Dissanayake','nic'=>'199801234567','phone'=>'077 876 5432','country'=>'Australia',  'institution'=>'RMIT University',         'course'=>'Bachelor of Business','handler'=>'Amila P.',  'status'=>'fee_pending',         'docs'=>'1/6','reg'=>'20 Sep 2026','source'=>'online'],
                    ['id'=>'CON-0084','name'=>'Ruwan Bandara',          'nic'=>'199503145678','phone'=>'071 234 5670','country'=>'Australia',   'institution'=>'Monash University',       'course'=>'Bachelor of IT',     'handler'=>'Priya H.',  'status'=>'enrolled',            'docs'=>'6/6','reg'=>'05 Jul 2026','source'=>'referral'],
                    ['id'=>'CON-0083','name'=>'Chamari Dias',           'nic'=>'199905678901','phone'=>'078 345 6789','country'=>'UK',          'institution'=>'UCL London',              'course'=>'MSc Data Science',   'handler'=>'Priya H.',  'status'=>'visa_processing',     'docs'=>'6/6','reg'=>'20 Jul 2026','source'=>'walk-in'],
                    ['id'=>'CON-0082','name'=>'Roshan Wijesinghe',      'nic'=>'200201034567','phone'=>'077 456 7891','country'=>'Canada',      'institution'=>'TBC',                     'course'=>'TBC',                'handler'=>'Kasun B.',  'status'=>'registered',          'docs'=>'0/6','reg'=>'06 Oct 2026','source'=>'walk-in'],
                    ['id'=>'CON-0081','name'=>'Pradeep Fernando',       'nic'=>'199407125678','phone'=>'071 567 8901','country'=>'USA',         'institution'=>'Univ. of Massachusetts', 'course'=>'BS Computer Science','handler'=>'Amila P.',  'status'=>'shortlisted',         'docs'=>'5/6','reg'=>'10 Aug 2026','source'=>'agent'],
                    ['id'=>'CON-0080','name'=>'Indika Chandrasena',     'nic'=>'199109087654','phone'=>'070 678 9012','country'=>'Australia',   'institution'=>'Deakin University',       'course'=>'Graduate Diploma',   'handler'=>'Nimal J.',  'status'=>'applied',             'docs'=>'6/6','reg'=>'15 Jun 2026','source'=>'referral'],
                ];
                @endphp
                @foreach($students as $s)
                @php
                $avatarColors = ['indigo','emerald','violet','amber','cyan','rose'];
                $aColor = $avatarColors[array_sum(array_map('ord',str_split($s['id']))) % 6];
                @endphp
                <tr class="stu-row" data-status="{{ $s['status'] }}" data-handler="{{ strtolower(explode(' ',$s['handler'])[0]) }}" data-source="{{ $s['source'] }}" data-country="{{ strtolower($s['country']) }}">
                    <td><input type="checkbox" class="stu-check form-input" style="width:16px;height:16px;padding:0"></td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar avatar-sm avatar-{{ $aColor }}">{{ strtoupper(substr($s['name'],0,1).substr(strstr($s['name'],' '),1,1)) }}</div>
                            <div>
                                <a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s['name'] }}</a>
                                <p class="text-xs text-slate-400">{{ $s['id'] }} · {{ ucfirst(str_replace('-',' ',$s['source'])) }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-sm font-mono text-slate-600">{{ $s['nic'] }}</div>
                        <div class="text-xs text-slate-400">{{ $s['phone'] }}</div>
                    </td>
                    <td class="text-sm text-slate-600">{{ $s['country'] }}</td>
                    <td>
                        <div class="text-sm text-slate-700 font-medium">{{ $s['institution'] }}</div>
                        <div class="text-xs text-slate-400">{{ $s['course'] }}</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-1.5">
                            <div class="avatar avatar-sm avatar-violet">{{ substr($s['handler'],0,2) }}</div>
                            <span class="text-sm text-slate-600">{{ $s['handler'] }}</span>
                        </div>
                    </td>
                    <td><x-status-badge :status="$s['status']" /></td>
                    <td>
                        @php
                        $parts = explode('/',$s['docs']);
                        $pct = $parts[1]>0 ? ($parts[0]/$parts[1]*100) : 0;
                        @endphp
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium {{ $pct==100?'text-emerald-600':($pct==0?'text-rose-500':'text-amber-600') }}">{{ $s['docs'] }}</span>
                            <div class="progress-bar-track w-12">
                                <div class="progress-bar-fill {{ $pct==100?'bg-emerald-500':($pct==0?'bg-rose-500':'bg-amber-400') }}" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-xs text-slate-500 whitespace-nowrap">{{ $s['reg'] }}</td>
                    <td>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-ghost btn-xs" title="View"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            <div class="relative" x-data="{open:false}">
                                <button @click="open=!open" class="btn btn-ghost btn-xs" title="More"><i data-lucide="more-horizontal" style="width:13px;height:13px"></i></button>
                                <div x-show="open" @click.outside="open=false" x-transition class="absolute right-0 top-8 w-48 bg-white rounded-xl shadow-xl border border-slate-100 z-50 py-1" style="display:none">
                                    <a href="{{ route('consultancy.students.show',1) }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50"><i data-lucide="eye" style="width:12px;height:12px"></i>View Profile</a>
                                    <a href="{{ route('consultancy.counselling.create') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50"><i data-lucide="message-circle" style="width:12px;height:12px"></i>Add Counselling</a>
                                    <a href="{{ route('consultancy.applications.index') }}" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-700 hover:bg-slate-50"><i data-lucide="file-text" style="width:12px;height:12px"></i>Applications</a>
                                    <div class="border-t border-slate-100 my-1"></div>
                                    <a href="{{ route('consultancy.students.show',1) }}" class="flex items-center gap-2 px-3 py-2 text-xs text-rose-600 hover:bg-rose-50"><i data-lucide="x-circle" style="width:12px;height:12px"></i>Close Case</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <div class="text-sm text-slate-500">Showing 1–10 of 263 students</div>
        <div class="flex gap-1">
            <button class="btn btn-ghost btn-sm" disabled>← Prev</button>
            <button class="btn btn-primary btn-sm">1</button>
            <button class="btn btn-ghost btn-sm">2</button>
            <button class="btn btn-ghost btn-sm">3</button>
            <span class="px-2 py-1 text-slate-400 text-sm">…</span>
            <button class="btn btn-ghost btn-sm">14</button>
            <button class="btn btn-ghost btn-sm">Next →</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const searchInput   = document.getElementById('stu-search');
    const statusSelect  = document.getElementById('stu-status');
    const handlerSelect = document.getElementById('stu-handler');
    const sourceSelect  = document.getElementById('stu-source');
    const countrySelect = document.getElementById('stu-country');
    const clearBtn      = document.getElementById('stu-clear');
    const pills         = document.querySelectorAll('.filter-pill[data-pill]');
    const rows          = document.querySelectorAll('tbody tr.stu-row');

    function applyFilters() {
        const q       = (searchInput?.value  || '').toLowerCase();
        const status  = (statusSelect?.value || '').toLowerCase();
        const handler = (handlerSelect?.value|| '').toLowerCase();
        const source  = (sourceSelect?.value || '').toLowerCase();
        const country = (countrySelect?.value|| '').toLowerCase();
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const ok = (!q||text.includes(q))
                    && (!status||row.dataset.status.includes(status))
                    && (!handler||row.dataset.handler.includes(handler))
                    && (!source||row.dataset.source.includes(source))
                    && (!country||row.dataset.country.includes(country));
            row.style.display = ok ? '' : 'none';
        });
    }
    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            pills.forEach(p=>p.classList.remove('active'));
            pill.classList.add('active');
            if(statusSelect) statusSelect.value = pill.dataset.pill;
            applyFilters();
        });
    });
    searchInput?.addEventListener('input', applyFilters);
    statusSelect?.addEventListener('change', applyFilters);
    handlerSelect?.addEventListener('change', applyFilters);
    sourceSelect?.addEventListener('change', applyFilters);
    countrySelect?.addEventListener('change', applyFilters);
    clearBtn?.addEventListener('click', () => {
        [searchInput,statusSelect,handlerSelect,sourceSelect,countrySelect].forEach(el => { if(el) el.value=''; });
        pills.forEach(p=>p.classList.remove('active'));
        document.querySelector('.filter-pill[data-pill=""]')?.classList.add('active');
        applyFilters();
    });
    document.getElementById('stu-select-all')?.addEventListener('change', function() {
        document.querySelectorAll('.stu-check').forEach(cb=>cb.checked=this.checked);
    });
});
</script>
</x-layouts.app>
