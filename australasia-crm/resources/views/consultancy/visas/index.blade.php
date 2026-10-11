<x-layouts.app title="Visa Cases — Consultancy">

<x-page-header
    title="Visa Cases"
    subtitle="Student visa applications managed through the consultancy pipeline"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Visas']]">
    <x-slot:actions>
        <button onclick="openModal('new-visa-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Visa Case
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['18','Total Visa Cases','shield','indigo'],['8','Approved','check-circle','emerald'],['7','In Progress','clock','cyan'],['3','Rejected / Appealing','x-circle','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Visa Cases</h3>
        <div class="search-wrapper" style="width:240px">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" class="search-input" placeholder="Search student, country…">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>Visa ID</th><th>Student</th><th>Visa Type</th><th>Country</th><th>Institution</th><th>Submitted</th><th>Handler</th><th>Status</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $visas=[
                    ['id'=>'VIS-CON-0089','student'=>'Sachini Ranasinghe','sid'=>'CON-0089','type'=>'Student Visa (Subclass 500)','country'=>'Australia','institution'=>'Monash University','submitted'=>'10 Oct 2026','handler'=>'Priya H.','status'=>'visa_approved'],
                    ['id'=>'VIS-CON-0088','student'=>'Kavinda Gunasekara','sid'=>'CON-0088','type'=>'Student Visa (Tier 4)','country'=>'UK','institution'=>'Univ. of Manchester','submitted'=>'05 Oct 2026','handler'=>'Amila P.','status'=>'visa_processing'],
                    ['id'=>'VIS-CON-0083','student'=>'Chamari Dias','sid'=>'CON-0083','type'=>'Student Visa (Tier 4)','country'=>'UK','institution'=>'UCL London','submitted'=>'01 Oct 2026','handler'=>'Priya H.','status'=>'visa_processing'],
                    ['id'=>'VIS-CON-0080','student'=>'Indika Chandrasena','sid'=>'CON-0080','type'=>'Student Visa (Subclass 500)','country'=>'Australia','institution'=>'Deakin University','submitted'=>'15 Jul 2026','handler'=>'Nimal J.','status'=>'visa_approved'],
                    ['id'=>'VIS-CON-0079','student'=>'Ruwan Bandara','sid'=>'CON-0084','type'=>'Student Visa (Subclass 500)','country'=>'Australia','institution'=>'Monash University','submitted'=>'01 Aug 2026','handler'=>'Priya H.','status'=>'visa_approved'],
                    ['id'=>'VIS-CON-0075','student'=>'Nilmini Senanayake','sid'=>'CON-0074','type'=>'Student Visa (Study Permit)','country'=>'Canada','institution'=>'McMaster University','submitted'=>'15 Sep 2026','handler'=>'Kasun B.','status'=>'visa_processing'],
                    ['id'=>'VIS-CON-0070','student'=>'Jehan Wickramaratne','sid'=>'CON-0069','type'=>'Student Visa (F-1)','country'=>'USA','institution'=>'Univ. of Massachusetts','submitted'=>'10 Sep 2026','handler'=>'Nimal J.','status'=>'rejected'],
                ];
                @endphp
                @foreach($visas as $visa)
                <tr>
                    <td><a href="{{ route('consultancy.visas.show',1) }}" class="text-sm font-semibold text-indigo-600">{{ $visa['id'] }}</a></td>
                    <td>
                        <a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $visa['student'] }}</a>
                        <p class="text-xs text-slate-400">{{ $visa['sid'] }}</p>
                    </td>
                    <td class="text-sm text-slate-600">{{ $visa['type'] }}</td>
                    <td class="text-sm text-slate-600">{{ $visa['country'] }}</td>
                    <td class="text-sm text-slate-600">{{ $visa['institution'] }}</td>
                    <td class="text-xs text-slate-500">{{ $visa['submitted'] }}</td>
                    <td><div class="flex items-center gap-1.5"><div class="avatar avatar-sm avatar-violet">{{ substr($visa['handler'],0,2) }}</div><span class="text-sm text-slate-600">{{ $visa['handler'] }}</span></div></td>
                    <td><x-status-badge :status="$visa['status']" /></td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('consultancy.visas.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            <button onclick="openModal('update-visa-modal')" class="btn btn-primary btn-xs">Update</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- New Visa Modal --}}
<div id="new-visa-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:500px">
        <div class="modal-header"><span class="modal-title">Create Visa Case</span><button onclick="closeModal('new-visa-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.visas.store') }}">
            @csrf
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2">
                        <label class="form-label required">Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">Select student</option>
                            <option value="CON-0089">CON-0089 — Sachini Ranasinghe</option>
                            <option value="CON-0088">CON-0088 — Kavinda Gunasekara</option>
                            <option value="CON-0083">CON-0083 — Chamari Dias</option>
                        </select>
                    </div>
                    <div class="form-group col-span-2"><label class="form-label required">Linked Offer ID</label><input name="offer_id" type="text" class="form-input" placeholder="e.g. OFR-CON-0011" required></div>
                    <div class="form-group">
                        <label class="form-label required">Visa Type</label>
                        <select name="visa_type" class="form-select" required>
                            <option value="Student Visa Subclass 500">Australia — Subclass 500</option>
                            <option value="Tier 4 Student Visa">UK — Tier 4</option>
                            <option value="Study Permit">Canada — Study Permit</option>
                            <option value="F-1 Student Visa">USA — F-1</option>
                            <option value="Student Visa NZ">New Zealand — Student Visa</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Country</label><input name="country" type="text" class="form-input" placeholder="e.g. Australia" required></div>
                    <div class="form-group col-span-2"><label class="form-label required">Submission Date</label><input name="submission_date" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('new-visa-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Create Visa Case</button>
            </div>
        </form>
    </div>
</div>

{{-- Update Visa Modal --}}
<div id="update-visa-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Update Visa Status</span><button onclick="closeModal('update-visa-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.visas.update-status',1) }}" x-data="{status:''}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group">
                    <label class="form-label required">New Status</label>
                    <select name="status" class="form-select" required x-model="status">
                        <option value="visa_processing">In Processing</option>
                        <option value="visa_approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div x-show="status==='rejected'" class="form-group" style="display:none">
                    <label class="form-label required">Can Student Reapply?</label>
                    <select name="can_reapply" class="form-select">
                        <option value="yes">Yes — Grounds for reapplication</option>
                        <option value="no">No — Final rejection</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes / Reference</label>
                    <textarea name="notes" rows="3" class="form-textarea" placeholder="e.g. Visa reference number, rejection reason, next steps…"></textarea>
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
