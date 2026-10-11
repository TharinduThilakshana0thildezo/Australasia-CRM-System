<x-layouts.app title="Sachini Ranasinghe — Student Profile">

<x-page-header
    title="Sachini Ranasinghe"
    subtitle="CON-0089 · Consultancy Student"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.students.index'),'label'=>'Students'],['url'=>'#','label'=>'Sachini Ranasinghe']]">
    <x-slot:actions>
        <button class="btn btn-ghost btn-sm" onclick="openModal('assign-modal')">
            <i data-lucide="user-cog" style="width:14px;height:14px"></i>Reassign
        </button>
        <button class="btn btn-secondary btn-sm" onclick="openModal('upload-doc-modal')">
            <i data-lucide="upload" style="width:14px;height:14px"></i>Upload Doc
        </button>
        <div class="relative" x-data="{open:false}">
            <button @click="open=!open" class="btn btn-primary btn-sm">
                Actions <i data-lucide="chevron-down" style="width:14px;height:14px"></i>
            </button>
            <div x-show="open" @click.outside="open=false" x-transition class="absolute right-0 top-10 w-56 bg-white rounded-xl shadow-xl border border-slate-100 z-50 py-1" style="display:none">
                <a href="{{ route('consultancy.counselling.create') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"><i data-lucide="message-circle" style="width:14px;height:14px"></i>Add Counselling Session</a>
                <a href="{{ route('consultancy.applications.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"><i data-lucide="file-text" style="width:14px;height:14px"></i>Create Application</a>
                <a href="{{ route('consultancy.offers.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"><i data-lucide="inbox" style="width:14px;height:14px"></i>Record Offer</a>
                <a href="{{ route('consultancy.visas.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"><i data-lucide="shield" style="width:14px;height:14px"></i>Create Visa Case</a>
                <a href="{{ route('consultancy.payments.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"><i data-lucide="credit-card" style="width:14px;height:14px"></i>Record Payment</a>
                <div class="border-t border-slate-100 my-1"></div>
                <button onclick="openModal('close-case-modal')" class="flex items-center gap-2 px-4 py-2.5 text-sm text-rose-600 hover:bg-rose-50 w-full text-left"><i data-lucide="x-circle" style="width:14px;height:14px"></i>Close Case</button>
            </div>
        </div>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

{{-- ========== PROFILE HEADER CARD ========== --}}
<div class="card mb-5">
    <div class="card-body">
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex items-start gap-4 flex-shrink-0">
                <div class="avatar avatar-xl avatar-violet text-2xl">SR</div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Sachini Dilrukshi Ranasinghe</h2>
                    <p class="text-sm text-slate-500 font-mono mt-0.5">CON-0089</p>
                    <div class="flex flex-wrap items-center gap-2 mt-2">
                        <x-status-badge status="visa_approved" />
                        <span class="stream-badge stream-consultancy"><i data-lucide="graduation-cap" style="width:10px;height:10px"></i> Consultancy</span>
                        <span class="stream-badge stream-employment"><i data-lucide="briefcase" style="width:10px;height:10px"></i> Emp (linked)</span>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div><p class="text-xs text-slate-400 font-medium">NIC</p><p class="text-sm font-semibold text-slate-800 font-mono mt-0.5">199608203421</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Phone</p><p class="text-sm font-semibold text-slate-800 mt-0.5">077 234 5678</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Email</p><p class="text-sm font-semibold text-slate-800 mt-0.5 truncate">sachini@gmail.com</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Destination</p><p class="text-sm font-semibold text-slate-800 mt-0.5">Australia 🇦🇺</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Consultant</p>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <div class="avatar avatar-sm avatar-violet">PH</div>
                            <span class="text-sm font-semibold text-slate-800">Priya Hewage</span>
                        </div>
                    </div>
                    <div><p class="text-xs text-slate-400 font-medium">Source</p><p class="text-sm font-semibold text-slate-800 mt-0.5">Walk-in</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Registered</p><p class="text-sm font-semibold text-slate-800 mt-0.5">01 Aug 2026</p></div>
                    <div><p class="text-xs text-slate-400 font-medium">Last Activity</p><p class="text-sm font-semibold text-slate-800 mt-0.5">08 Oct 2026</p></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ========== JOURNEY STEPPER ========== --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Consultancy Journey Progress</h3>
        <span class="text-xs text-slate-500">Current: <strong class="text-emerald-600">Visa Approved → Enrollment</strong></span>
    </div>
    <div class="card-body pt-2">
        <div class="stepper overflow-x-auto">
            @php
            $steps = [
                ['label'=>'Lead',         'done'=>true],
                ['label'=>'Registered',   'done'=>true],
                ['label'=>'Fee Paid',     'done'=>true],
                ['label'=>'Documents',    'done'=>true],
                ['label'=>'Counselling',  'done'=>true],
                ['label'=>'Shortlisted',  'done'=>true],
                ['label'=>'Applied',      'done'=>true],
                ['label'=>'Offer',        'done'=>true],
                ['label'=>'Visa',         'done'=>true],
                ['label'=>'Registration', 'done'=>false,'current'=>true],
                ['label'=>'Enrolled',     'done'=>false],
            ];
            @endphp
            @foreach($steps as $i => $step)
            <div class="stepper-step {{ $step['done']?'completed':'' }} {{ isset($step['current'])&&$step['current']?'current':'' }}">
                <div class="stepper-step-inner">
                    <div class="stepper-circle">
                        @if($step['done'])<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        @else{{ $i+1 }}@endif
                    </div>
                    <div class="stepper-label">{{ $step['label'] }}</div>
                </div>
            </div>
            @if(!$loop->last)
            <div class="stepper-line {{ $step['done']?'completed':'' }}"></div>
            @endif
            @endforeach
        </div>
    </div>
</div>

{{-- ========== TABS ========== --}}
<div x-data="{tab:'overview'}">
<div class="tabs-nav mb-5">
    <button @click="tab='overview'" :class="tab==='overview'?'active':''" class="tab-item">Overview</button>
    <button @click="tab='documents'" :class="tab==='documents'?'active':''" class="tab-item">Documents <span class="tab-count">6</span></button>
    <button @click="tab='counselling'" :class="tab==='counselling'?'active':''" class="tab-item">Counselling <span class="tab-count">3</span></button>
    <button @click="tab='shortlists'" :class="tab==='shortlists'?'active':''" class="tab-item">Shortlist <span class="tab-count">3</span></button>
    <button @click="tab='applications'" :class="tab==='applications'?'active':''" class="tab-item">Applications <span class="tab-count">2</span></button>
    <button @click="tab='offers'" :class="tab==='offers'?'active':''" class="tab-item">Offers <span class="tab-count">1</span></button>
    <button @click="tab='visa'" :class="tab==='visa'?'active':''" class="tab-item">Visa</button>
    <button @click="tab='registration'" :class="tab==='registration'?'active':''" class="tab-item">Registration</button>
    <button @click="tab='payments'" :class="tab==='payments'?'active':''" class="tab-item">Payments <span class="tab-count">2</span></button>
    <button @click="tab='activity'" :class="tab==='activity'?'active':''" class="tab-item">Activity</button>
</div>

{{-- TAB: OVERVIEW --}}
<div x-show="tab==='overview'">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Personal Information</h3><button class="btn btn-ghost btn-xs"><i data-lucide="pencil" style="width:12px;height:12px"></i></button></div>
            <div class="card-body space-y-3">
                @foreach([['Full Name','Sachini Dilrukshi Ranasinghe'],['Date of Birth','08 Jun 1996 (30 years)'],['Gender','Female'],['Email','sachini@gmail.com'],['Address','No. 12, Horana Road, Piliyandala'],['City','Piliyandala'],['District','Colombo']] as $item)
                <div class="flex gap-3"><span class="text-xs font-semibold text-slate-400 w-28 flex-shrink-0 pt-0.5">{{ $item[0] }}</span><span class="text-sm text-slate-700">{{ $item[1] }}</span></div>
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Academic Profile</h3><button class="btn btn-ghost btn-xs"><i data-lucide="pencil" style="width:12px;height:12px"></i></button></div>
            <div class="card-body space-y-3">
                @foreach([['Highest Qual.','A/L (Science Stream)'],['Study Goal','Bachelor of IT / Computer Science'],['Preferred Dest.','Australia 🇦🇺'],['Preferred Intake','March 2027'],['English Test','IELTS – 6.5'],['Budget','LKR 6,500,000 / AUD 28,000'],['Source','Walk-in']] as $item)
                <div class="flex gap-3"><span class="text-xs font-semibold text-slate-400 w-28 flex-shrink-0 pt-0.5">{{ $item[0] }}</span><span class="text-sm text-slate-700">{{ $item[1] }}</span></div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Registration Fee</h3><x-status-badge status="paid" /></div>
                <div class="card-body space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-slate-500">Amount</span><span class="font-bold text-slate-800">LKR 25,000</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Paid on</span><span class="font-semibold text-slate-700">05 Aug 2026</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Method</span><span class="font-semibold text-slate-700">Bank Transfer</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Receipt</span><span class="font-mono text-slate-700">RCP-CON-0041</span></div>
                    <div class="mt-2 p-2 bg-amber-50 border border-amber-100 rounded-lg text-xs text-amber-700">⚠ Refund policy for consultancy is pending owner confirmation. See Settings.</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header"><h3 class="card-title">Cross-Stream Links</h3></div>
                <div class="card-body space-y-2">
                    <a href="{{ route('employment.candidates.show',1) }}" class="stream-badge stream-employment no-underline flex items-center gap-2 p-2 rounded-lg hover:opacity-80">
                        <i data-lucide="briefcase" style="width:14px;height:14px"></i>
                        <span>Foreign Employment — CAND-1297</span>
                    </a>
                    <p class="text-xs text-slate-400">Linked by NIC. No data shared between modules.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TAB: DOCUMENTS --}}
<div x-show="tab==='documents'" style="display:none">
    <div class="card mb-5">
        <div class="card-header">
            <div><h3 class="card-title">Documents</h3><p class="text-xs text-slate-500 mt-0.5">6 of 6 required documents uploaded — 5 approved, 1 pending review</p></div>
            <button onclick="openModal('upload-doc-modal')" class="btn btn-primary btn-sm"><i data-lucide="upload" style="width:14px;height:14px"></i>Upload Document</button>
        </div>
        <div class="card-body">
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-5 flex items-center gap-3">
                <svg class="text-emerald-600 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="20 6 9 17 4 12"></polyline></svg>
                <div><p class="font-bold text-emerald-800">5 documents approved · 1 under review</p><p class="text-sm text-emerald-600">Student is eligible to proceed to visa stage.</p></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                $docs=[
                    ['type'=>'NIC',                       'file'=>'nic_sachini_front.jpg',     'status'=>'approved',         'uploaded'=>'03 Aug 2026','rev'=>'Priya Hewage',  'col'=>'bg-blue-100 text-blue-600'],
                    ['type'=>'Passport',                  'file'=>'passport_sachini.pdf',      'status'=>'approved',         'uploaded'=>'03 Aug 2026','rev'=>'Priya Hewage',  'col'=>'bg-indigo-100 text-indigo-600'],
                    ['type'=>'CV / Resume',               'file'=>'cv_sachini_ranasinghe.pdf', 'status'=>'approved',         'uploaded'=>'04 Aug 2026','rev'=>'Priya Hewage',  'col'=>'bg-violet-100 text-violet-600'],
                    ['type'=>'Educational Certificates',  'file'=>'al_results_sachini.pdf + 2','status'=>'approved',         'uploaded'=>'05 Aug 2026','rev'=>'Kasun Bandara', 'col'=>'bg-emerald-100 text-emerald-600'],
                    ['type'=>'English Test Result',       'file'=>'ielts_sachini_2026.pdf',    'status'=>'approved',         'uploaded'=>'06 Aug 2026','rev'=>'Kasun Bandara', 'col'=>'bg-teal-100 text-teal-600'],
                    ['type'=>'Experience Letter',         'file'=>'exp_letter_2025.pdf',       'status'=>'under_review',     'uploaded'=>'07 Oct 2026','rev'=>'Pending',        'col'=>'bg-amber-100 text-amber-600'],
                ];
                @endphp
                @foreach($docs as $doc)
                <div class="doc-card">
                    <div class="doc-icon {{ $doc['col'] }}"><i data-lucide="file-text" style="width:20px;height:20px"></i></div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-semibold text-slate-800">{{ $doc['type'] }}</p>
                            <x-status-badge :status="$doc['status']" />
                        </div>
                        <p class="text-xs text-slate-500 mt-1 truncate">{{ $doc['file'] }}</p>
                        <div class="flex gap-3 text-xs text-slate-400 mt-1.5">
                            <span>Uploaded {{ $doc['uploaded'] }}</span>
                            <span>Reviewer: {{ $doc['rev'] }}</span>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-outline btn-xs"><i data-lucide="eye" style="width:11px;height:11px"></i>View</button>
                            <button class="btn btn-ghost btn-xs"><i data-lucide="download" style="width:11px;height:11px"></i></button>
                            @if($doc['status']==='under_review')
                            <button onclick="openModal('approve-doc-modal')" class="btn btn-success btn-xs"><i data-lucide="check" style="width:11px;height:11px"></i>Approve</button>
                            <button onclick="openModal('correct-doc-modal')" class="btn btn-danger btn-xs"><i data-lucide="alert-triangle" style="width:11px;height:11px"></i>Request Correction</button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- TAB: COUNSELLING --}}
<div x-show="tab==='counselling'" style="display:none">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Counselling Sessions</h3>
            <a href="{{ route('consultancy.counselling.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>New Session</a>
        </div>
        <div class="card-body space-y-4">
            @php
            $sessions=[
                ['date'=>'15 Aug 2026','consultant'=>'Priya Hewage','country'=>'Australia','course'=>'IT/Computer Science','plan_agreed'=>'No','notes'=>'Discussed study goals. Student prefers Australia. Budget confirmed at AUD 28,000. Shortlisted 3 universities. Follow-up booked.','outcome'=>'Follow-up scheduled'],
                ['date'=>'22 Aug 2026','consultant'=>'Priya Hewage','country'=>'Australia','course'=>'Bachelor of IT','plan_agreed'=>'No','notes'=>'Reviewed university options. Student keen on Monash. Budget still a concern for first choice. Adjusted shortlist.','outcome'=>'Shortlist revised'],
                ['date'=>'05 Sep 2026','consultant'=>'Priya Hewage','country'=>'Australia','course'=>'Bachelor of IT','plan_agreed'=>'Yes','notes'=>'Study plan agreed. Monash University confirmed as first choice. RMIT as backup. Proceeding to application.','outcome'=>'Study plan agreed ✓'],
            ];
            @endphp
            @foreach($sessions as $i => $s)
            <div class="border border-slate-200 rounded-xl p-4 {{ $s['plan_agreed']==='Yes' ? 'border-emerald-200 bg-emerald-50/30':'' }}">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-3 mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-sm font-bold text-slate-800">Session {{ $i+1 }}</span>
                            @if($s['plan_agreed']==='Yes')
                            <span class="badge badge-approved">Study Plan Agreed</span>
                            @else
                            <span class="badge badge-pending">Plan Not Yet Agreed</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500">{{ $s['date'] }} · {{ $s['consultant'] }}</p>
                    </div>
                    <div class="text-right text-xs text-slate-500">
                        <p>Country: <strong>{{ $s['country'] }}</strong></p>
                        <p>Course: <strong>{{ $s['course'] }}</strong></p>
                    </div>
                </div>
                <p class="text-sm text-slate-600 mb-2">{{ $s['notes'] }}</p>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-slate-400">Outcome:</span>
                    <span class="text-xs font-semibold text-slate-600">{{ $s['outcome'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- TAB: SHORTLISTS --}}
<div x-show="tab==='shortlists'" style="display:none">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Institution & Course Shortlist</h3>
            <button onclick="openModal('shortlist-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Add Option</button>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Institution</th><th>Course</th><th>Country</th><th>Intake</th><th>Est. Cost</th><th>Entry Req.</th><th>Suitability</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach([
                        ['Monash University','Bachelor of Information Technology','Australia','Feb 2027','AUD 32,000/yr','IELTS 6.5, A/L','High ✓','applied'],
                        ['RMIT University','Bachelor of IT (Hons)','Australia','Feb 2027','AUD 30,000/yr','IELTS 6.5, A/L','High ✓','open'],
                        ['Deakin University','Bachelor of Computer Science','Australia','Mar 2027','AUD 28,500/yr','IELTS 6.0, A/L','Good','open'],
                    ] as $sl)
                    <tr>
                        <td><span class="text-sm font-semibold text-slate-800">{{ $sl[0] }}</span></td>
                        <td class="text-sm text-slate-600">{{ $sl[1] }}</td>
                        <td class="text-sm text-slate-600">{{ $sl[2] }}</td>
                        <td class="text-sm text-slate-600">{{ $sl[3] }}</td>
                        <td class="text-sm text-slate-600">{{ $sl[4] }}</td>
                        <td class="text-xs text-slate-500">{{ $sl[5] }}</td>
                        <td class="text-xs font-semibold {{ $sl[6]==='High ✓'?'text-emerald-600':'text-amber-600' }}">{{ $sl[6] }}</td>
                        <td><x-status-badge :status="$sl[7]" /></td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('consultancy.institutions.index') }}" class="btn btn-outline btn-xs">View</a>
                                <form method="POST" action="{{ route('consultancy.shortlists.remove',1) }}" onsubmit="return confirm('Remove this shortlist option?')">@csrf<button type="submit" class="btn btn-danger btn-xs">Remove</button></form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TAB: APPLICATIONS --}}
<div x-show="tab==='applications'" style="display:none">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Applications</h3>
            <a href="{{ route('consultancy.applications.index') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>New Application</a>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>App ID</th><th>Institution</th><th>Course</th><th>Intake</th><th>Submitted</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    @foreach([
                        ['APP-CON-0089','Monash University','Bachelor of IT','Feb 2027','10 Sep 2026','offer_received'],
                        ['APP-CON-0090','RMIT University','Bachelor of IT','Feb 2027','10 Sep 2026','submitted'],
                    ] as $app)
                    <tr>
                        <td><a href="{{ route('consultancy.applications.show',1) }}" class="text-sm font-semibold text-indigo-600">{{ $app[0] }}</a></td>
                        <td class="text-sm text-slate-700">{{ $app[1] }}</td>
                        <td class="text-sm text-slate-600">{{ $app[2] }}</td>
                        <td class="text-sm text-slate-600">{{ $app[3] }}</td>
                        <td class="text-xs text-slate-500">{{ $app[4] }}</td>
                        <td><x-status-badge :status="$app[5]" /></td>
                        <td><a href="{{ route('consultancy.applications.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TAB: OFFERS --}}
<div x-show="tab==='offers'" style="display:none">
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Offers & Acceptance</h3>
            <a href="{{ route('consultancy.offers.index') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Record Offer</a>
        </div>
        <div class="card-body">
            <div class="border border-emerald-200 rounded-xl p-4 bg-emerald-50/50 mb-4">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-bold text-slate-800">Monash University — Bachelor of IT</p>
                        <p class="text-xs text-slate-500 mt-0.5">Offer received: 25 Sep 2026 · Deadline: 30 Nov 2026</p>
                    </div>
                    <span class="badge badge-approved">Unconditional Offer</span>
                </div>
                <div class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                    <div><p class="text-xs text-slate-400">Offer Type</p><p class="font-semibold mt-0.5">Unconditional</p></div>
                    <div><p class="text-xs text-slate-400">Student Decision</p><p class="font-semibold text-emerald-600 mt-0.5">Accepted ✓</p></div>
                    <div><p class="text-xs text-slate-400">Accepted On</p><p class="font-semibold mt-0.5">02 Oct 2026</p></div>
                    <div><p class="text-xs text-slate-400">Acceptance Method</p><p class="font-semibold mt-0.5">Acceptance Portal</p></div>
                </div>
                <div class="mt-3 flex gap-2">
                    <button class="btn btn-ghost btn-xs"><i data-lucide="download" style="width:12px;height:12px"></i>Offer Letter</button>
                    <button class="btn btn-ghost btn-xs"><i data-lucide="download" style="width:12px;height:12px"></i>Acceptance Confirmation</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TAB: VISA --}}
<div x-show="tab==='visa'" style="display:none">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Visa Case — VIS-CON-0089</h3>
            <x-status-badge status="visa_approved" />
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-sm">
                <div><p class="text-xs text-slate-400">Visa Type</p><p class="font-semibold mt-0.5">Student Visa (Subclass 500)</p></div>
                <div><p class="text-xs text-slate-400">Country</p><p class="font-semibold mt-0.5">Australia 🇦🇺</p></div>
                <div><p class="text-xs text-slate-400">Submitted</p><p class="font-semibold mt-0.5">10 Oct 2026</p></div>
                <div><p class="text-xs text-slate-400">Approved</p><p class="font-semibold text-emerald-600 mt-0.5">06 Oct 2026</p></div>
                <div><p class="text-xs text-slate-400">Reference</p><p class="font-mono font-semibold mt-0.5">AU-STV-500-2026-00319</p></div>
                <div><p class="text-xs text-slate-400">Handler</p><p class="font-semibold mt-0.5">Priya Hewage</p></div>
            </div>
            <h4 class="text-sm font-bold text-slate-700 mb-3">Visa Timeline</h4>
            <div class="timeline">
                @foreach([
                    ['success','✓','Visa Approved (Subclass 500)','06 Oct 2026 · 10:14 AM','Australia Student Visa approved. Reference: AU-STV-500-2026-00319'],
                    ['success','✓','Documents Compiled & Submitted','03 Oct 2026','All visa documents compiled. Submitted via ImmiAccount online portal.'],
                    ['success','✓','Visa Document Checklist Completed','01 Oct 2026','All 9 required visa documents verified and compiled.'],
                    ['success','✓','Offer Accepted — Visa Stage Initiated','02 Oct 2026','Unconditional offer from Monash University accepted.'],
                ] as $step)
                <div class="timeline-item">
                    <div class="timeline-dot timeline-dot-{{ $step[0] }}">{{ $step[1] }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">{{ $step[2] }}</div>
                        <div class="timeline-meta">{{ $step[3] }}</div>
                        <div class="timeline-body">{{ $step[4] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- TAB: REGISTRATION --}}
<div x-show="tab==='registration'" style="display:none">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Post-Visa Registration Checklist</h3>
            <span class="badge badge-pending">3/6 Completed</span>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-4">
                <i data-lucide="info" style="width:16px;height:16px;flex-shrink:0"></i>
                <span class="text-sm">All checklist items must be completed before enrollment can be confirmed. An authorized override is available with mandatory reason.</span>
            </div>
            <div class="space-y-3">
                @foreach([
                    ['done'=>true,  'item'=>'Student Visa Confirmation Received',         'completed_by'=>'Priya Hewage',   'completed_on'=>'08 Oct 2026'],
                    ['done'=>true,  'item'=>'Enrollment Offer/Acceptance Letter Filed',    'completed_by'=>'Priya Hewage',   'completed_on'=>'08 Oct 2026'],
                    ['done'=>true,  'item'=>'Accommodation Arranged / Confirmed',          'completed_by'=>'Student',        'completed_on'=>'09 Oct 2026'],
                    ['done'=>false, 'item'=>'University Online Enrollment Form Submitted', 'completed_by'=>'',               'completed_on'=>''],
                    ['done'=>false, 'item'=>'Tuition Fee First Installment Paid',          'completed_by'=>'',               'completed_on'=>''],
                    ['done'=>false, 'item'=>'Student ID Received from University',         'completed_by'=>'',               'completed_on'=>''],
                ] as $item)
                <div class="flex items-center gap-3 p-3 rounded-lg {{ $item['done'] ? 'bg-emerald-50 border border-emerald-100':'bg-slate-50 border border-slate-200' }}">
                    @if($item['done'])
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-emerald-500 flex-shrink-0"><circle cx="12" cy="12" r="10" fill="#d1fae5"/><polyline points="20 6 9 17 4 12" stroke="#059669"></polyline></svg>
                    @else
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2" class="flex-shrink-0"><circle cx="12" cy="12" r="10"></circle></svg>
                    @endif
                    <div class="flex-1">
                        <p class="text-sm font-medium {{ $item['done'] ? 'text-emerald-800':'text-slate-700' }}">{{ $item['item'] }}</p>
                        @if($item['done'])<p class="text-xs text-emerald-600">Completed by {{ $item['completed_by'] }} on {{ $item['completed_on'] }}</p>@endif
                    </div>
                    @if(!$item['done'])
                    <form method="POST" action="{{ route('consultancy.registrations.complete-item',1) }}">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ \Illuminate\Support\Str::slug($item['item']) }}">
                        <button type="submit" class="btn btn-outline btn-xs">Mark Complete</button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="mt-5 pt-5 border-t border-slate-100 flex gap-3">
                <form method="POST" action="{{ route('consultancy.registrations.complete',1) }}">
                    @csrf
                    <input type="hidden" name="completion_notes" value="All items confirmed complete by authorized consultant.">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Mark this registration complete? Proceed to final payment.')">Mark Registration Complete</button>
                </form>
                <button onclick="openModal('override-modal')" class="btn btn-danger">Override with Reason</button>
            </div>
        </div>
    </div>
</div>

{{-- TAB: PAYMENTS --}}
<div x-show="tab==='payments'" style="display:none">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Payments & Receipts</h3>
            <button onclick="openModal('payment-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Record Payment</button>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Payment ID</th><th>Type</th><th>Amount</th><th>Method</th><th>Date</th><th>Reference</th><th>Recorded By</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach([
                        ['PAY-CON-00041','Registration Fee','LKR 25,000','Bank Transfer','05 Aug 2026','REF-BT-2026-0841','Kasun Bandara','paid'],
                        ['PAY-CON-00089','Final Consultancy Fee','LKR 75,000','Card','08 Oct 2026','REF-CC-2026-1047','Finance Desk','paid'],
                    ] as $p)
                    <tr>
                        <td><span class="font-mono text-sm text-indigo-600">{{ $p[0] }}</span></td>
                        <td class="text-sm text-slate-700">{{ $p[1] }}</td>
                        <td class="text-sm font-bold text-slate-800">{{ $p[2] }}</td>
                        <td class="text-sm text-slate-600">{{ $p[3] }}</td>
                        <td class="text-xs text-slate-500">{{ $p[4] }}</td>
                        <td class="font-mono text-xs text-slate-500">{{ $p[5] }}</td>
                        <td class="text-sm text-slate-500">{{ $p[6] }}</td>
                        <td><x-status-badge :status="$p[7]" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="alert alert-info text-sm">
                <i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>
                Financial records are never deleted. Contact your director for any payment disputes.
            </div>
        </div>
    </div>
</div>

{{-- TAB: ACTIVITY --}}
<div x-show="tab==='activity'" style="display:none">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Activity & Audit Timeline</h3><span class="text-xs text-slate-500">All critical actions recorded</span></div>
        <div class="card-body">
            <div class="timeline">
                @foreach([
                    ['success','✓','Visa Approved — Australia Subclass 500','08 Oct 2026, 10:14 AM','by System','Reference: AU-STV-500-2026-00319'],
                    ['success','✓','Final consultancy payment recorded','08 Oct 2026','by Finance Desk','PAY-CON-00089 — LKR 75,000 — Card'],
                    ['success','✓','Offer accepted — Monash University, Bachelor of IT','02 Oct 2026','by Priya Hewage','Acceptance confirmation sent via portal'],
                    ['success','✓','Unconditional offer received from Monash University','25 Sep 2026','by Priya Hewage','Offer letter filed. Deadline: 30 Nov 2026'],
                    ['success','✓','Application submitted — Monash + RMIT','10 Sep 2026','by Priya Hewage','APP-CON-0089 and APP-CON-0090 created'],
                    ['success','✓','Study plan agreed — Counselling Session 3','05 Sep 2026','by Priya Hewage','Australia, IT confirmed. Proceeding to applications.'],
                    ['info','+','Counselling Session 2 completed','22 Aug 2026','by Priya Hewage','Shortlist revised. Deakin added.'],
                    ['info','+','Counselling Session 1 completed','15 Aug 2026','by Priya Hewage','Initial goals captured. 3 universities shortlisted.'],
                    ['success','✓','All documents approved','10 Aug 2026','by Kasun Bandara','6/6 documents reviewed and approved.'],
                    ['success','✓','Registration fee paid','05 Aug 2026','by Finance Desk','LKR 25,000 — Bank Transfer — RCP-CON-0041'],
                    ['info','+','Student profile created','01 Aug 2026','by Priya Hewage','Walk-in registration. Consultant: Priya Hewage.'],
                ] as $act)
                <div class="timeline-item">
                    <div class="timeline-dot timeline-dot-{{ $act[0] }}">{{ $act[1] }}</div>
                    <div class="timeline-content">
                        <div class="timeline-title">{{ $act[2] }}</div>
                        <div class="timeline-meta">{{ $act[3] }} · {{ $act[4] }}</div>
                        <div class="timeline-body">{{ $act[5] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</div>{{-- end x-data tab --}}

{{-- ========== MODALS ========== --}}

{{-- Upload Document Modal --}}
<div id="upload-doc-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:520px">
        <div class="modal-header">
            <span class="modal-title">Upload Document</span>
            <button onclick="closeModal('upload-doc-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button>
        </div>
        <form method="POST" action="{{ route('consultancy.students.documents.upload',1) }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group">
                    <label class="form-label required">Document Category</label>
                    <select name="category" class="form-select" required>
                        <option value="">Select category</option>
                        <option value="NIC">NIC</option>
                        <option value="Passport">Passport</option>
                        <option value="CV">CV / Resume</option>
                        <option value="Educational Certificates">Educational Certificates</option>
                        <option value="English Test Result">English Test Result (IELTS/PTE/TOEFL)</option>
                        <option value="Experience Letter">Experience / Service Letter</option>
                        <option value="Bank Statement">Bank Statement</option>
                        <option value="Reference Letter">Reference Letter</option>
                        <option value="Other">Other Supporting Document</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label required">File</label>
                    <div class="file-upload-area" onclick="document.getElementById('doc-file-upload').click()">
                        <i data-lucide="upload-cloud" style="width:32px;height:32px;color:#94a3b8;margin:0 auto 8px"></i>
                        <p class="text-sm font-medium text-slate-600">Click to select file or drag & drop</p>
                        <p class="text-xs text-slate-400 mt-1">PDF, JPG, PNG, DOC, DOCX — max 20MB</p>
                    </div>
                    <input id="doc-file-upload" name="document" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                    <div id="file-selected-name" class="text-xs text-indigo-600 mt-1 hidden"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="doc_notes" rows="2" class="form-textarea" placeholder="Optional notes about this document…"></textarea>
                </div>
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                    <strong>Security Notice:</strong> Files are stored privately. Only authorized staff can view or download documents. File will be validated server-side before storage.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('upload-doc-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary"><i data-lucide="upload" style="width:14px;height:14px"></i>Upload Document</button>
            </div>
        </form>
    </div>
</div>

{{-- Approve Doc Modal --}}
<div id="approve-doc-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Approve Document</span><button onclick="closeModal('approve-doc-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.documents.approve',1) }}">
            @csrf
            <div class="modal-body space-y-3">
                <p class="text-sm text-slate-600">Mark this document as approved. The student/case will proceed past this document check.</p>
                <div class="form-group">
                    <label class="form-label">Reviewer Notes (optional)</label>
                    <textarea name="reviewer_notes" rows="3" class="form-textarea" placeholder="Any comments about the document…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('approve-doc-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-success"><i data-lucide="check" style="width:14px;height:14px"></i>Approve Document</button>
            </div>
        </form>
    </div>
</div>

{{-- Correction Request Modal --}}
<div id="correct-doc-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Request Correction</span><button onclick="closeModal('correct-doc-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.documents.request-correction',1) }}">
            @csrf
            <div class="modal-body space-y-3">
                <p class="text-sm text-slate-600">Describe the correction required. The student/consultant will be notified and the case put on hold.</p>
                <div class="form-group">
                    <label class="form-label required">Correction Reason</label>
                    <textarea name="correction_reason" rows="4" class="form-textarea" placeholder="e.g. Document is blurry / expired / wrong document submitted…" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('correct-doc-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-danger"><i data-lucide="alert-triangle" style="width:14px;height:14px"></i>Request Correction</button>
            </div>
        </form>
    </div>
</div>

{{-- Assign Modal --}}
<div id="assign-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:400px">
        <div class="modal-header"><span class="modal-title">Reassign Consultant</span><button onclick="closeModal('assign-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.students.assign',1) }}">
            @csrf
            <div class="modal-body space-y-3">
                <div class="form-group">
                    <label class="form-label required">Assign To</label>
                    <select name="handler_id" class="form-select" required>
                        <option value="priya">Priya Hewage (current)</option>
                        <option value="kasun">Kasun Bandara</option>
                        <option value="nimal">Nimal Jayawardena</option>
                        <option value="amila">Amila Perera</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Reason</label>
                    <textarea name="reason" rows="2" class="form-textarea" placeholder="Reason for reassignment (optional, but recommended)…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('assign-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Reassign</button>
            </div>
        </form>
    </div>
</div>

{{-- Close Case Modal --}}
<div id="close-case-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:500px">
        <div class="modal-header"><span class="modal-title text-rose-700">Close Consultancy Case</span><button onclick="closeModal('close-case-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.students.close',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-warning">
                    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
                    <span class="text-sm">This will close the overall consultancy case. Individual application records, documents, and payments will be preserved. Reopening requires authorized access.</span>
                </div>
                <div class="form-group">
                    <label class="form-label required">Closure Type</label>
                    <select name="closure_type" class="form-select" required>
                        <option value="">Select reason type</option>
                        <option value="withdrawn">Student Withdrew</option>
                        <option value="visa_rejected">Visa Finally Rejected</option>
                        <option value="no_response">Unresponsive / No Response</option>
                        <option value="offer_declined">All Offers Declined</option>
                        <option value="financial">Financial Constraints</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label required">Closure Reason (detailed)</label>
                    <textarea name="closure_reason" rows="4" class="form-textarea" placeholder="Provide a clear reason for case closure. This will be recorded in the audit log…" required></textarea>
                </div>
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                    <strong>⚠ Registration Fee Treatment:</strong> Refund policy for consultancy registration fee on closure is pending owner confirmation. Do not apply or promise a refund without authorization.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('close-case-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-danger">Close Case Permanently</button>
            </div>
        </form>
    </div>
</div>

{{-- Payment Modal --}}
<div id="payment-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:500px">
        <div class="modal-header"><span class="modal-title">Record Payment</span><button onclick="closeModal('payment-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.payments.store') }}">
            @csrf
            <input type="hidden" name="student_id" value="CON-0089">
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2">
                        <label class="form-label required">Payment Type</label>
                        <select name="payment_type" class="form-select" required>
                            <option value="registration">Registration Fee</option>
                            <option value="final">Final Consultancy Fee</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Amount</label><input name="amount" type="number" min="0.01" step="0.01" class="form-input" placeholder="0.00" required></div>
                    <div class="form-group"><label class="form-label required">Currency</label>
                        <select name="currency" class="form-select" required>
                            <option value="LKR">LKR</option><option value="USD">USD</option><option value="AUD">AUD</option><option value="GBP">GBP</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Payment Method</label>
                        <select name="method" class="form-select" required>
                            <option value="cash">Cash</option><option value="Bank Transfer">Bank Transfer</option><option value="Card">Card</option><option value="Cheque">Cheque</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Date Paid</label><input name="paid_on" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                    <div class="form-group col-span-2"><label class="form-label">Reference / Receipt No.</label><input name="reference" type="text" class="form-input" placeholder="e.g. REF-BT-0001"></div>
                </div>
                <div class="alert alert-info mt-2 text-xs">Payment records are audited and cannot be deleted. Do not record without actual receipt or authorized manual confirmation.</div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('payment-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary"><i data-lucide="check" style="width:14px;height:14px"></i>Record Payment</button>
            </div>
        </form>
    </div>
</div>

{{-- Override Modal --}}
<div id="override-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:480px">
        <div class="modal-header"><span class="modal-title text-rose-700">Authorized Override</span><button onclick="closeModal('override-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.enrollment.override',1) }}">
            @csrf
            <div class="modal-body space-y-3">
                <div class="alert alert-danger">
                    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
                    <span class="text-sm">This override will bypass incomplete registration checklist items. This action is audited and requires a detailed reason.</span>
                </div>
                <div class="form-group">
                    <label class="form-label required">Mandatory Override Reason (minimum 20 characters)</label>
                    <textarea name="override_reason" rows="5" class="form-textarea" placeholder="Describe in detail why this override is necessary and who authorized it…" minlength="20" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('override-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-danger" onclick="return confirm('This override will be permanently recorded. Proceed?')">Apply Override (Audited)</button>
            </div>
        </form>
    </div>
</div>

{{-- Shortlist Modal --}}
<div id="shortlist-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:560px">
        <div class="modal-header"><span class="modal-title">Add to Shortlist</span><button onclick="closeModal('shortlist-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.shortlists.store') }}">
            @csrf
            <input type="hidden" name="student_id" value="CON-0089">
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2">
                        <label class="form-label required">Institution</label>
                        <select name="institution_id" class="form-select" required>
                            <option value="">Select institution</option>
                            <option value="monash">Monash University</option>
                            <option value="rmit">RMIT University</option>
                            <option value="deakin">Deakin University</option>
                            <option value="uom">University of Manchester</option>
                            <option value="ucl">UCL London</option>
                            <option value="toronto">Toronto Metropolitan University</option>
                        </select>
                    </div>
                    <div class="form-group col-span-2"><label class="form-label required">Course</label><input name="course" type="text" class="form-input" placeholder="e.g. Bachelor of IT" required></div>
                    <div class="form-group"><label class="form-label required">Country</label><input name="country" type="text" class="form-input" placeholder="e.g. Australia" required></div>
                    <div class="form-group"><label class="form-label required">Intake</label><input name="intake" type="text" class="form-input" placeholder="e.g. Feb 2027" required></div>
                    <div class="form-group"><label class="form-label required">Estimated Annual Cost</label><input name="estimated_cost" type="number" min="0" class="form-input" placeholder="30000" required></div>
                    <div class="form-group"><label class="form-label required">Currency</label>
                        <select name="currency" class="form-select" required><option value="AUD">AUD</option><option value="GBP">GBP</option><option value="CAD">CAD</option><option value="USD">USD</option><option value="NZD">NZD</option></select>
                    </div>
                    <div class="form-group col-span-2"><label class="form-label">Entry Requirements</label><input name="entry_requirements" type="text" class="form-input" placeholder="e.g. IELTS 6.5, A/L or equivalent"></div>
                    <div class="form-group col-span-2"><label class="form-label">Notes</label><textarea name="notes" rows="2" class="form-textarea" placeholder="Suitability notes, pros/cons…"></textarea></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('shortlist-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Add to Shortlist</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    // File input display
    document.getElementById('doc-file-upload')?.addEventListener('change', function() {
        const nameDiv = document.getElementById('file-selected-name');
        if(this.files.length > 0) {
            nameDiv.textContent = '📎 ' + this.files[0].name;
            nameDiv.classList.remove('hidden');
        }
    });
});
</script>
</x-layouts.app>
