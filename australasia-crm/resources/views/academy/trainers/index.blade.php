<x-layouts.app title="Trainers — Academy">

<x-page-header
    title="Trainer Management"
    subtitle="Academy trainers, specializations, and batch assignments"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Trainers']]">
    <x-slot:actions>
        <a href="{{ route('academy.trainers.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="user-plus" style="width:14px;height:14px"></i>Add Trainer
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['8','Active Trainers','users','indigo'],['8','Running Batches','layers','emerald'],['3','Available','check-circle','slate'],['0','On Leave','clock','amber']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @php
    $trainers=[
        ['TRN-1001','Mr. Rupasinghe','R','Pre-Departure Training Specialist','0771234501','rupasinghe@training.lk','2 batches','active','Pre-Departure (WH, HOS, CAR)'],
        ['TRN-1002','Ms. Jayasiri','J','Language & Communication Trainer','0762345602','jayasiri@training.lk','2 batches','active','English, Hospitality Comm.'],
        ['TRN-1003','Mr. Dissanayake','D','IT & Computer Skills Trainer','0753456703','dissanayake@training.lk','1 batch','active','Computer Literacy, Digital Skills'],
        ['TRN-1004','Ms. Hathuma','H','Arabic Language Trainer','0764567804','hathuma@training.lk','1 batch','active','Arabic (Beginner to Advanced)'],
        ['TRN-1005','Mr. Perera','P','Hospitality & Service Trainer','0775678905','perera@training.lk','1 batch','active','Hospitality, Service Operations'],
        ['TRN-1006','Ms. Amarasinghe','A','Safety & First Aid Trainer','0766789006','amarasinghe@training.lk','0 batches','active','Workplace Safety, First Aid'],
        ['TRN-1007','Mr. Bandara','B','Driving & Transport Trainer','0777890107','bandara@training.lk','0 batches','active','Defensive Driving, Safety'],
        ['TRN-1008','Ms. Fernando','F','Elderly Care Trainer','0768901208','fernando@training.lk','0 batches','inactive','Elderly Care, Medical Basics'],
    ];
    $colors=['violet','indigo','teal','amber','emerald','rose','cyan','slate'];
    @endphp
    @foreach($trainers as $i => $t)
    <div class="card hover:shadow-md transition-shadow">
        <div class="card-body">
            <div class="flex items-start gap-4">
                <div class="avatar avatar-md bg-{{ $colors[$i%count($colors)] }}-100 text-{{ $colors[$i%count($colors)] }}-700 text-lg font-bold flex-shrink-0">{{ $t[2] }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-0.5">
                        <h3 class="font-bold text-slate-800">{{ $t[1] }}</h3>
                        <x-status-badge :status="$t[7]" />
                    </div>
                    <p class="text-xs text-indigo-600 font-medium mb-2">{{ $t[3] }}</p>
                    <div class="space-y-1 text-xs text-slate-500">
                        <div class="flex items-center gap-1.5"><i data-lucide="phone" style="width:12px;height:12px"></i>{{ $t[4] }}</div>
                        <div class="flex items-center gap-1.5"><i data-lucide="mail" style="width:12px;height:12px"></i>{{ $t[5] }}</div>
                        <div class="flex items-center gap-1.5"><i data-lucide="layers" style="width:12px;height:12px"></i><strong>{{ $t[6] }}</strong> currently assigned</div>
                    </div>
                    <div class="mt-3 p-2 bg-slate-50 rounded-lg text-xs text-slate-500">
                        <span class="font-semibold text-slate-700">Courses: </span>{{ $t[8] }}
                    </div>
                </div>
            </div>
            <div class="flex gap-2 mt-4">
                <a href="{{ route('academy.trainers.show',1) }}" class="btn btn-ghost btn-sm flex-1"><i data-lucide="eye" style="width:13px;height:13px"></i>View</a>
                @if($t[7]==='active')
                <a href="{{ route('academy.batches.create') }}" class="btn btn-outline btn-sm flex-1"><i data-lucide="plus" style="width:13px;height:13px"></i>Assign Batch</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
