<x-layouts.app title="BCH-2026-001 — Academy">

<x-page-header
    title="BCH-2026-001 — Pre-Departure Training (Warehouse)"
    subtitle="Active · 14 Oct 2026 – 28 Oct 2026 · 24/30 seats"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.batches.index'),'label'=>'Batches'],['url'=>'#','label'=>'BCH-2026-001']]">
    <x-slot:actions>
        <a href="{{ route('academy.sessions.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="calendar" style="width:14px;height:14px"></i>Sessions</a>
        <a href="{{ route('academy.exams.create') }}" class="btn btn-outline btn-sm"><i data-lucide="file-check" style="width:14px;height:14px"></i>Schedule Exam</a>
        <form method="POST" action="{{ route('academy.batches.complete',1) }}" class="inline">@csrf
            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Mark batch as complete?')"><i data-lucide="check-circle" style="width:14px;height:14px"></i>Complete Batch</button>
        </form>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['24/30','Enrolled','users','indigo'],['88%','Avg. Attendance','check-circle','emerald'],['4','Sessions Left','calendar','amber'],['0','Below Threshold','alert-triangle','rose']] as $k)
    <div class="stat-card"><div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-5 h-5 text-{{ $k[3] }}-600"></i></div><div class="stat-value">{{ $k[0] }}</div><div class="stat-label">{{ $k[1] }}</div></div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{tab:'roster'}">
    <div class="lg:col-span-2">
        <div class="tab-bar mb-5">
            <button @click="tab='roster'" :class="tab==='roster'?'tab-active':'tab'" class="tab">Roster</button>
            <button @click="tab='sessions'" :class="tab==='sessions'?'tab-active':'tab'" class="tab">Sessions</button>
            <button @click="tab='attendance'" :class="tab==='attendance'?'tab-active':'tab'" class="tab">Attendance</button>
            <button @click="tab='exams'" :class="tab==='exams'?'tab-active':'tab'" class="tab">Exams</button>
            <button @click="tab='waitlist'" :class="tab==='waitlist'?'tab-active':'tab'" class="tab">Waitlist</button>
        </div>

        {{-- Roster --}}
        <div x-show="tab==='roster'" class="card">
            <div class="card-header"><h3 class="card-title">Student Roster</h3>
                <div class="flex gap-2">
                    <span class="text-sm text-slate-500">24 enrolled · 6 seats remaining</span>
                    <button onclick="openModal('transfer-modal')" class="btn btn-outline btn-xs">Transfer Student</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Enrolled On</th><th>Fee</th><th>Attendance</th><th>Exam Status</th><th></th></tr></thead>
                    <tbody>
                        @foreach([
                            ['ACD-1001','Kamal Pradeep','15 Aug','Paid','92%','Pass'],
                            ['ACD-1002','Nimesha Silva','16 Aug','Paid','78%','Pass'],
                            ['ACD-1003','Samantha Perera','17 Aug','Paid','85%','Pending'],
                            ['ACD-1004','Thilina Jayawardena','18 Aug','Paid','—','Pending'],
                            ['ACD-1005','Dulani Wickramasinghe','19 Aug','Paid','91%','Pending'],
                            ['ACD-1006','Asanka Fernando','20 Aug','Pending','—','Pending'],
                            ['ACD-1007','Chamari Ranasinghe','21 Aug','Paid','62%','Below Threshold ⚠'],
                        ] as $s)
                        <tr>
                            <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s[1] }}</a><p class="text-xs text-slate-400">{{ $s[0] }}</p></td>
                            <td class="text-xs text-slate-500">{{ $s[2] }}</td>
                            <td><span class="badge {{ $s[3]==='Paid'?'badge-approved':'badge-pending' }}">{{ $s[3] }}</span></td>
                            <td class="text-sm font-semibold {{ str_contains($s[4],'6')?'text-rose-600':'text-emerald-600' }}">{{ $s[4] }}</td>
                            <td class="text-sm {{ str_contains($s[5],'⚠')?'text-rose-600':'' }}">{{ $s[5] }}</td>
                            <td><a href="{{ route('academy.students.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Sessions --}}
        <div x-show="tab==='sessions'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Class Sessions</h3>
                <button onclick="openModal('session-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Add Session</button>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>#</th><th>Date</th><th>Topic</th><th>Time</th><th>Attendance</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach([
                            [1,'01 Oct 2026','Workplace Safety — Introduction','08:00–12:00','24/24','done'],
                            [2,'03 Oct 2026','Hazard Awareness & PPE','08:00–12:00','23/24','done'],
                            [3,'05 Oct 2026','Equipment Handling','08:00–12:00','22/24','done'],
                            [4,'08 Oct 2026','Labour Law & Rights','08:00–12:00','—','pending'],
                            [5,'10 Oct 2026','Cultural Orientation','08:00–12:00','—','upcoming'],
                        ] as $ses)
                        <tr>
                            <td class="text-sm font-bold text-slate-500">{{ $ses[0] }}</td>
                            <td class="text-sm text-slate-600">{{ $ses[1] }}</td>
                            <td class="text-sm font-semibold text-slate-800">{{ $ses[2] }}</td>
                            <td class="text-xs text-slate-500">{{ $ses[3] }}</td>
                            <td class="text-sm text-slate-600">{{ $ses[4] }}</td>
                            <td>
                                @if($ses[5]==='pending')
                                <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-primary btn-xs">Mark Attendance</a>
                                @elseif($ses[5]==='done')
                                <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                                @else
                                <span class="text-xs text-slate-400">Upcoming</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Attendance Summary --}}
        <div x-show="tab==='attendance'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Attendance Summary</h3><span class="text-sm text-slate-500">3 sessions recorded</span></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Present</th><th>Absent</th><th>Late</th><th>Attendance %</th><th>Eligible?</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['Kamal Pradeep',22,1,1,'92%','Yes'],
                            ['Nimesha Silva',19,2,3,'78%','Yes'],
                            ['Samantha Perera',21,1,2,'85%','Yes'],
                            ['Chamari Ranasinghe',16,6,2,'62%','⚠ Below Threshold'],
                        ] as $att)
                        <tr>
                            <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold hover:text-indigo-600">{{ $att[0] }}</a></td>
                            <td class="text-sm font-bold text-emerald-600">{{ $att[1] }}</td>
                            <td class="text-sm font-bold text-rose-600">{{ $att[2] }}</td>
                            <td class="text-sm font-bold text-amber-600">{{ $att[3] }}</td>
                            <td class="text-sm font-bold {{ str_contains($att[4],'6')?'text-rose-600':'text-emerald-600' }}">{{ $att[4] }}</td>
                            <td class="text-sm {{ str_contains($att[5],'⚠')?'text-rose-600 font-semibold':'' }}">{{ $att[5] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-sm text-amber-700 bg-amber-50 rounded-b-xl">
                ⚠ Attendance threshold is configurable — <a href="{{ route('academy.settings') }}" class="underline font-semibold">update in Settings</a>.
            </div>
        </div>

        {{-- Exams --}}
        <div x-show="tab==='exams'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Exams for this Batch</h3>
                <a href="{{ route('academy.exams.create') }}" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Schedule Exam</a>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Exam</th><th>Date</th><th>Max Marks</th><th>Pass Marks</th><th>Status</th><th></th></tr></thead>
                    <tbody>
                        <tr>
                            <td class="text-sm font-semibold text-slate-800">Pre-Departure Final Examination</td>
                            <td class="text-xs text-slate-500">15 Oct 2026</td>
                            <td class="text-sm">100</td>
                            <td class="text-sm">50</td>
                            <td><x-status-badge status="scheduled" /></td>
                            <td><a href="{{ route('academy.exams.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Waitlist --}}
        <div x-show="tab==='waitlist'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Waitlist</h3><span class="badge badge-pending">2 waiting</span></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Waitlisted On</th><th>Position</th><th>Actions</th></tr></thead>
                    <tbody>
                        @foreach([['ACD-1008','Roshan Dissanayake','06 Oct 2026',1],['ACD-1012','Ishara Perera','07 Oct 2026',2]] as $w)
                        <tr>
                            <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold hover:text-indigo-600">{{ $w[1] }}</a><p class="text-xs text-slate-400">{{ $w[0] }}</p></td>
                            <td class="text-xs text-slate-500">{{ $w[2] }}</td>
                            <td class="text-sm font-bold text-indigo-600">#{{ $w[3] }}</td>
                            <td>
                                <form method="POST" action="{{ route('academy.students.enroll',1) }}" class="inline">@csrf
                                    <input type="hidden" name="course_id" value="PDT-WH">
                                    <input type="hidden" name="batch_id" value="BCH-2026-001">
                                    <button type="submit" class="btn btn-success btn-xs">Move to Enrolled</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        <div class="card"><div class="card-header"><h3 class="card-title">Batch Info</h3></div>
            <div class="card-body text-sm space-y-2">
                @foreach([['Course','Pre-Departure — Warehouse'],['Batch Code','BCH-2026-001'],['Trainer','Mr. Rupasinghe'],['Start','01 Oct 2026'],['End','15 Oct 2026'],['Class Days','Mon / Wed / Fri'],['Time','08:00 – 12:00'],['Venue','Training Room A'],['Capacity','24/30 enrolled']] as $r)
                <div class="flex justify-between"><span class="text-slate-400">{{ $r[0] }}</span><span class="font-semibold text-slate-800 text-right">{{ $r[1] }}</span></div>
                @endforeach
            </div>
        </div>
        <div class="card"><div class="card-header"><h3 class="card-title">Actions</h3></div>
            <div class="card-body space-y-2">
                <a href="{{ route('academy.attendance.mark',1) }}" class="btn btn-primary w-full btn-sm">Mark Today's Attendance</a>
                <a href="{{ route('academy.exams.create') }}" class="btn btn-outline w-full btn-sm">Schedule Exam</a>
                <button onclick="openModal('transfer-modal')" class="btn btn-outline w-full btn-sm">Transfer Student</button>
                <form method="POST" action="{{ route('academy.batches.complete',1) }}">@csrf
                    <button type="submit" class="btn btn-success w-full btn-sm" onclick="return confirm('Mark this batch as complete?')">Mark Complete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Session Modal --}}
<div id="session-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Add Class Session</span><button onclick="closeModal('session-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.sessions.store') }}">
            @csrf
            <input type="hidden" name="batch_id" value="BCH-2026-001">
            <div class="modal-body space-y-3">
                <div class="form-group"><label class="form-label required">Topic</label><input name="topic" type="text" class="form-input" required></div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="form-group"><label class="form-label required">Date</label><input name="session_date" type="date" class="form-input" required></div>
                    <div class="form-group"><label class="form-label required">Start Time</label><input name="start_time" type="time" class="form-input" required></div>
                    <div class="form-group"><label class="form-label required">End Time</label><input name="end_time" type="time" class="form-input" required></div>
                    <div class="form-group"><label class="form-label">Venue</label><input name="venue" type="text" class="form-input"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('session-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Add Session</button></div>
        </form>
    </div>
</div>

{{-- Transfer Modal --}}
<div id="transfer-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Transfer Student</span><button onclick="closeModal('transfer-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.batches.transfer',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select student</option>
                        <option value="ACD-1003">ACD-1003 — Samantha Perera</option>
                        <option value="ACD-1006">ACD-1006 — Asanka Fernando</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Transfer to Batch</label>
                    <select name="new_batch_id" class="form-select" required>
                        <option value="">Select target batch</option>
                        <option value="BCH-2026-006">BCH-2026-006 — 20 Oct 2026 (22 seats left)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Reason</label><textarea name="transfer_reason" rows="3" class="form-textarea" required minlength="10"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('transfer-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Transfer</button></div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
