<x-layouts.app title="Visa Case — VIS-CON-0089">

<x-page-header
    title="Visa Case: VIS-CON-0089"
    subtitle="Sachini Ranasinghe → Australia Student Visa (Subclass 500)"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.visas.index'),'label'=>'Visa Cases'],['url'=>'#','label'=>'VIS-CON-0089']]">
    <x-slot:actions>
        <button onclick="openModal('update-visa-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="edit" style="width:14px;height:14px"></i>Update Status
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Visa Details</h3><x-status-badge status="visa_approved" /></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['Visa Case ID','VIS-CON-0089'],['Student','Sachini Ranasinghe (CON-0089)'],
                        ['Visa Type','Student Visa (Subclass 500)'],['Country','Australia'],
                        ['Institution','Monash University'],['Linked Offer','OFR-CON-0011'],
                        ['Submitted','10 Oct 2026'],['Approved','06 Oct 2026'],
                        ['Visa Reference','AU-STV-500-2026-00319'],['Handler','Priya Hewage'],
                    ] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Visa Document Checklist</h3><span class="badge badge-approved">9/9 Complete</span></div>
            <div class="card-body">
                @foreach(['Passport (valid 6+ months)','Visa Application Form','Offer Letter from Monash','Financial Evidence (bank statements)','IELTS Score Report','Enrollment & Tuition Fee Payment Receipt','Accommodation Proof','Health Insurance Certificate','Photograph (passport-size)'] as $doc)
                <div class="flex items-center gap-2 py-2 border-b border-slate-50 last:border-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" fill="#d1fae5"/><polyline points="20 6 9 17 4 12" stroke="#059669"></polyline></svg>
                    <span class="text-sm text-emerald-800">{{ $doc }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Visa Timeline</h3></div>
            <div class="card-body">
                <div class="timeline">
                    @foreach([
                        ['success','✓','Visa Approved — Subclass 500','06 Oct 2026 · 10:14 AM','Reference: AU-STV-500-2026-00319. Student notified immediately.'],
                        ['success','✓','Visa Application Submitted via ImmiAccount','03 Oct 2026','All 9 documents compiled and submitted online.'],
                        ['success','✓','Document Checklist Verified','01 Oct 2026','All 9 required documents reviewed and approved by Priya Hewage.'],
                        ['success','✓','Visa Case Created','02 Oct 2026','Initiated after offer acceptance — Monash unconditional offer accepted.'],
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
                    <div class="flex gap-2"><span class="text-slate-400 w-24">NIC</span><span class="font-mono font-medium">199608203421</span></div>
                    <div class="flex gap-2"><span class="text-slate-400 w-24">Passport</span><span class="font-mono font-medium">N98765432</span></div>
                    <div class="flex gap-2"><span class="text-slate-400 w-24">Destination</span><span class="font-medium">Australia</span></div>
                </div>
                <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-outline btn-sm w-full mt-3">View Student Profile</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Next Steps</h3></div>
            <div class="card-body space-y-2 text-sm">
                <div class="flex items-center gap-2 text-emerald-600"><i data-lucide="check" style="width:14px;height:14px"></i>Visa approved</div>
                <div class="flex items-center gap-2 text-amber-600"><i data-lucide="clock" style="width:14px;height:14px"></i>Post-visa registration checklist</div>
                <div class="flex items-center gap-2 text-slate-400"><i data-lucide="circle" style="width:14px;height:14px"></i>Final payment</div>
                <div class="flex items-center gap-2 text-slate-400"><i data-lucide="circle" style="width:14px;height:14px"></i>Enrollment confirmation</div>
                <a href="{{ route('consultancy.registrations.index') }}" class="btn btn-primary btn-sm w-full mt-2">Go to Registration Checklist →</a>
            </div>
        </div>
    </div>
</div>

{{-- Update Visa Modal --}}
<div id="update-visa-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Update Visa Status</span><button onclick="closeModal('update-visa-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.visas.update-status',1) }}" x-data="{status:'visa_processing'}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">New Status</label>
                    <select name="status" class="form-select" required x-model="status">
                        <option value="visa_processing">In Processing</option>
                        <option value="visa_approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div x-show="status==='rejected'" class="form-group" style="display:none">
                    <label class="form-label required">Can Student Reapply?</label>
                    <select name="can_reapply" class="form-select"><option value="yes">Yes — Grounds for reapplication</option><option value="no">No — Final rejection</option></select>
                </div>
                <div class="form-group"><label class="form-label">Notes / Reference Number</label>
                    <textarea name="notes" rows="3" class="form-textarea" placeholder="Approval reference, rejection reason, next steps…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('update-visa-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Visa</button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
