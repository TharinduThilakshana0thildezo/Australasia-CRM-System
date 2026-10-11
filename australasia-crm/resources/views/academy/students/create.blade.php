<x-layouts.app title="Register Student — Academy">

<x-page-header
    title="Register Student"
    subtitle="Direct or walk-in student registration with duplicate detection"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.students.index'),'label'=>'Students'],['url'=>'#','label'=>'Register']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Fix the following errors:</strong><ul class="mt-1">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.students.store') }}" x-data="{
    nic:'', phone:'', duplicateNICs:['199812304512','200012308944','199703201234'],
    get nicMatch(){ return this.nic.length>=9 && this.duplicateNICs.includes(this.nic); },
    source:'',
}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Personal Information</h3></div>
            <div class="card-body">
                {{-- NIC Duplicate Check --}}
                <div class="form-group mb-4">
                    <label class="form-label required" for="nic">NIC Number</label>
                    <input id="nic" name="nic" type="text" class="form-input" x-model="nic" value="{{ old('nic') }}" placeholder="e.g. 199812304512 or 981230451V" required>
                    <div x-show="nicMatch" x-transition class="mt-2 p-3 bg-amber-50 border border-amber-300 rounded-xl text-sm text-amber-800">
                        <strong>⚠ Existing profile found for this NIC.</strong>
                        Verify with the student before creating a new record.
                        <a href="{{ route('academy.students.index') }}" class="underline font-semibold ml-1">View existing profile →</a>
                    </div>
                    <div x-show="nic.length>=9 && !nicMatch" x-transition class="mt-1 text-xs text-emerald-600">✓ No existing profile found for this NIC.</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="full_name">Full Name</label>
                        <input id="full_name" name="full_name" type="text" class="form-input" value="{{ old('full_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="tel" class="form-input" x-model="phone" value="{{ old('phone') }}" placeholder="0771234567" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}" placeholder="optional">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="dob">Date of Birth</label>
                        <input id="dob" name="dob" type="date" class="form-input" value="{{ old('dob') }}" required>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="address">Address</label>
                        <textarea id="address" name="address" rows="2" class="form-textarea" placeholder="Home address">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Registration Details</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="source">Registration Source</label>
                        <select id="source" name="source" class="form-select" x-model="source" required>
                            <option value="">Select source</option>
                            <option value="walk_in">Walk-in</option>
                            <option value="employment">Foreign Employment Referral</option>
                            <option value="consultancy">Consultancy Referral</option>
                            <option value="referral">Staff Referral</option>
                            <option value="link">Registration Link</option>
                            <option value="phone">Phone Enquiry</option>
                            <option value="online">Online / Social Media</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="handler_id">Assigned Handler</label>
                        <select id="handler_id" name="handler_id" class="form-select" required>
                            <option value="">Select handler</option>
                            <option value="kasun">Kasun Bandara</option>
                            <option value="nimal">Nimal Jayawardena</option>
                            <option value="priya">Priya Hewage</option>
                            <option value="amila">Amila Perera</option>
                        </select>
                    </div>

                    {{-- Employment Link (conditional) --}}
                    <div class="form-group md:col-span-2" x-show="source==='employment'" style="display:none" x-transition>
                        <label class="form-label">Linked Employment Candidate ID</label>
                        <input name="employment_candidate_id" type="text" class="form-input" placeholder="e.g. EMP-1234 — leave blank if unknown">
                        <p class="form-hint text-amber-600">⚠ This links the Academy enrollment to an existing Employment profile. Verify the NIC matches before submitting.</p>
                    </div>

                    {{-- Consultancy Link (conditional) --}}
                    <div class="form-group md:col-span-2" x-show="source==='consultancy'" style="display:none" x-transition>
                        <label class="form-label">Linked Consultancy Student ID</label>
                        <input name="consultancy_student_id" type="text" class="form-input" placeholder="e.g. CON-0089">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="referring_person">Referring Person (if referral)</label>
                        <input id="referring_person" name="referring_person" type="text" class="form-input" value="{{ old('referring_person') }}" placeholder="Name of referrer">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="registration_date">Registration Date</label>
                        <input id="registration_date" name="registration_date" type="date" class="form-input" value="{{ old('registration_date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="notes">Initial Notes</label>
                        <textarea id="notes" name="notes" rows="3" class="form-textarea" placeholder="Any relevant notes about this student's inquiry…">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Course Interest</h3><span class="badge badge-lead">Optional at Registration</span></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label" for="interested_course">Interested Course</label>
                        <select id="interested_course" name="interested_course_id" class="form-select">
                            <option value="">Not specified yet</option>
                            <option value="PDT-WH">Pre-Departure Training — Warehouse</option>
                            <option value="PDT-HOS">Pre-Departure Training — Hospitality</option>
                            <option value="ENG-INT">English Communication (Intermediate)</option>
                            <option value="ARA-BEG">Arabic Language (Beginners)</option>
                            <option value="CMP-BAS">Computer Literacy — Basic</option>
                            <option value="HOS-SRV">Hospitality Service Training</option>
                        </select>
                        <p class="form-hint">Course selection and payment can be done after registration.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_batch">Preferred Intake</label>
                        <input id="preferred_batch" name="preferred_batch" type="text" class="form-input" value="{{ old('preferred_batch') }}" placeholder="e.g. November 2026">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="user-plus" style="width:16px;height:16px"></i>Register Student</button>
                <a href="{{ route('academy.students.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Duplicate Detection</h3></div>
            <div class="card-body text-sm space-y-2 text-slate-600">
                <p>The system checks NIC number against existing:</p>
                <ul class="space-y-1">
                    <li class="flex items-center gap-2"><i data-lucide="check" style="width:14px;height:14px;color:#10b981"></i>Academy Students</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" style="width:14px;height:14px;color:#10b981"></i>Foreign Employment Candidates</li>
                    <li class="flex items-center gap-2"><i data-lucide="check" style="width:14px;height:14px;color:#10b981"></i>Consultancy Students</li>
                </ul>
                <p class="text-xs text-amber-700 bg-amber-50 border border-amber-200 p-2 rounded-lg mt-2">If a match is found, open the existing profile and link a new Academy enrollment rather than creating a duplicate.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Or Use Registration Link</h3></div>
            <div class="card-body text-sm text-slate-600">
                <p>Generate a secure expiring link to allow self-registration.</p>
                <a href="{{ route('academy.registration-links.index') }}" class="btn btn-outline btn-sm w-full mt-3"><i data-lucide="link" style="width:13px;height:13px"></i>Manage Reg. Links</a>
            </div>
        </div>
    </div>
</div>
</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
