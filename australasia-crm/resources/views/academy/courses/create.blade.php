<x-layouts.app title="Create Course — Academy">

<x-page-header
    title="Create Course"
    subtitle="Add a new course to the Academy catalogue"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.courses.index'),'label'=>'Courses'],['url'=>'#','label'=>'Create']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Please fix the following errors:</strong><ul class="mt-1 space-y-0.5">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.courses.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Course Information</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label required" for="name">Course Name</label>
                        <input id="name" name="name" type="text" class="form-input" value="{{ old('name') }}" placeholder="e.g. Pre-Departure Training — Warehouse" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="code">Course Code</label>
                        <input id="code" name="code" type="text" class="form-input" value="{{ old('code') }}" placeholder="e.g. PDT-WH" required>
                        <p class="form-hint">Short unique code — used for batch naming</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="course_type">Course Type</label>
                        <select id="course_type" name="course_type" class="form-select" required>
                            <option value="">Select type</option>
                            <option value="pre_departure" {{ old('course_type')=='pre_departure'?'selected':'' }}>Pre-Departure Training</option>
                            <option value="language" {{ old('course_type')=='language'?'selected':'' }}>Language Training</option>
                            <option value="skills" {{ old('course_type')=='skills'?'selected':'' }}>Skills Training</option>
                            <option value="it" {{ old('course_type')=='it'?'selected':'' }}>IT / Computer</option>
                            <option value="hospitality" {{ old('course_type')=='hospitality'?'selected':'' }}>Hospitality</option>
                            <option value="other" {{ old('course_type')=='other'?'selected':'' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-textarea" placeholder="What does this course cover? Who is it for?">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="duration">Duration</label>
                        <input id="duration" name="duration" type="text" class="form-input" value="{{ old('duration') }}" placeholder="e.g. 2 weeks / 40 hours" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="capacity">Max Capacity per Batch</label>
                        <input id="capacity" name="capacity" type="number" min="1" max="200" class="form-input" value="{{ old('capacity',20) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Course Modules / Content</h3></div>
            <div class="card-body" x-data="{modules:[{title:'',hours:''}]}">
                <template x-for="(m,i) in modules" :key="i">
                    <div class="flex gap-3 mb-3 items-start">
                        <div class="flex-1">
                            <input :name="'modules['+i+'][title]'" type="text" class="form-input" placeholder="Module title" x-model="m.title">
                        </div>
                        <div style="width:80px">
                            <input :name="'modules['+i+'][hours]'" type="number" min="1" class="form-input" placeholder="hrs" x-model="m.hours">
                        </div>
                        <button type="button" @click="modules.splice(i,1)" class="btn btn-ghost btn-sm mt-0.5 text-rose-500"><i data-lucide="trash-2" style="width:14px;height:14px"></i></button>
                    </div>
                </template>
                <button type="button" @click="modules.push({title:'',hours:''})" class="btn btn-outline btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Add Module</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Prerequisites</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="prerequisites">Entry Requirements</label>
                    <textarea id="prerequisites" name="prerequisites" rows="3" class="form-textarea" placeholder="e.g. Minimum education: O/L pass. Basic English literacy required.">{{ old('prerequisites') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Fee & Trainer</h3></div>
            <div class="card-body space-y-4">
                <div class="form-group">
                    <label class="form-label required" for="fee">Course Fee</label>
                    <input id="fee" name="fee" type="number" min="0" step="0.01" class="form-input" value="{{ old('fee') }}" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="currency">Currency</label>
                    <select id="currency" name="currency" class="form-select" required>
                        <option value="LKR" {{ old('currency','LKR')==='LKR'?'selected':'' }}>LKR (Sri Lankan Rupee)</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default_trainer">Default Trainer</label>
                    <select id="default_trainer" name="default_trainer_id" class="form-select">
                        <option value="">Assign when creating batch</option>
                        <option value="TRN-1001">Mr. Rupasinghe — PDT Specialist</option>
                        <option value="TRN-1002">Ms. Jayasiri — Language</option>
                        <option value="TRN-1003">Mr. Dissanayake — IT</option>
                        <option value="TRN-1004">Ms. Hathuma — Arabic</option>
                        <option value="TRN-1005">Mr. Perera — Hospitality</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Cross-Module Link</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Linked Module</label>
                    <select name="linked_module" class="form-select">
                        <option value="">None (Academy only)</option>
                        <option value="employment">Foreign Employment (Pre-Departure)</option>
                        <option value="consultancy">Consultancy (Skills)</option>
                    </select>
                    <p class="form-hint">Graduates can be automatically linked back to the Employment pipeline on completion.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary w-full">
                    <i data-lucide="save" style="width:16px;height:16px"></i>Create Course
                </button>
                <a href="{{ route('academy.courses.index') }}" class="btn btn-ghost w-full mt-2">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
