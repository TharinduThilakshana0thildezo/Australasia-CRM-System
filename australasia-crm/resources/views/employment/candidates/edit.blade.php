<x-layouts.app title="Edit Candidate — CAND-1297 Kavindu Perera">

<x-page-header
    title="Edit Candidate"
    subtitle="Update candidate profile information"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.candidates.index'), 'label' => 'Candidates'], ['url' => route('employment.candidates.show', 1), 'label' => 'Kavindu Perera'], ['url' => '#', 'label' => 'Edit']]">
</x-page-header>

<form method="POST" action="{{ route('employment.candidates.show', 1) }}" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Personal Information -->
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Personal Information</h3>
                <p class="text-xs text-slate-500 mt-0.5">Core personal details — changes are audited</p>
            </div>
            <span class="badge badge-registered badge-dot">CAND-1297</span>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="form-group">
                    <label class="form-label required">Full Name (as in Passport)</label>
                    <input type="text" class="form-input" value="Kavindu Ashen Perera" name="full_name">
                </div>
                <div class="form-group">
                    <label class="form-label required">Date of Birth</label>
                    <input type="date" class="form-input" value="1992-05-18" name="dob">
                </div>
                <div class="form-group">
                    <label class="form-label required">NIC Number</label>
                    <input type="text" class="form-input" value="924381289V" name="nic">
                    <p class="form-hint">⚠ Changing NIC may affect duplicate detection</p>
                </div>
                <div class="form-group">
                    <label class="form-label">Passport Number</label>
                    <input type="text" class="form-input" value="N7840123" name="passport_no">
                </div>
                <div class="form-group">
                    <label class="form-label">Passport Expiry</label>
                    <input type="date" class="form-input" value="2028-09-14" name="passport_expiry">
                </div>
                <div class="form-group">
                    <label class="form-label required">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label required">Marital Status</label>
                    <select class="form-select" name="marital_status">
                        <option value="married" selected>Married</option>
                        <option value="single">Single</option>
                        <option value="divorced">Divorced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Religion</label>
                    <select class="form-select" name="religion">
                        <option value="buddhist" selected>Buddhist</option>
                        <option value="christian">Christian</option>
                        <option value="islam">Islam</option>
                        <option value="hindu">Hindu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-input" value="34" name="age" readonly disabled>
                    <p class="form-hint">Auto-calculated from DOB</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="card">
        <div class="card-header"><h3 class="card-title">Contact Information</h3></div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="form-group">
                    <label class="form-label required">Mobile / WhatsApp</label>
                    <input type="tel" class="form-input" value="077 234 5678" name="mobile">
                </div>
                <div class="form-group">
                    <label class="form-label">Alternative Phone</label>
                    <input type="tel" class="form-input" value="" name="alt_mobile">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="kavindu.perera@gmail.com" name="email">
                </div>
                <div class="form-group md:col-span-2">
                    <label class="form-label">Current Address</label>
                    <textarea class="form-textarea" name="address" rows="2">No. 12, Sampath Mawatha, Kaduwela, Colombo 10</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">District</label>
                    <select class="form-select" name="district">
                        <option value="colombo" selected>Colombo</option>
                        <option value="gampaha">Gampaha</option>
                        <option value="kandy">Kandy</option>
                        <option value="galle">Galle</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment Profile -->
    <div class="card">
        <div class="card-header"><h3 class="card-title">Employment Profile</h3></div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="form-group">
                    <label class="form-label">Job Category</label>
                    <select class="form-select" name="job_category">
                        <option value="warehouse_operator" selected>Warehouse Operator</option>
                        <option value="construction">Construction</option>
                        <option value="driver">Driver</option>
                        <option value="hospitality">Hospitality</option>
                        <option value="factory">Factory Worker</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Years of Experience</label>
                    <input type="number" class="form-input" value="5" name="experience_years" min="0" max="50">
                </div>
                <div class="form-group">
                    <label class="form-label">Preferred Country</label>
                    <select class="form-select" name="preferred_country">
                        <option value="australia" selected>Australia</option>
                        <option value="uae">UAE</option>
                        <option value="qatar">Qatar</option>
                        <option value="kuwait">Kuwait</option>
                        <option value="any">Any</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">English Level</label>
                    <select class="form-select" name="english_level">
                        <option value="basic" selected>Basic</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                        <option value="native">Native</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Highest Education</label>
                    <select class="form-select" name="education">
                        <option value="ol" selected>O/L</option>
                        <option value="al">A/L</option>
                        <option value="diploma">Diploma</option>
                        <option value="degree">Degree</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Handler (Staff)</label>
                    <select class="form-select" name="handler_id">
                        <option>Nimal Jayawardena</option>
                        <option>Priya Hewage</option>
                        <option selected>Kasun Bandara</option>
                        <option>Amila Peiris</option>
                    </select>
                </div>
                <div class="form-group md:col-span-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-textarea" name="notes">Experienced in forklift operations. Completed pre-departure training on 06 Oct 2026.</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between bg-white border border-slate-200 rounded-xl px-6 py-4">
        <div class="text-sm text-slate-500">
            <i data-lucide="info" style="width:13px;height:13px;display:inline;margin-right:4px"></i>
            All changes are recorded in the candidate's activity log
        </div>
        <div class="flex gap-3">
            <a href="{{ route('employment.candidates.show', 1) }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
                <i data-lucide="save" style="width:14px;height:14px"></i>
                Save Changes
            </button>
        </div>
    </div>

</form>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
