<x-layouts.app title="New Counselling Session — Consultancy">

<x-page-header
    title="Record Counselling Session"
    subtitle="Log a study counselling session and capture study plan agreement"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.counselling.index'),'label'=>'Counselling'],['url'=>'#','label'=>'New Session']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.counselling.index') }}" class="btn btn-ghost btn-sm"><i data-lucide="arrow-left" style="width:14px;height:14px"></i>Back</a>
    </x-slot:actions>
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Please fix the following errors:</strong><ul class="mt-1 list-disc list-inside text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('consultancy.counselling.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Session Details</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="student_id">Student</label>
                        <select id="student_id" name="student_id" class="form-select @error('student_id') error @enderror" required>
                            <option value="">Select student</option>
                            <option value="CON-0089">CON-0089 — Sachini Ranasinghe</option>
                            <option value="CON-0088">CON-0088 — Kavinda Gunasekara</option>
                            <option value="CON-0087">CON-0087 — Thisara Wickramasinghe</option>
                            <option value="CON-0086">CON-0086 — Dinusha Jayasena</option>
                            <option value="CON-0085">CON-0085 — Amara Dissanayake</option>
                            <option value="CON-0082">CON-0082 — Roshan Wijesinghe</option>
                        </select>
                        @error('student_id')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="session_date">Session Date</label>
                        <input id="session_date" name="session_date" type="date" class="form-input @error('session_date') error @enderror" value="{{ old('session_date', date('Y-m-d')) }}" required>
                        @error('session_date')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="consultant_id">Consultant</label>
                        <select id="consultant_id" name="consultant_id" class="form-select @error('consultant_id') error @enderror" required>
                            <option value="">Select consultant</option>
                            <option value="priya">Priya Hewage</option>
                            <option value="kasun">Kasun Bandara</option>
                            <option value="nimal">Nimal Jayawardena</option>
                            <option value="amila">Amila Perera</option>
                        </select>
                        @error('consultant_id')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="session_type">Session Type</label>
                        <select id="session_type" name="session_type" class="form-select">
                            <option value="initial">Initial Counselling</option>
                            <option value="follow_up">Follow-up Session</option>
                            <option value="plan_review">Study Plan Review</option>
                            <option value="parents">Parent / Guardian Session</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <p class="form-section-title">Study Profile Captured</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label required" for="preferred_country">Preferred Study Country</label>
                            <select id="preferred_country" name="preferred_country" class="form-select @error('preferred_country') error @enderror" required>
                                <option value="">Select country</option>
                                <option value="Australia">Australia</option>
                                <option value="UK">United Kingdom</option>
                                <option value="Canada">Canada</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="USA">USA</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('preferred_country')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="preferred_course">Preferred Course</label>
                            <input id="preferred_course" name="preferred_course" type="text" class="form-input" value="{{ old('preferred_course') }}" placeholder="e.g. Bachelor of IT">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="preferred_intake">Target Intake</label>
                            <input id="preferred_intake" name="preferred_intake" type="text" class="form-input" value="{{ old('preferred_intake') }}" placeholder="e.g. Feb 2027">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="budget">Confirmed Budget (AUD/GBP/CAD)</label>
                            <input id="budget" name="budget" type="text" class="form-input" value="{{ old('budget') }}" placeholder="e.g. AUD 28,000">
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label required" for="study_goals">Study Goals & Assessment</label>
                            <textarea id="study_goals" name="study_goals" rows="4" class="form-textarea @error('study_goals') error @enderror" placeholder="Document the student's study goals, motivations, academic background, and consultant's assessment of suitability…" required>{{ old('study_goals') }}</textarea>
                            @error('study_goals')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label" for="shortlisted_institutions">Institutions Discussed / Shortlisted</label>
                            <textarea id="shortlisted_institutions" name="shortlisted_institutions" rows="2" class="form-textarea" placeholder="e.g. Monash University (first choice), RMIT (backup), Deakin (budget option)…">{{ old('shortlisted_institutions') }}</textarea>
                        </div>
                        <div class="form-group md:col-span-2">
                            <label class="form-label" for="session_notes">Session Notes</label>
                            <textarea id="session_notes" name="session_notes" rows="3" class="form-textarea" placeholder="Any additional notes about the session…">{{ old('session_notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Study Plan Decision</h3></div>
            <div class="card-body">
                <p class="text-sm text-slate-600 mb-3">Did the student and consultant agree on a study plan this session?</p>
                <div class="space-y-2 mb-4">
                    <label class="flex items-start gap-3 p-3 border border-emerald-200 bg-emerald-50 rounded-xl cursor-pointer has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-100">
                        <input type="radio" name="study_plan_agreed" value="yes" class="mt-0.5 accent-emerald-600" {{ old('study_plan_agreed')==='yes'?'checked':'' }}>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Yes — Study Plan Agreed</p>
                            <p class="text-xs text-slate-500">Proceed to institution shortlisting and applications.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3 p-3 border border-amber-200 bg-amber-50 rounded-xl cursor-pointer has-[:checked]:border-amber-500 has-[:checked]:bg-amber-100">
                        <input type="radio" name="study_plan_agreed" value="no" class="mt-0.5 accent-amber-600" {{ old('study_plan_agreed')==='no'?'checked':'' }}>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">No — Follow-up Required</p>
                            <p class="text-xs text-slate-500">Schedule another session before proceeding.</p>
                        </div>
                    </label>
                </div>
                @error('study_plan_agreed')<p class="form-error">{{ $message }}</p>@enderror

                <div id="followup-fields" style="display:none">
                    <div class="form-group">
                        <label class="form-label">Schedule Follow-up Date</label>
                        <input name="followup_date" type="date" class="form-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body space-y-3">
                <button type="submit" class="btn btn-primary w-full">
                    <i data-lucide="check" style="width:16px;height:16px"></i>Save Session
                </button>
                <a href="{{ route('consultancy.counselling.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const radios = document.querySelectorAll('input[name="study_plan_agreed"]');
    const followupFields = document.getElementById('followup-fields');
    radios.forEach(r => {
        r.addEventListener('change', () => {
            followupFields.style.display = r.value === 'no' && r.checked ? 'block' : 'none';
        });
    });
    if (document.querySelector('input[name="study_plan_agreed"][value="no"]:checked')) {
        followupFields.style.display = 'block';
    }
});
</script>
</x-layouts.app>
