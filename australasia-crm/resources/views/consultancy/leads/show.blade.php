<x-layouts.app title="Lead Detail — Consultancy">

<x-page-header
    title="Lead: Nimasha Pathirana"
    subtitle="LEAD-0022 · New Enquiry · Walk-in"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.leads.index'),'label'=>'Leads'],['url'=>'#','label'=>'LEAD-0022']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>Convert to Student
        </a>
        <button class="btn btn-ghost btn-sm" onclick="openModal('gen-link-modal')">
            <i data-lucide="link" style="width:14px;height:14px"></i>Generate Reg. Link
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Lead Details</h3><x-status-badge status="lead" /></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['Name','Nimasha Pathirana'],['Phone','077 123 4500'],['Email','nimasha@gmail.com'],
                        ['Preferred Country','Australia'],['Preferred Course','Bachelor of IT'],
                        ['Enquiry Date','10 Oct 2026'],['Source','Walk-in'],['Assigned To','Priya Hewage'],
                    ] as $r)
                    <div>
                        <p class="text-xs text-slate-400 font-medium">{{ $r[0] }}</p>
                        <p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="text-xs font-semibold text-slate-400 uppercase mb-1">Enquiry Notes</p>
                    <p class="text-sm text-slate-600">Student is fresh out of A/L (Science stream). Looking to study IT in Australia for March 2027 intake. Budget ~LKR 6M. Parents supportive. Needs IELTS preparation guidance. Very enthusiastic.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Next Steps</h3></div>
            <div class="card-body space-y-3">
                <div class="alert alert-info text-sm">
                    <i data-lucide="info" style="width:16px;height:16px;flex-shrink:0"></i>
                    <span>This lead has not yet been converted to a student profile. Choose an entry route below.</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="border border-indigo-200 rounded-xl p-4 bg-indigo-50/50">
                        <h4 class="font-semibold text-slate-800 mb-1 flex items-center gap-2"><i data-lucide="user-plus" style="width:16px;height:16px;color:#6366f1"></i>Direct Registration</h4>
                        <p class="text-xs text-slate-500 mb-3">Consultant enters student details directly. No link required.</p>
                        <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm w-full">Register Student Now</a>
                    </div>
                    <div class="border border-violet-200 rounded-xl p-4 bg-violet-50/50">
                        <h4 class="font-semibold text-slate-800 mb-1 flex items-center gap-2"><i data-lucide="link" style="width:16px;height:16px;color:#8b5cf6"></i>Self-Registration Link</h4>
                        <p class="text-xs text-slate-500 mb-3">Generate a secure, single-use, expiring link for the student.</p>
                        <button onclick="openModal('gen-link-modal')" class="btn btn-outline btn-sm w-full">Generate Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Contact Timeline</h3></div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot-info">+</div>
                        <div class="timeline-content">
                            <div class="timeline-title">Lead Received</div>
                            <div class="timeline-meta">10 Oct 2026 · Walk-in</div>
                            <div class="timeline-body">Student walked in at 9:22 AM. Initial enquiry captured by Priya Hewage.</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('consultancy.students.create') }}" class="btn btn-primary btn-sm w-full mt-3">Convert & Register</a>
            </div>
        </div>
    </div>
</div>

{{-- Generate Registration Link Modal --}}
<div id="gen-link-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:500px">
        <div class="modal-header">
            <span class="modal-title">Generate Secure Registration Link</span>
            <button onclick="closeModal('gen-link-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button>
        </div>
        <form method="POST" action="{{ route('consultancy.registration-links.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-info text-sm">
                    <i data-lucide="shield" style="width:16px;height:16px;flex-shrink:0"></i>
                    <span>Link will be random, difficult to guess, single-use, and expiring. Token is stored as a hash. Never share sensitive data in the URL.</span>
                </div>
                <div class="form-group">
                    <label class="form-label required">Lead / Student ID</label>
                    <input name="lead_id" type="text" class="form-input" value="LEAD-0022" required>
                </div>
                <div class="form-group">
                    <label class="form-label required">Expires In (days)</label>
                    <select name="expires_in" class="form-select" required>
                        <option value="3">3 days</option>
                        <option value="7" selected>7 days</option>
                        <option value="14">14 days</option>
                        <option value="30">30 days</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <input name="link_notes" type="text" class="form-input" placeholder="e.g. Sent via WhatsApp on 10 Oct">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('gen-link-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary"><i data-lucide="link" style="width:14px;height:14px"></i>Generate Link</button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
