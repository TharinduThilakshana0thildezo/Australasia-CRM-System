<x-layouts.app title="Add Trainer — Academy">

<x-page-header
    title="Add Trainer"
    subtitle="Register a new Academy trainer"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.trainers.index'),'label'=>'Trainers'],['url'=>'#','label'=>'Add Trainer']]">
</x-page-header>

@if($errors->any())
<div class="alert alert-danger mb-4"><i data-lucide="x-circle" style="width:18px;height:18px;flex-shrink:0"></i><div><strong>Fix errors:</strong><ul class="mt-1">@foreach($errors->all() as $e)<li class="text-sm">• {{ $e }}</li>@endforeach</ul></div></div>
@endif

<form method="POST" action="{{ route('academy.trainers.store') }}">
@csrf
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Trainer Information</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group md:col-span-2">
                        <label class="form-label required" for="name">Full Name</label>
                        <input id="name" name="name" type="text" class="form-input" value="{{ old('name') }}" required placeholder="e.g. Mr. Rupasinghe">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" class="form-input" value="{{ old('phone') }}" required placeholder="0771234567">
                    </div>
                    <div class="form-group">
                        <label class="form-label required" for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group md:col-span-2">
                        <label class="form-label required" for="specialization">Specialization</label>
                        <input id="specialization" name="specialization" type="text" class="form-input" value="{{ old('specialization') }}" required placeholder="e.g. Pre-Departure Training Specialist">
                    </div>
                    <div class="form-group">
                        <label class="form-label">NIC / ID</label>
                        <input name="nic" type="text" class="form-input" value="{{ old('nic') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date of Joining</label>
                        <input name="joining_date" type="date" class="form-input" value="{{ old('joining_date', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Courses They Can Train</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['PDT-WH','Pre-Departure — Warehouse'],
                        ['PDT-HOS','Pre-Departure — Hospitality'],
                        ['PDT-CAR','Pre-Departure — Care Work'],
                        ['ENG-INT','English Communication'],
                        ['ARA-BEG','Arabic Language'],
                        ['CMP-BAS','Computer Literacy'],
                        ['HOS-SRV','Hospitality Service'],
                        ['DRV-LIC','Defensive Driving'],
                        ['ELD-CAR','Elderly Care'],
                    ] as $c)
                    <label class="flex items-center gap-2 p-2 border border-slate-200 rounded-lg hover:bg-slate-50 cursor-pointer">
                        <input type="checkbox" name="courses[]" value="{{ $c[0] }}" class="form-checkbox">
                        <span class="text-sm text-slate-700">{{ $c[1] }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Notes</h3></div>
            <div class="card-body">
                <textarea name="notes" rows="5" class="form-textarea" placeholder="Any relevant notes about this trainer's background, qualifications, or availability…">{{ old('notes') }}</textarea>
            </div>
        </div>
        <div class="card">
            <div class="card-body space-y-2">
                <button type="submit" class="btn btn-primary w-full"><i data-lucide="user-plus" style="width:16px;height:16px"></i>Add Trainer</button>
                <a href="{{ route('academy.trainers.index') }}" class="btn btn-ghost w-full">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>
<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
