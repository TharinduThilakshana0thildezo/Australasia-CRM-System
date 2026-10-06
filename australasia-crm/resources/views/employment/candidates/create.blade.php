<x-layouts.app title="Register Candidate — Foreign Employment">

<x-page-header
    title="Register Candidate"
    subtitle="Create a new candidate profile for Foreign Employment"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.candidates.index'), 'label' => 'Candidates'], ['url' => '#', 'label' => 'Register Candidate']]">
</x-page-header>

<!-- Duplicate check alert (shown when NIC matches) -->
<div id="dup-alert" class="alert alert-warning mb-5 hidden">
    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="flex-1">
        <p class="font-bold">Existing profile found!</p>
        <p class="text-sm mt-0.5">NIC <strong>199012034578</strong> matches an existing profile: <strong>Kavindu Perera</strong> (CAND-1247)</p>
    </div>
    <div class="flex gap-2 flex-shrink-0">
        <a href="{{ route('employment.candidates.show', 1) }}" class="btn btn-outline btn-sm">Open Existing Profile</a>
        <button class="btn btn-success btn-sm">Add Employment Stream</button>
    </div>
</div>

<form x-data="{ showDupAlert: false }" @submit.prevent>
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- ===== LEFT: FORM ===== -->
    <div class="xl:col-span-2 space-y-5">

        <!-- PERSONAL INFORMATION -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Personal Information</h3>
            </div>
            <div class="card-body">
                <div class="form-section-title">Identity</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div class="form-group">
                        <label class="form-label required">Full Name</label>
                        <input type="text" class="form-input" placeholder="e.g. Kavindu Lakmal Perera">
                    </div>
                    <div class="form-group">
                        <label class="form-label required">NIC Number</label>
                        <div class="relative">
                            <input type="text"
                                   class="form-input"
                                   placeholder="e.g. 199012034578"
                                   id="nic-field"
                                   x-on:blur="
                                       if ($el.value.length >= 10) {
                                           document.getElementById('dup-alert').classList.remove('hidden');
                                       } else {
                                           document.getElementById('dup-alert').classList.add('hidden');
                                       }
                                   ">
                            <div id="nic-check-icon" class="absolute right-3 top-1/2 -translate-y-1/2 hidden">
                                <span class="text-amber-500 text-xs font-bold">⚠ Match found</span>
                            </div>
                        </div>
                        <p class="form-hint">Enter NIC to auto-check for existing profiles</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Passport Number</label>
                        <input type="text" class="form-input" placeholder="e.g. N12345678">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Passport Expiry</label>
                        <input type="date" class="form-input">
                    </div>
                </div>

                <div class="form-section-title">Contact Details</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div class="form-group">
                        <label class="form-label required">Phone Number</label>
                        <input type="tel" class="form-input" placeholder="e.g. 077 234 5678">
                    </div>
                    <div class="form-group">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="tel" class="form-input" placeholder="Same as phone if same">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" placeholder="e.g. kavindu@gmail.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Date of Birth</label>
                        <input type="date" class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Gender</label>
                        <select class="form-select">
                            <option value="">Select gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-section-title">Address</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-input" placeholder="Street address">
                    </div>
                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" class="form-input" placeholder="e.g. Colombo">
                    </div>
                    <div class="form-group">
                        <label class="form-label">District</label>
                        <select class="form-select">
                            <option value="">Select district</option>
                            <option>Colombo</option><option>Gampaha</option><option>Kalutara</option>
                            <option>Kandy</option><option>Matale</option><option>Nuwara Eliya</option>
                            <option>Galle</option><option>Matara</option><option>Hambantota</option>
                            <option>Jaffna</option><option>Kilinochchi</option><option>Mannar</option>
                            <option>Vavuniya</option><option>Mullaitivu</option><option>Batticaloa</option>
                            <option>Ampara</option><option>Trincomalee</option><option>Kurunegala</option>
                            <option>Puttalam</option><option>Anuradhapura</option><option>Polonnaruwa</option>
                            <option>Badulla</option><option>Monaragala</option><option>Ratnapura</option>
                            <option>Kegalle</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- EMPLOYMENT PROFILE -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employment Profile</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label">Current Occupation</label>
                        <input type="text" class="form-input" placeholder="e.g. Machine Operator">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Desired Occupation</label>
                        <input type="text" class="form-input" placeholder="e.g. Warehouse Operator">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Years of Experience</label>
                        <select class="form-select">
                            <option value="">Select</option>
                            <option>Less than 1 year</option>
                            <option>1–2 years</option>
                            <option>3–5 years</option>
                            <option>6–10 years</option>
                            <option>10+ years</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Languages</label>
                        <input type="text" class="form-input" placeholder="e.g. Sinhala, English (Basic)">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Skills</label>
                        <input type="text" class="form-input" placeholder="e.g. Forklift, Packing, Quality Control">
                        <p class="form-hint">Comma-separated skills</p>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Preferred Countries</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-1">
                            @foreach(['Australia', 'UAE', 'Qatar', 'Kuwait', 'Malaysia', 'Saudi Arabia', 'Singapore', 'Maldives'] as $country)
                            <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                                <input type="checkbox" class="form-input" style="width:14px;height:14px;padding:0">
                                {{ $country }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- ===== RIGHT: SOURCE + SUBMIT ===== -->
    <div class="space-y-5">

        <!-- Source Information -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Source & Assignment</h3>
            </div>
            <div class="card-body space-y-4">
                <div class="form-group">
                    <label class="form-label required">Candidate Source</label>
                    <select class="form-select">
                        <option value="">Select source</option>
                        <option>Walk-in</option>
                        <option>Referral</option>
                        <option>Agent</option>
                        <option>Online Enquiry</option>
                        <option>Employer Contact</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Referral / Agent Name</label>
                    <input type="text" class="form-input" placeholder="Who referred this candidate?">
                </div>
                <div class="form-group">
                    <label class="form-label required">Registered By</label>
                    <select class="form-select">
                        <option>Kasun Bandara</option>
                        <option>Nimal Jayawardena</option>
                        <option>Priya Hewage</option>
                        <option>Amila Perera</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label required">Handler / Assigned To</label>
                    <select class="form-select">
                        <option>Kasun Bandara</option>
                        <option>Nimal Jayawardena</option>
                        <option>Priya Hewage</option>
                        <option>Amila Perera</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Notes</label>
                    <textarea class="form-textarea" placeholder="Any additional notes about this candidate or lead..."></textarea>
                </div>
            </div>
        </div>

        <!-- Registration method -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registration Method</h3>
            </div>
            <div class="card-body space-y-3">
                <label class="flex items-start gap-3 cursor-pointer p-3 border-2 border-indigo-200 bg-indigo-50 rounded-xl">
                    <input type="radio" name="reg_method" value="direct" checked class="mt-0.5">
                    <div>
                        <p class="text-sm font-semibold text-indigo-800">Direct Registration by Consultant</p>
                        <p class="text-xs text-indigo-600 mt-0.5">Register the candidate immediately in this session.</p>
                    </div>
                </label>
                <label class="flex items-start gap-3 cursor-pointer p-3 border-2 border-slate-200 rounded-xl hover:border-indigo-200">
                    <input type="radio" name="reg_method" value="link" class="mt-0.5">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">Send Secure Registration Link</p>
                        <p class="text-xs text-slate-500 mt-0.5">Generate a one-time secure link for the candidate to self-register.</p>
                    </div>
                </label>
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-800">
                    <strong>Note:</strong> Registration links are single-use and expire. A new link must be generated if expired.
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full">
                    <i data-lucide="user-plus" style="width:16px;height:16px"></i>
                    Register Candidate
                </button>
                <a href="{{ route('employment.candidates.index') }}" class="btn btn-secondary w-full text-center">
                    Cancel
                </a>
            </div>
        </div>

    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
</script>

</x-layouts.app>
