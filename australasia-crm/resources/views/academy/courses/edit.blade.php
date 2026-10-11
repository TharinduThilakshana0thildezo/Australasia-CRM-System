<x-layouts.app title="Edit Course — Academy">

<x-page-header
    title="Edit Course"
    subtitle="Update course details, fee, or trainer assignment"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.courses.index'),'label'=>'Courses'],['url'=>route('academy.courses.show',1),'label'=>'Course'],['url'=>'#','label'=>'Edit']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Fix errors:</strong><ul class="mt-1">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.courses.update',1) }}">
@csrf
@method('PUT')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Course Information</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label required" for="name">Course Name</label>
                        <input id="name" name="name" type="text" class="form-input" value="Pre-Departure Training — Warehouse" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="code">Course Code</label>
                        <input id="code" name="code" type="text" class="form-input" value="PDT-WH" required>
                        <p class="form-hint text-amber-600">⚠ Changing the code will affect all existing batch references.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="course_type">Course Type</label>
                        <select id="course_type" name="course_type" class="form-select" required>
                            <option value="pre_departure" selected>Pre-Departure Training</option>
                            <option value="language">Language Training</option>
                            <option value="skills">Skills Training</option>
                            <option value="it">IT / Computer</option>
                            <option value="hospitality">Hospitality</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-textarea">Mandatory pre-departure training for candidates placed in warehouse and logistics roles in the Middle East and South-East Asia. Covers workplace safety, equipment handling, workplace rights, and cultural orientation.</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="duration">Duration</label>
                        <input id="duration" name="duration" type="text" class="form-input" value="2 weeks (80 hours)" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="capacity">Max Capacity per Batch</label>
                        <input id="capacity" name="capacity" type="number" min="1" max="200" class="form-input" value="30" required>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label" for="prerequisites">Prerequisites</label>
                        <textarea id="prerequisites" name="prerequisites" rows="2" class="form-textarea">Minimum O/L qualification. Must be an active Foreign Employment candidate with a confirmed job offer. Basic English literacy required.</textarea>
                    </div>
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
                    <input id="fee" name="fee" type="number" min="0" step="0.01" class="form-input" value="5000" required>
                </div>
                <div class="form-group">
                    <label class="form-label required" for="currency">Currency</label>
                    <select id="currency" name="currency" class="form-select" required>
                        <option value="LKR" selected>LKR</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default_trainer">Default Trainer</label>
                    <select id="default_trainer" name="default_trainer_id" class="form-select">
                        <option value="TRN-1001" selected>Mr. Rupasinghe</option>
                        <option value="TRN-1002">Ms. Jayasiri</option>
                        <option value="TRN-1003">Mr. Dissanayake</option>
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
                        <option value="employment" selected>Foreign Employment (Pre-Departure)</option>
                        <option value="consultancy">Consultancy (Skills)</option>
                        <option value="">None (Academy only)</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body space-y-2">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="save" style="width:16px;height:16px"></i>Save Changes</button>
                <a href="{{ route('academy.courses.show',1) }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
