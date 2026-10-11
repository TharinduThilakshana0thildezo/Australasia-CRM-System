<x-layouts.app title="Register Student — Consultancy">

<x-page-header
    title="Register New Student"
    subtitle="Create a new consultancy student profile. NIC and phone are used for duplicate detection."
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.students.index'),'label'=>'Students'],['url'=>'#','label'=>'Register Student']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.students.index') }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" style="width:14px;height:14px"></i>Back
        </a>
    </x-slot:actions>
</x-page-header>

{{-- Duplicate Warning --}}
@if(session('dup_warning'))
<div class="alert alert-warning mb-4">
    <i data-lucide="alert-triangle" style="width:20px;height:20px;flex-shrink:0"></i>
    <div>
        <strong>Duplicate Profile Detected</strong><br>
        <span class="text-sm">{{ session('dup_warning') }}</span>
        <div class="mt-2 flex gap-2">
            <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-outline btn-sm">View Existing Profile</a>
        </div>
    </div>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div><strong>Please fix the following errors:</strong>
        <ul class="mt-1 list-disc list-inside text-sm">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

{{-- Entry Route Info --}}
<div class="alert alert-info mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>Direct Consultant Entry</strong> — You are registering a student directly. Alternatively, you can
        <a href="{{ route('consultancy.registration-links.index') }}" class="underline font-semibold">generate a secure one-time registration link</a>
        for the student to self-register.
    </div>
</div>

<form method="POST" action="{{ route('consultancy.students.store') }}" id="stu-create-form">
@csrf

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Main Form --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Personal Information --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Personal Information</h3></div>
            <div class="card-body">
                <p class="form-section-title">Identity & Contact</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="full_name">Full Name</label>
                        <input id="full_name" name="full_name" type="text" class="form-input @error('full_name') error @enderror" value="{{ old('full_name') }}" placeholder="e.g. Sachini Ranasinghe" required>
                        @error('full_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_name">Preferred Name</label>
                        <input id="preferred_name" name="preferred_name" type="text" class="form-input" value="{{ old('preferred_name') }}" placeholder="Optional">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="nic">NIC Number</label>
                        <input id="nic" name="nic" type="text" class="form-input @error('nic') error @enderror" value="{{ old('nic') }}" placeholder="e.g. 199608203421" required>
                        <p class="form-hint">Used for duplicate detection. Enter exactly as printed on NIC.</p>
                        @error('nic')<p class="form-error">{{ $message }}</p>@enderror
                        <div id="nic-dup-hint" class="hidden mt-1 p-2 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                            <strong>⚠ This NIC may match an existing profile.</strong> Please verify before submitting.
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="passport">Passport Number</label>
                        <input id="passport" name="passport" type="text" class="form-input" value="{{ old('passport') }}" placeholder="e.g. N12345678">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone Number</label>
                        <input id="phone" name="phone" type="tel" class="form-input @error('phone') error @enderror" value="{{ old('phone') }}" placeholder="e.g. 077 234 5678" required>
                        <p class="form-hint">Also used for duplicate detection.</p>
                        @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="whatsapp">WhatsApp Number</label>
                        <input id="whatsapp" name="whatsapp" type="tel" class="form-input" value="{{ old('whatsapp') }}" placeholder="If different from phone">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="email">Email Address</label>
                        <input id="email" name="email" type="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" placeholder="student@email.com">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <input id="dob" name="dob" type="date" class="form-input" value="{{ old('dob') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-select">
                            <option value="">Select</option>
                            <option {{ old('gender')==='male' ? 'selected':'' }} value="male">Male</option>
                            <option {{ old('gender')==='female' ? 'selected':'' }} value="female">Female</option>
                            <option {{ old('gender')==='other' ? 'selected':'' }} value="other">Other</option>
                            <option {{ old('gender')==='prefer_not' ? 'selected':'' }} value="prefer_not">Prefer not to say</option>
                        </select>
                    </div>
                </div>

                <p class="form-section-title mt-5">Address</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="address">Street Address</label>
                        <input id="address" name="address" type="text" class="form-input" value="{{ old('address') }}" placeholder="No. 15, Main Street, Nugegoda">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input id="city" name="city" type="text" class="form-input" value="{{ old('city') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="district">District</label>
                        <input id="district" name="district" type="text" class="form-input" value="{{ old('district') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Academic Profile --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Academic & Study Profile</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label" for="highest_qualification">Highest Qualification</label>
                        <select id="highest_qualification" name="highest_qualification" class="form-select">
                            <option value="">Select</option>
                            <option value="ol">O/L</option>
                            <option value="al">A/L</option>
                            <option value="diploma">Diploma</option>
                            <option value="bachelor">Bachelor's Degree</option>
                            <option value="master">Master's Degree</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_country">Preferred Study Country</label>
                        <select id="preferred_country" name="preferred_country" class="form-select">
                            <option value="">Select country</option>
                            <option value="australia">Australia</option>
                            <option value="uk">United Kingdom</option>
                            <option value="canada">Canada</option>
                            <option value="new_zealand">New Zealand</option>
                            <option value="usa">USA</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_course">Preferred Course/Subject</label>
                        <input id="preferred_course" name="preferred_course" type="text" class="form-input" value="{{ old('preferred_course') }}" placeholder="e.g. Bachelor of IT, MBA">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_intake">Preferred Intake</label>
                        <input id="preferred_intake" name="preferred_intake" type="text" class="form-input" value="{{ old('preferred_intake') }}" placeholder="e.g. Feb 2027, Sep 2027">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="english_test">English Proficiency Test</label>
                        <select id="english_test" name="english_test" class="form-select">
                            <option value="">None / Not yet taken</option>
                            <option value="ielts">IELTS</option>
                            <option value="pte">PTE Academic</option>
                            <option value="toefl">TOEFL</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="english_score">Test Score / Band</label>
                        <input id="english_score" name="english_score" type="text" class="form-input" value="{{ old('english_score') }}" placeholder="e.g. IELTS 6.5">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="budget_lkr">Approximate Budget (LKR)</label>
                        <input id="budget_lkr" name="budget_lkr" type="number" min="0" class="form-input" value="{{ old('budget_lkr') }}" placeholder="e.g. 5000000">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="budget_usd">Approximate Budget (USD)</label>
                        <input id="budget_usd" name="budget_usd" type="number" min="0" class="form-input" value="{{ old('budget_usd') }}" placeholder="e.g. 20000">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="study_goals">Study Goals & Motivations</label>
                        <textarea id="study_goals" name="study_goals" rows="3" class="form-textarea" placeholder="Brief description of what the student wants to achieve…">{{ old('study_goals') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Initial Notes</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="notes">Enquiry Notes</label>
                    <textarea id="notes" name="notes" rows="4" class="form-textarea" placeholder="Key information from initial enquiry, special requirements, referral context…">{{ old('notes') }}</textarea>
                </div>
            </div>
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">

        {{-- Registration Details --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Registration Details</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label required" for="source">Lead Source <span class="text-rose-500">*</span></label>
                    <select id="source" name="source" class="form-select @error('source') error @enderror" required>
                        <option value="">Select source</option>
                        <option {{ old('source')==='walk-in' ? 'selected':'' }} value="walk-in">Walk-in</option>
                        <option {{ old('source')==='referral' ? 'selected':'' }} value="referral">Referral</option>
                        <option {{ old('source')==='online' ? 'selected':'' }} value="online">Online Enquiry</option>
                        <option {{ old('source')==='agent' ? 'selected':'' }} value="agent">Agent</option>
                        <option {{ old('source')==='social_media' ? 'selected':'' }} value="social_media">Social Media</option>
                        <option {{ old('source')==='event' ? 'selected':'' }} value="event">Event / Exhibition</option>
                        <option {{ old('source')==='other' ? 'selected':'' }} value="other">Other</option>
                    </select>
                    @error('source')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group" id="referral-fields" style="display:none">
                    <label class="form-label" for="referral_name">Referred By (Name)</label>
                    <input id="referral_name" name="referral_name" type="text" class="form-input" value="{{ old('referral_name') }}" placeholder="Referrer name">
                    <label class="form-label mt-2" for="referral_phone">Referrer Phone</label>
                    <input id="referral_phone" name="referral_phone" type="tel" class="form-input" value="{{ old('referral_phone') }}">
                </div>
                <div class="form-group">
                    <label class="form-label required" for="handler_id">Assigned Consultant <span class="text-rose-500">*</span></label>
                    <select id="handler_id" name="handler_id" class="form-select @error('handler_id') error @enderror" required>
                        <option value="">Select consultant</option>
                        <option value="priya" {{ old('handler_id')==='priya'?'selected':'' }}>Priya Hewage</option>
                        <option value="kasun" {{ old('handler_id')==='kasun'?'selected':'' }}>Kasun Bandara</option>
                        <option value="nimal" {{ old('handler_id')==='nimal'?'selected':'' }}>Nimal Jayawardena</option>
                        <option value="amila" {{ old('handler_id')==='amila'?'selected':'' }}>Amila Perera</option>
                    </select>
                    @error('handler_id')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="enquiry_date">Enquiry Date</label>
                    <input id="enquiry_date" name="enquiry_date" type="date" class="form-input" value="{{ old('enquiry_date', date('Y-m-d')) }}">
                </div>
            </div>
        </div>

        {{-- Registration Fee Notice --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registration Fee</h3>
                <span class="badge badge-pending">⚠ To Be Confirmed</span>
            </div>
            <div class="card-body">
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800 mb-3">
                    <strong>Business Rule Pending Confirmation</strong><br>
                    The registration fee amount and refund policy for Consultancy are marked "to be confirmed" in the workflow. This is a configurable setting.
                    <a href="{{ route('consultancy.settings') }}" class="underline">Configure in Settings →</a>
                </div>
                <div class="form-group">
                    <label class="form-label" for="reg_fee_amount">Fee Amount (LKR)</label>
                    <input id="reg_fee_amount" name="reg_fee_amount" type="number" min="0" class="form-input" value="{{ old('reg_fee_amount','25000') }}" placeholder="Amount in LKR">
                    <p class="form-hint">Student will be prompted to pay this after profile creation.</p>
                </div>
            </div>
        </div>

        {{-- Cross-stream Link Notice --}}
        <div class="card">
            <div class="card-header"><h3 class="card-title">Cross-Stream Linking</h3></div>
            <div class="card-body text-sm text-slate-600">
                <p class="mb-2">If this student has an existing <span class="stream-badge stream-employment">Emp</span> or <span class="stream-badge stream-academy">Aca</span> profile, they will be linked by NIC/phone automatically.</p>
                <p class="text-xs text-slate-400">No Foreign Employment or Academy data will be overwritten.</p>
            </div>
        </div>

        {{-- Submit --}}
        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full" id="submit-btn">
                    <i data-lucide="user-plus" style="width:16px;height:16px"></i>
                    Create Student Profile
                </button>
                <a href="{{ route('consultancy.students.index') }}" class="btn btn-ghost w-full">
                    Cancel
                </a>
                <div class="text-xs text-slate-400 text-center">
                    A registration fee collection step will follow immediately after profile creation.
                </div>
            </div>
        </div>
    </div>

</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    // Show/hide referral fields
    const sourceSelect = document.getElementById('source');
    const refFields = document.getElementById('referral-fields');
    sourceSelect?.addEventListener('change', () => {
        refFields.style.display = sourceSelect.value === 'referral' ? 'block' : 'none';
    });
    if (sourceSelect?.value === 'referral') refFields.style.display = 'block';

    // Live NIC duplicate hint (demo: flag known NICs)
    const knownNICs = ['199508204567','198912034578','200103214321'];
    const nicInput = document.getElementById('nic');
    const nicHint = document.getElementById('nic-dup-hint');
    nicInput?.addEventListener('input', () => {
        const v = nicInput.value.replace(/\s/g,'');
        nicHint.classList.toggle('hidden', !knownNICs.includes(v) || v.length < 9);
    });

    // Prevent double submission
    const form = document.getElementById('stu-create-form');
    const submitBtn = document.getElementById('submit-btn');
    form?.addEventListener('submit', () => {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i data-lucide="loader" style="width:16px;height:16px;animation:spin 1s linear infinite"></i> Creating…';
    });
});
</script>
<style>@keyframes spin{from{transform:rotate(0)}to{transform:rotate(360deg)}}</style>
</x-layouts.app>
