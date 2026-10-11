<x-layouts.app title="New Lead — Consultancy">

<x-page-header
    title="Register New Lead"
    subtitle="Capture a new enquiry or lead for the consultancy pipeline"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.leads.index'),'label'=>'Leads'],['url'=>'#','label'=>'New Lead']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.leads.index') }}" class="btn btn-ghost btn-sm"><i data-lucide="arrow-left" style="width:14px;height:14px"></i>Back</a>
    </x-slot:actions>
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Please fix the following errors:</strong><ul class="mt-1 list-disc list-inside text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('consultancy.leads.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Lead Information</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="first_name">First Name</label>
                        <input id="first_name" name="first_name" type="text" class="form-input @error('first_name') error @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" class="form-input @error('last_name') error @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" class="form-input @error('phone') error @enderror" value="{{ old('phone') }}" required>
                        @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="preferred_country">Preferred Country</label>
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
                        <label class="form-label" for="preferred_course">Preferred Course</label>
                        <input id="preferred_course" name="preferred_course" type="text" class="form-input" value="{{ old('preferred_course') }}" placeholder="e.g. MBA, Bachelor of IT">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="enquiry_notes">Enquiry Notes</label>
                        <textarea id="enquiry_notes" name="enquiry_notes" rows="4" class="form-textarea" placeholder="Key notes from the initial enquiry…">{{ old('enquiry_notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Lead Details</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label required" for="source">Lead Source</label>
                    <select id="source" name="source" class="form-select @error('source') error @enderror" required>
                        <option value="">Select source</option>
                        <option value="walk-in" {{ old('source')==='walk-in'?'selected':'' }}>Walk-in</option>
                        <option value="referral" {{ old('source')==='referral'?'selected':'' }}>Referral</option>
                        <option value="online" {{ old('source')==='online'?'selected':'' }}>Online Enquiry</option>
                        <option value="agent" {{ old('source')==='agent'?'selected':'' }}>Agent</option>
                        <option value="social_media" {{ old('source')==='social_media'?'selected':'' }}>Social Media</option>
                        <option value="event" {{ old('source')==='event'?'selected':'' }}>Event / Exhibition</option>
                        <option value="other" {{ old('source')==='other'?'selected':'' }}>Other</option>
                    </select>
                    @error('source')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group" id="referral-box" style="display:none">
                    <label class="form-label" for="referral_by">Referred By</label>
                    <input id="referral_by" name="referral_by" type="text" class="form-input" value="{{ old('referral_by') }}" placeholder="Referrer name">
                </div>
                <div class="form-group">
                    <label class="form-label required" for="enquiry_date">Enquiry Date</label>
                    <input id="enquiry_date" name="enquiry_date" type="date" class="form-input @error('enquiry_date') error @enderror" value="{{ old('enquiry_date', date('Y-m-d')) }}" required>
                    @error('enquiry_date')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="handler_id">Assign Consultant</label>
                    <select id="handler_id" name="handler_id" class="form-select">
                        <option value="">Unassigned</option>
                        <option value="priya" {{ old('handler_id')==='priya'?'selected':'' }}>Priya Hewage</option>
                        <option value="kasun" {{ old('handler_id')==='kasun'?'selected':'' }}>Kasun Bandara</option>
                        <option value="nimal" {{ old('handler_id')==='nimal'?'selected':'' }}>Nimal Jayawardena</option>
                        <option value="amila" {{ old('handler_id')==='amila'?'selected':'' }}>Amila Perera</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="user-plus" style="width:16px;height:16px"></i>Save Lead</button>
                <a href="{{ route('consultancy.leads.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const src = document.getElementById('source');
    const refBox = document.getElementById('referral-box');
    src?.addEventListener('change', () => { refBox.style.display = src.value === 'referral' ? 'block':'none'; });
});
</script>
</x-layouts.app>
