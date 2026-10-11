<x-layouts.app title="Mark Attendance — Session SES-004">

<x-page-header
    title="Mark Attendance — SES-004"
    subtitle="Labour Law &amp; Rights · BCH-2026-001 · 08 Oct 2026 · 08:00–12:00"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.attendance.index'),'label'=>'Attendance'],['url'=>'#','label'=>'Mark SES-004']]">
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="card mb-5">
    <div class="card-header"><h3 class="card-title">Session Details</h3></div>
    <div class="card-body">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            @foreach([['Batch','BCH-2026-001'],['Course','Pre-Departure — Warehouse'],['Trainer','Mr. Rupasinghe'],['Venue','Training Room A']] as $r)
            <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800">{{ $r[1] }}</p></div>
            @endforeach
        </div>
    </div>
</div>

<form method="POST" action="{{ route('academy.attendance.store',1) }}" x-data="{markAll:''}">
@csrf
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Roster — 24 Students</h3>
        <div class="flex gap-2 items-center">
            <span class="text-sm text-slate-500">Mark all as:</span>
            <button type="button" @click="markAll='present';document.querySelectorAll('[name$=\'[status]\']').forEach(s=>s.value='present')" class="btn btn-success btn-xs">All Present</button>
            <button type="button" @click="markAll='absent';document.querySelectorAll('[name$=\'[status]\']').forEach(s=>s.value='absent')" class="btn btn-outline btn-xs text-rose-600">All Absent</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student ID</th><th>Name</th><th>Status</th><th>Notes</th></tr></thead>
            <tbody>
                @php
                $students=[
                    ['ACD-1001','Kamal Pradeep'],['ACD-1002','Nimesha Silva'],['ACD-1003','Samantha Perera'],
                    ['ACD-1004','Thilina Jayawardena'],['ACD-1005','Dulani Wickramasinghe'],['ACD-1006','Asanka Fernando'],
                    ['ACD-1007','Chamari Ranasinghe'],['ACD-1008','Roshan Dissanayake'],['ACD-1009','Malinda Seneviratne'],
                    ['ACD-1010','Tharanga Kumara'],['ACD-1011','Ishara Perera'],['ACD-1012','Amali Jayasiri'],
                ];
                @endphp
                @foreach($students as $i => $s)
                <tr class="{{ $i%2===0?'bg-white':'bg-slate-50/50' }}">
                    <td>
                        <input type="hidden" name="attendance[{{ $i }}][student_id]" value="{{ $s[0] }}">
                        <span class="font-mono text-xs text-slate-500">{{ $s[0] }}</span>
                    </td>
                    <td class="text-sm font-semibold text-slate-800">{{ $s[1] }}</td>
                    <td>
                        <select name="attendance[{{ $i }}][status]" class="form-select" style="width:130px" required>
                            <option value="present" selected>Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                            <option value="excused">Excused</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="attendance[{{ $i }}][note]" class="form-input" style="width:200px" placeholder="Optional note">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer flex gap-3">
        <button type="submit" class="btn btn-primary"><i data-lucide="save" style="width:16px;height:16px"></i>Save Attendance</button>
        <a href="{{ route('academy.attendance.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
</div>
</form>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
