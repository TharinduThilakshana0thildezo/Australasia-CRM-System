<x-layouts.app title="Application Detail — Consultancy">

<x-page-header
    title="Application: APP-CON-0089"
    subtitle="Sachini Ranasinghe → Monash University — Bachelor of IT"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.applications.index'),'label'=>'Applications'],['url'=>'#','label'=>'APP-CON-0089']]">
    <x-slot:actions>
        <button onclick="openModal('update-status-modal')" class="btn btn-secondary btn-sm">
            <i data-lucide="edit" style="width:14px;height:14px"></i>Update Status
        </button>
        <a href="{{ route('consultancy.offers.index') }}" class="btn btn-primary btn-sm">
            <i data-lucide="inbox" style="width:14px;height:14px"></i>Record Offer
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Application Details</h3><x-status-badge status="offer_received" /></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['Application ID','APP-CON-0089'],['Student','Sachini Ranasinghe (CON-0089)'],
                        ['Institution','Monash University'],['Course','Bachelor of Information Technology'],
                        ['Country','Australia'],['Intake','February 2027'],
                        ['Submitted','10 Sep 2026'],['Handled By','Priya Hewage'],
                    ] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Offer Received — Unconditional</h3><x-status-badge status="approved" /></div>
            <div class="card-body">
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-4">
                    <p class="font-bold text-emerald-800">🎉 Unconditional Offer Received</p>
                    <p class="text-sm text-emerald-600 mt-1">Monash University has issued an unconditional offer letter for Bachelor of IT — Feb 2027 intake.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                    <div><p class="text-xs text-slate-400">Offer Type</p><p class="font-semibold mt-0.5">Unconditional</p></div>
                    <div><p class="text-xs text-slate-400">Offer Date</p><p class="font-semibold mt-0.5">25 Sep 2026</p></div>
                    <div><p class="text-xs text-slate-400">Acceptance Deadline</p><p class="font-semibold text-rose-600 mt-0.5">30 Nov 2026</p></div>
                    <div><p class="text-xs text-slate-400">Student Decision</p><p class="font-semibold text-emerald-600 mt-0.5">Accepted ✓</p></div>
                </div>
                <div class="mt-4 flex gap-2">
                    <button class="btn btn-ghost btn-sm"><i data-lucide="download" style="width:13px;height:13px"></i>Offer Letter</button>
                    <button class="btn btn-ghost btn-sm"><i data-lucide="download" style="width:13px;height:13px"></i>Acceptance Confirmation</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Application Timeline</h3></div>
            <div class="card-body">
                <div class="timeline">
                    @foreach([
                        ['success','✓','Offer Accepted by Student','02 Oct 2026','Acceptance submitted via university portal'],
                        ['success','✓','Unconditional Offer Received from Monash University','25 Sep 2026','Offer letter issued: Bachelor of IT — Feb 2027'],
                        ['success','✓','Application Submitted','10 Sep 2026','Application submitted online via Monash Apply portal'],
                        ['success','✓','Application Prepared','08 Sep 2026','Documents compiled: transcript, IELTS, CV, personal statement'],
                        ['info','+','Application Initiated','05 Sep 2026','Study plan agreed. Monash selected as first choice.'],
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

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Student</h3></div>
            <div class="card-body">
                <div class="flex items-center gap-3 mb-3">
                    <div class="avatar avatar-md avatar-violet">SR</div>
                    <div>
                        <a href="{{ route('consultancy.students.show',1) }}" class="font-bold text-slate-800 hover:text-indigo-600">Sachini Ranasinghe</a>
                        <p class="text-xs text-slate-400">CON-0089</p>
                    </div>
                </div>
                <div class="space-y-1.5 text-sm">
                    <div class="flex gap-2"><span class="text-slate-400 w-24">IELTS</span><span class="font-medium">6.5</span></div>
                    <div class="flex gap-2"><span class="text-slate-400 w-24">Destination</span><span class="font-medium">Australia</span></div>
                    <div class="flex gap-2"><span class="text-slate-400 w-24">Budget</span><span class="font-medium">AUD 28,000</span></div>
                    <div class="flex gap-2"><span class="text-slate-400 w-24">Consultant</span><span class="font-medium">Priya Hewage</span></div>
                </div>
                <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-outline btn-sm w-full mt-3">View Student Profile</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Next Steps</h3></div>
            <div class="card-body space-y-2 text-sm">
                <div class="flex items-center gap-2 text-emerald-600"><i data-lucide="check" style="width:14px;height:14px"></i>Offer accepted</div>
                <div class="flex items-center gap-2 text-emerald-600"><i data-lucide="check" style="width:14px;height:14px"></i>Visa case created</div>
                <div class="flex items-center gap-2 text-amber-600"><i data-lucide="clock" style="width:14px;height:14px"></i>Post-visa registration pending</div>
                <div class="flex items-center gap-2 text-slate-400"><i data-lucide="circle" style="width:14px;height:14px"></i>Final payment</div>
                <div class="flex items-center gap-2 text-slate-400"><i data-lucide="circle" style="width:14px;height:14px"></i>Enrollment confirmation</div>
                <a href="{{ route('consultancy.visas.index') }}" class="btn btn-primary btn-sm w-full mt-2">View Visa Case</a>
            </div>
        </div>
    </div>
</div>

{{-- Update Status Modal --}}
<div id="update-status-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Update Application Status</span><button onclick="closeModal('update-status-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.applications.update-status',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group">
                    <label class="form-label required">New Status</label>
                    <select name="status" class="form-select" required>
                        <option value="submitted">Submitted</option>
                        <option value="conditional_offer">Conditional Offer</option>
                        <option value="offer_received" selected>Unconditional Offer</option>
                        <option value="approved">Accepted</option>
                        <option value="rejected">Rejected</option>
                        <option value="withdrawn">Withdrawn</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-textarea"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('update-status-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
