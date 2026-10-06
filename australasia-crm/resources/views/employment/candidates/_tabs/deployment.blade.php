<!-- Deployment Tab -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Deployment — DEP-00183</h3>
        <x-status-badge status="deployment" />
    </div>
    <div class="card-body">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-sm">
            <div><p class="text-xs text-slate-400">Employer</p><p class="font-semibold mt-0.5">Global Workforce Solutions</p></div>
            <div><p class="text-xs text-slate-400">Country</p><p class="font-semibold mt-0.5">Australia</p></div>
            <div><p class="text-xs text-slate-400">Job Role</p><p class="font-semibold mt-0.5">Warehouse Operator</p></div>
            <div><p class="text-xs text-slate-400">Visa Ref.</p><p class="font-mono font-semibold mt-0.5">AU-482-2026-00847</p></div>
            <div><p class="text-xs text-slate-400">Departure Date</p><p class="font-semibold text-amber-600 mt-0.5">TBD — Pending Booking</p></div>
            <div><p class="text-xs text-slate-400">Briefing</p><p class="font-semibold text-amber-600 mt-0.5">Not Scheduled</p></div>
        </div>

        <!-- Deployment stages -->
        <h4 class="text-sm font-bold text-slate-700 mb-3">Deployment Progress</h4>
        <div class="space-y-2">
            @php
            $depStages = [
                ['label' => 'Visa Approved', 'done' => true, 'date' => '06 Oct 2026'],
                ['label' => 'Deployment Preparation', 'done' => false, 'current' => true],
                ['label' => 'Flight Booking', 'done' => false],
                ['label' => 'Pre-departure Briefing', 'done' => false],
                ['label' => 'Final Dispatch', 'done' => false],
                ['label' => 'Deployed — Case Closed', 'done' => false],
            ];
            @endphp
            @foreach($depStages as $stage)
            <div class="flex items-center gap-3 p-3 rounded-lg {{ $stage['done'] ? 'bg-emerald-50' : (isset($stage['current']) ? 'bg-indigo-50 border border-indigo-200' : 'bg-slate-50') }}">
                <div class="w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0
                    {{ $stage['done'] ? 'bg-emerald-500' : (isset($stage['current']) ? 'bg-indigo-500' : 'bg-slate-200') }}">
                    @if($stage['done'])
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    @else
                        <div class="w-2 h-2 rounded-full {{ isset($stage['current']) ? 'bg-white' : 'bg-slate-400' }}"></div>
                    @endif
                </div>
                <span class="text-sm font-medium {{ $stage['done'] ? 'text-emerald-700' : (isset($stage['current']) ? 'text-indigo-700' : 'text-slate-500') }}">
                    {{ $stage['label'] }}
                </span>
                @if(isset($stage['date']))
                    <span class="ml-auto text-xs text-slate-500">{{ $stage['date'] }}</span>
                @endif
                @if(isset($stage['current']))
                    <span class="ml-auto badge badge-processing">In Progress</span>
                @endif
            </div>
            @endforeach
        </div>

        <div class="flex gap-3 mt-5">
            <button class="btn btn-primary btn-sm">
                <i data-lucide="plane" style="width:14px;height:14px"></i>
                Book Flight
            </button>
            <button class="btn btn-secondary btn-sm">
                <i data-lucide="calendar" style="width:14px;height:14px"></i>
                Schedule Briefing
            </button>
        </div>
    </div>
</div>
