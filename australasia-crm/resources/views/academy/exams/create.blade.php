<x-layouts.app title="Schedule Exam — Academy">

<x-page-header
    title="Schedule Exam"
    subtitle="Create a new examination or assessment for a batch"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.exams.index'),'label'=>'Exams'],['url'=>'#','label'=>'Schedule']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Fix errors:</strong><ul class="mt-1">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.exams.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Exam Details</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label required" for="title">Exam Title</label>
                        <input id="title" name="title" type="text" class="form-input" value="{{ old('title') }}" placeholder="e.g. Pre-Departure Final Assessment" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="course_id">Course</label>
                        <select id="course_id" name="course_id" class="form-select" required>
                            <option value="">Select course</option>
                            <option value="PDT-WH">Pre-Departure — Warehouse</option>
                            <option value="ENG-INT">English Communication (Int.)</option>
                            <option value="ARA-BEG">Arabic Language (Beg.)</option>
                            <option value="CMP-BAS">Computer Literacy — Basic</option>
                            <option value="HOS-SRV">Hospitality Service</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="batch_id">Batch</label>
                        <select id="batch_id" name="batch_id" class="form-select" required>
                            <option value="">Select batch</option>
                            <option value="BCH-2026-001">BCH-2026-001 (Active)</option>
                            <option value="BCH-2026-002">BCH-2026-002 (Active)</option>
                            <option value="BCH-2026-003">BCH-2026-003 (Active)</option>
                            <option value="BCH-2026-004">BCH-2026-004 (Active)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="exam_type">Exam Type</label>
                        <select id="exam_type" name="exam_type" class="form-select" required>
                            <option value="written">Written Examination</option>
                            <option value="practical">Practical Assessment</option>
                            <option value="oral">Oral Examination</option>
                            <option value="mcq">Multiple Choice (MCQ)</option>
                            <option value="project">Project / Assignment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="exam_date">Exam Date</label>
                        <input id="exam_date" name="exam_date" type="date" class="form-input" value="{{ old('exam_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="max_marks">Maximum Marks</label>
                        <input id="max_marks" name="max_marks" type="number" min="1" max="1000" class="form-input" value="{{ old('max_marks',100) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="pass_marks">Pass Marks</label>
                        <input id="pass_marks" name="pass_marks" type="number" min="0" class="form-input" value="{{ old('pass_marks',50) }}" required>
                        @error('pass_marks')<p class="text-rose-600 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="assessor">Examiner / Assessor</label>
                        <select id="assessor" name="assessor" class="form-select">
                            <option value="">Same as batch trainer</option>
                            <option value="TRN-1001">Mr. Rupasinghe</option>
                            <option value="TRN-1002">Ms. Jayasiri</option>
                            <option value="TRN-1003">Mr. Dissanayake</option>
                            <option value="EXT-001">External Examiner</option>
                        </select>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="instructions">Exam Instructions</label>
                        <textarea id="instructions" name="instructions" rows="4" class="form-textarea" placeholder="Instructions that will be visible to trainers and students…">{{ old('instructions') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Attendance Eligibility</h3></div>
            <div class="card-body text-sm space-y-2">
                <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-amber-800">
                    ⚠ <strong>Pending Confirmation</strong><br>
                    The system will check each student's attendance against the configured threshold before allowing marks entry.
                    <a href="{{ route('academy.settings') }}" class="underline font-semibold block mt-1">Configure threshold →</a>
                </div>
                <p class="text-slate-500">Students below the threshold will be flagged as "Not Eligible" and blocked from exam marks entry unless authorized override is applied.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body space-y-2">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="save" style="width:16px;height:16px"></i>Schedule Exam</button>
                <a href="{{ route('academy.exams.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>
<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
