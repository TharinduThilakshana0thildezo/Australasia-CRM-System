<x-layouts.app title="Enrollments — Consultancy">

<x-page-header
    title="Enrollments"
    subtitle="Confirmed university enrollments — journey complete 🎓"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Enrollments']]">
    <x-slot:actions>
        <button onclick="openModal('enroll-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="graduation-cap" style="width:14px;height:14px"></i>Confirm Enrollment
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['12','Enrolled (All Time)','graduation-cap','emerald'],['7','Current Year','calendar','indigo'],['4','Awaiting Enrollment','clock','amber'],['98%','Visa Success Rate','shield','teal']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

{{-- Ready to Enroll --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Ready for Enrollment</h3>
        <span class="badge badge-approved">Registration Complete</span>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Institution</th><th>Course</th><th>Intake</th><th>Visa Ref.</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach([
                    ['Kavinda Gunasekara','CON-0088','Univ. of Manchester','MBA','Sep 2027','UK-TIER4-2026-08812'],
                    ['Indika Chandrasena','CON-0080','Deakin University','Graduate Diploma','Mar 2027','AU-STV-500-2026-00222'],
                ] as $r)
                <tr>
                    <td><a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $r[0] }}</a><p class="text-xs text-slate-400">{{ $r[1] }}</p></td>
                    <td class="text-sm text-slate-700">{{ $r[2] }}</td>
                    <td class="text-sm text-slate-600">{{ $r[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $r[4] }}</td>
                    <td class="font-mono text-xs text-slate-500">{{ $r[5] }}</td>
                    <td><button onclick="openModal('enroll-modal')" class="btn btn-success btn-sm"><i data-lucide="graduation-cap" style="width:13px;height:13px"></i>Confirm Enrollment</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Confirmed Enrollments --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Confirmed Enrollments</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Enrollment ID</th><th>Student</th><th>Institution</th><th>Course</th><th>Intake</th><th>Enrolled On</th><th>Student No.</th><th>Consultant</th></tr></thead>
            <tbody>
                @php
                $enrollments=[
                    ['ENR-CON-0012','Sachini Ranasinghe','CON-0089','Monash University','Bachelor of IT','Feb 2027','10 Oct 2026','IT2027-00841','Priya H.'],
                    ['ENR-CON-0011','Ruwan Bandara','CON-0084','Monash University','Bachelor of IT','Feb 2027','25 Sep 2026','IT2027-00789','Priya H.'],
                    ['ENR-CON-0010','Chamari Dias','CON-0083','UCL London','MSc Data Science','Sep 2026','05 Sep 2026','UCL-DS-2026-0455','Amila P.'],
                    ['ENR-CON-0009','Nilmini Senanayake','CON-0074','McMaster University','BEng Mechatronics','Jan 2027','15 Aug 2026','MAC-MEC-2027-0122','Kasun B.'],
                    ['ENR-CON-0008','Indika Chandrasena','CON-0080','Deakin University','Graduate Diploma','Mar 2027','02 Oct 2026','DEA-GD-2027-0311','Nimal J.'],
                ];
                @endphp
                @foreach($enrollments as $e)
                <tr>
                    <td><span class="font-mono text-xs text-emerald-600">{{ $e[0] }}</span></td>
                    <td><a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $e[1] }}</a><p class="text-xs text-slate-400">{{ $e[2] }}</p></td>
                    <td class="text-sm text-slate-700">{{ $e[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $e[4] }}</td>
                    <td class="text-sm text-slate-600">{{ $e[5] }}</td>
                    <td class="text-xs text-slate-500">{{ $e[6] }}</td>
                    <td class="font-mono text-xs text-slate-500">{{ $e[7] }}</td>
                    <td class="text-sm text-slate-500">{{ $e[8] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Enroll Modal --}}
<div id="enroll-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:520px">
        <div class="modal-header"><span class="modal-title">Confirm University Enrollment 🎓</span><button onclick="closeModal('enroll-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.enrollment.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="alert alert-success">
                    <i data-lucide="graduation-cap" style="width:18px;height:18px;flex-shrink:0"></i>
                    <span class="text-sm">Recording enrollment marks the end of the consultancy journey for this student. Ensure all pre-enrollment checklist items are complete and final payment is confirmed.</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2"><label class="form-label required">Student ID</label><input name="student_id" type="text" class="form-input" placeholder="e.g. CON-0088" required></div>
                    <div class="form-group col-span-2"><label class="form-label required">Institution</label><input name="institution" type="text" class="form-input" placeholder="e.g. Monash University" required></div>
                    <div class="form-group col-span-2"><label class="form-label required">Course</label><input name="course" type="text" class="form-input" placeholder="e.g. Bachelor of IT" required></div>
                    <div class="form-group"><label class="form-label required">Intake</label><input name="intake" type="text" class="form-input" placeholder="e.g. Feb 2027" required></div>
                    <div class="form-group"><label class="form-label required">Enrollment Date</label><input name="enrollment_date" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                    <div class="form-group col-span-2"><label class="form-label">University Student Number</label><input name="student_number" type="text" class="form-input" placeholder="Student's university ID (if already issued)"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('enroll-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return confirm('Confirm enrollment? This marks the student journey complete.')">
                    <i data-lucide="graduation-cap" style="width:14px;height:14px"></i>Confirm Enrollment
                </button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
