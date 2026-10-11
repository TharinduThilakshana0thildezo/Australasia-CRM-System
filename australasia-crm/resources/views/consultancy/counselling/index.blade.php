<x-layouts.app title="Counselling Sessions — Consultancy">

<x-page-header
    title="Counselling Sessions"
    subtitle="All consultancy sessions — study plan agreement and student assessment"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Counselling']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.counselling.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Session
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['41','Sessions This Month','message-circle','indigo'],['12','Study Plans Agreed','check-circle','emerald'],['9','Follow-ups Due','calendar','amber'],['6','Not Yet Agreed','clock','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Session Log</h3>
        <a href="{{ route('consultancy.counselling.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>New Session</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr>
                <th>Student</th><th>Date</th><th>Consultant</th><th>Country</th><th>Course</th><th>Study Plan</th><th>Outcome</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @php
                $sessions=[
                    ['student'=>'Sachini Ranasinghe','sid'=>'CON-0089','date'=>'05 Sep 2026','consultant'=>'Priya H.','country'=>'Australia','course'=>'Bachelor of IT','agreed'=>true,'outcome'=>'Plan agreed — proceed to application'],
                    ['student'=>'Kavinda Gunasekara','sid'=>'CON-0088','date'=>'20 Aug 2026','consultant'=>'Amila P.','country'=>'UK','course'=>'MBA','agreed'=>true,'outcome'=>'Plan agreed — Univ. of Manchester shortlisted'],
                    ['student'=>'Thisara Wickramasinghe','sid'=>'CON-0087','date'=>'10 Sep 2026','consultant'=>'Kasun B.','country'=>'Canada','course'=>'Diploma IT','agreed'=>false,'outcome'=>'Follow-up session booked for 17 Sep'],
                    ['student'=>'Dinusha Jayasena','sid'=>'CON-0086','date'=>'18 Sep 2026','consultant'=>'Nimal J.','country'=>'New Zealand','course'=>'Business (TBC)','agreed'=>false,'outcome'=>'Student undecided — follow-up required'],
                    ['student'=>'Amara Dissanayake','sid'=>'CON-0085','date'=>'25 Sep 2026','consultant'=>'Amila P.','country'=>'Australia','course'=>'Bachelor of Business','agreed'=>false,'outcome'=>'Fee payment first — counselling re-scheduled'],
                    ['student'=>'Ruwan Bandara','sid'=>'CON-0084','date'=>'15 Jul 2026','consultant'=>'Priya H.','country'=>'Australia','course'=>'Bachelor of IT','agreed'=>true,'outcome'=>'Plan agreed — Monash shortlisted (3 sessions)'],
                    ['student'=>'Chamari Dias','sid'=>'CON-0083','date'=>'28 Jul 2026','consultant'=>'Priya H.','country'=>'UK','course'=>'MSc Data Science','agreed'=>true,'outcome'=>'Plan agreed — UCL first choice confirmed'],
                    ['student'=>'Indika Chandrasena','sid'=>'CON-0080','date'=>'25 Jun 2026','consultant'=>'Nimal J.','country'=>'Australia','course'=>'Graduate Diploma','agreed'=>true,'outcome'=>'Plan agreed — Deakin confirmed — 2 sessions'],
                ];
                @endphp
                @foreach($sessions as $s)
                <tr>
                    <td>
                        <a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s['student'] }}</a>
                        <p class="text-xs text-slate-400">{{ $s['sid'] }}</p>
                    </td>
                    <td class="text-xs text-slate-500">{{ $s['date'] }}</td>
                    <td><div class="flex items-center gap-1.5"><div class="avatar avatar-sm avatar-violet">{{ substr($s['consultant'],0,2) }}</div><span class="text-sm text-slate-600">{{ $s['consultant'] }}</span></div></td>
                    <td class="text-sm text-slate-600">{{ $s['country'] }}</td>
                    <td class="text-sm text-slate-600">{{ $s['course'] }}</td>
                    <td>
                        @if($s['agreed'])<span class="badge badge-approved">Agreed ✓</span>
                        @else<span class="badge badge-pending">Not Agreed</span>@endif
                    </td>
                    <td class="text-xs text-slate-500 max-w-48">{{ $s['outcome'] }}</td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ route('consultancy.students.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                            @if(!$s['agreed'])<a href="{{ route('consultancy.counselling.create') }}" class="btn btn-primary btn-xs">Follow-up</a>@endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex items-center justify-between">
        <span class="text-sm text-slate-500">Showing 8 of 41 sessions</span>
        <div class="flex gap-1"><button class="btn btn-ghost btn-sm" disabled>← Prev</button><button class="btn btn-primary btn-sm">1</button><button class="btn btn-ghost btn-sm">2</button><button class="btn btn-ghost btn-sm">Next →</button></div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
