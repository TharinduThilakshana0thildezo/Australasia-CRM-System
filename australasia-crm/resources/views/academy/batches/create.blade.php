<x-layouts.app title="Create Batch — Academy">

<x-page-header
    title="Create Batch"
    subtitle="Schedule a new course batch"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.batches.index'),'label'=>'Batches'],['url'=>'#','label'=>'Create']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Fix errors:</strong><ul class="mt-1">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.batches.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Batch Details</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="form-label required" for="course_id">Course</label>
                        <select id="course_id" name="course_id" class="form-select" required>
                            <option value="">Select course</option>
                            <option value="PDT-WH">Pre-Departure Training — Warehouse (Cap: 30)</option>
                            <option value="PDT-HOS">Pre-Departure Training — Hospitality (Cap: 25)</option>
                            <option value="ENG-INT">English Communication Intermediate (Cap: 20)</option>
                            <option value="ARA-BEG">Arabic Language Beginners (Cap: 15)</option>
                            <option value="CMP-BAS">Computer Literacy Basic (Cap: 30)</option>
                            <option value="HOS-SRV">Hospitality Service Training (Cap: 20)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="batch_code">Batch Code</label>
                        <input id="batch_code" name="batch_code" type="text" class="form-input" value="{{ old('batch_code') }}" placeholder="e.g. BCH-2026-007" required>
                        <p class="form-hint">Unique code for this batch</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="trainer_id">Trainer</label>
                        <select id="trainer_id" name="trainer_id" class="form-select" required>
                            <option value="">Select trainer</option>
                            <option value="TRN-1001">Mr. Rupasinghe — PDT Specialist</option>
                            <option value="TRN-1002">Ms. Jayasiri — Language</option>
                            <option value="TRN-1003">Mr. Dissanayake — IT / Computer</option>
                            <option value="TRN-1004">Ms. Hathuma — Arabic</option>
                            <option value="TRN-1005">Mr. Perera — Hospitality</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="capacity">Batch Capacity</label>
                        <input id="capacity" name="capacity" type="number" min="1" max="100" class="form-input" value="{{ old('capacity',20) }}" required>
                        <p class="form-hint">Cannot exceed course max capacity</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="start_date">Start Date</label>
                        <input id="start_date" name="start_date" type="date" class="form-input" value="{{ old('start_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="end_date">End Date</label>
                        <input id="end_date" name="end_date" type="date" class="form-input" value="{{ old('end_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="class_days">Class Days</label>
                        <input id="class_days" name="class_days" type="text" class="form-input" value="{{ old('class_days') }}" placeholder="e.g. Mon, Wed, Fri">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="class_time">Class Time</label>
                        <input id="class_time" name="class_time" type="text" class="form-input" value="{{ old('class_time') }}" placeholder="e.g. 08:00 – 12:00">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="venue">Venue / Room</label>
                        <input id="venue" name="venue" type="text" class="form-input" value="{{ old('venue') }}" placeholder="e.g. Training Room A, Floor 2">
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="notes">Notes</label>
                        <textarea id="notes" name="notes" rows="3" class="form-textarea" placeholder="Any special notes for this batch…">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Waitlist Policy</h3></div>
            <div class="card-body space-y-3">
                <div class="form-group">
                    <label class="form-label">Enable Waitlist</label>
                    <div class="flex items-center gap-2 mt-1">
                        <input type="checkbox" name="enable_waitlist" id="enable_waitlist" class="form-checkbox" checked>
                        <label for="enable_waitlist" class="text-sm text-slate-600">Allow students to join waitlist if batch is full</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="max_waitlist">Max Waitlist Size</label>
                    <input id="max_waitlist" name="max_waitlist" type="number" min="0" max="50" class="form-input" value="{{ old('max_waitlist',5) }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body space-y-2">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="save" style="width:16px;height:16px"></i>Create Batch</button>
                <a href="{{ route('academy.batches.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>
<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
