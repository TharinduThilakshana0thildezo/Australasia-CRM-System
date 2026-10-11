<x-layouts.app title="Registrations — Consultancy">

<x-page-header
    title="Post-Visa Registrations"
    subtitle="Pre-enrollment registration checklists for all visa-approved students"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Registrations']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['8','Total Pending','clipboard-list','indigo'],['3','Complete','check-circle','emerald'],['2','Overdue','clock','rose'],['5','In Progress','loader','amber']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="space-y-5">
    @php
    $regs=[
        ['id'=>'REG-CON-0001','student'=>'Sachini Ranasinghe','sid'=>'CON-0089','institution'=>'Monash University','intake'=>'Feb 2027','items_total'=>6,'items_done'=>3,'urgent'=>false,'visa_ref'=>'AU-STV-500-2026-00319'],
        ['id'=>'REG-CON-0002','student'=>'Kavinda Gunasekara','sid'=>'CON-0088','institution'=>'Univ. of Manchester','intake'=>'Sep 2027','items_total'=>6,'items_done'=>6,'urgent'=>false,'visa_ref'=>'UK-TIER4-2026-08812'],
        ['id'=>'REG-CON-0003','student'=>'Ruwan Bandara','sid'=>'CON-0084','institution'=>'Monash University','intake'=>'Feb 2027','items_total'=>6,'items_done'=>2,'urgent'=>true,'visa_ref'=>'AU-STV-500-2026-00188'],
    ];
    @endphp
    @foreach($regs as $reg)
    @php $pct = $reg['items_total'] > 0 ? ($reg['items_done']/$reg['items_total']*100) : 0; @endphp
    <div class="card {{ $reg['urgent'] ? 'border-rose-200':'' }}">
        <div class="card-header">
            <div>
                <p class="font-bold text-slate-800">{{ $reg['institution'] }} — {{ $reg['intake'] }}</p>
                <p class="text-xs text-slate-500">{{ $reg['id'] }} · <a href="{{ route('consultancy.students.show',1) }}" class="text-indigo-600 font-semibold">{{ $reg['student'] }}</a> ({{ $reg['sid'] }}) · Visa: <span class="font-mono">{{ $reg['visa_ref'] }}</span></p>
            </div>
            <div class="flex items-center gap-2">
                @if($pct == 100)<span class="badge badge-approved">Complete</span>
                @elseif($reg['urgent'])<span class="badge badge-refund">Overdue</span>
                @else<span class="badge badge-pending">In Progress</span>@endif
            </div>
        </div>
        <div class="card-body">
            <div class="flex items-center gap-4 mb-4">
                <div class="flex-1">
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-500">Checklist Progress</span>
                        <span class="font-bold {{ $pct==100?'text-emerald-600':($reg['urgent']?'text-rose-600':'text-amber-600') }}">{{ $reg['items_done'] }}/{{ $reg['items_total'] }}</span>
                    </div>
                    <div class="progress-bar-track">
                        <div class="progress-bar-fill {{ $pct==100?'bg-emerald-500':($reg['urgent']?'bg-rose-500':'bg-amber-400') }}" style="width:{{ $pct }}%"></div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach([
                    ['Visa Confirmation Received',       $reg['items_done'] >= 1],
                    ['Offer Letter / Acceptance Filed',  $reg['items_done'] >= 2],
                    ['Accommodation Confirmed',          $reg['items_done'] >= 3],
                    ['Enrollment Form Submitted',        $reg['items_done'] >= 4],
                    ['First Tuition Installment Paid',   $reg['items_done'] >= 5],
                    ['Student ID Received',              $reg['items_done'] >= 6],
                ] as $item)
                <div class="flex items-center gap-2 text-sm {{ $item[1]?'text-emerald-700':'text-slate-500' }}">
                    @if($item[1])
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" fill="#d1fae5"/><polyline points="20 6 9 17 4 12" stroke="#059669"></polyline></svg>
                    @else
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>
                    @endif
                    {{ $item[0] }}
                </div>
                @endforeach
            </div>
            <div class="mt-4 flex gap-3">
                @if($pct < 100)
                <form method="POST" action="{{ route('consultancy.registrations.complete-item',$reg['id']) }}">
                    @csrf
                    <input type="hidden" name="item_id" value="next_item">
                    <button type="submit" class="btn btn-outline btn-sm">Mark Next Item Complete</button>
                </form>
                <form method="POST" action="{{ route('consultancy.registrations.complete',$reg['id']) }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Mark entire registration complete?')">Mark Registration Complete</button>
                </form>
                @else
                <a href="{{ route('consultancy.enrollment.index') }}" class="btn btn-primary btn-sm">Proceed to Enrollment →</a>
                @endif
                <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-ghost btn-sm">View Profile</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
