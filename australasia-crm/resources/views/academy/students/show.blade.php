<x-layouts.app title="Kamal Pradeep — Academy">

<x-page-header
    title="Kamal Pradeep"
    subtitle="ACD-1001 · Pre-Departure Training — Warehouse · Completed"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.students.index'),'label'=>'Students'],['url'=>'#','label'=>'ACD-1001']]">
    <x-slot:actions>
        <button onclick="openModal('enroll-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>New Enrollment
        </button>
        <button onclick="openModal('close-case-modal')" class="btn btn-danger btn-sm">
            <i data-lucide="x-circle" style="width:14px;height:14px"></i>Close Case
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{tab:'overview'}">
    <div class="lg:col-span-2">
        {{-- Tab Bar --}}
        <div class="tab-bar mb-5">
            <button @click="tab='overview'" :class="tab==='overview'?'tab-active':'tab'" class="tab">Overview</button>
            <button @click="tab='enrollment'" :class="tab==='enrollment'?'tab-active':'tab'" class="tab">Enrollment</button>
            <button @click="tab='attendance'" :class="tab==='attendance'?'tab-active':'tab'" class="tab">Attendance</button>
            <button @click="tab='exams'" :class="tab==='exams'?'tab-active':'tab'" class="tab">Exams & Results</button>
            <button @click="tab='payments'" :class="tab==='payments'?'tab-active':'tab'" class="tab">Payments</button>
            <button @click="tab='certificates'" :class="tab==='certificates'?'tab-active':'tab'" class="tab">Certificates</button>
            <button @click="tab='activity'" :class="tab==='activity'?'tab-active':'tab'" class="tab">Activity</button>
        </div>

        {{-- Overview --}}
        <div x-show="tab==='overview'" class="space-y-5">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Student Profile</h3><x-status-badge status="completed" /></div>
                <div class="card-body">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        @foreach([
                            ['Student ID','ACD-1001'],['NIC','199812304512'],['Phone','0771234567'],
                            ['Email','kamal.p@example.com'],['Date of Birth','12 Mar 1998'],['Address','Moratuwa, Western'],
                            ['Source','Foreign Employment'],['Handler','Kasun Bandara'],['Registered','10 Jan 2026'],
                        ] as $r)
                        <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Cross-Module Links --}}
            <div class="card">
                <div class="card-header"><h3 class="card-title">Cross-Module Links</h3></div>
                <div class="card-body space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-blue-50 border border-blue-200 rounded-xl">
                        <i data-lucide="briefcase" style="width:18px;height:18px;color:#3b82f6;flex-shrink:0"></i>
                        <div class="flex-1 text-sm">
                            <p class="font-semibold text-blue-800">Foreign Employment — EMP-1001</p>
                            <p class="text-xs text-blue-600 mt-0.5">Kamal Pradeep · Status: Deployment Ready · Academy pre-departure training COMPLETED</p>
                        </div>
                        <a href="{{ route('employment.candidates.index') }}" class="btn btn-outline btn-xs">View →</a>
                    </div>
                    <p class="text-xs text-slate-400">No Consultancy profile linked.</p>
                </div>
            </div>

            {{-- Journey Progress --}}
            <div class="card">
                <div class="card-header"><h3 class="card-title">Academy Journey Progress</h3></div>
                <div class="card-body">
                    <div class="grid grid-cols-4 md:grid-cols-8 gap-2">
                        @foreach([
                            ['Registered','check','emerald'],['Fee Paid','check','emerald'],
                            ['Enrolled','check','emerald'],['Training','check','emerald'],
                            ['Exam','check','emerald'],['Passed','check','emerald'],
                            ['Certificate','check','emerald'],['Complete','check','emerald'],
                        ] as $step)
                        <div class="text-center">
                            <div class="w-10 h-10 bg-{{ $step[2] }}-100 rounded-full flex items-center justify-center mx-auto mb-1">
                                <i data-lucide="{{ $step[1] }}" class="w-4 h-4 text-{{ $step[2] }}-600"></i>
                            </div>
                            <p class="text-xs text-{{ $step[2] }}-700 font-medium leading-tight">{{ $step[0] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Enrollment --}}
        <div x-show="tab==='enrollment'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Enrollment History</h3></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Enrollment ID</th><th>Course</th><th>Batch</th><th>Enrolled On</th><th>Completed</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><span class="font-mono text-xs text-emerald-600">ENR-ACD-0047</span></td>
                            <td class="text-sm font-semibold text-slate-800">Pre-Departure Training — Warehouse</td>
                            <td class="text-xs font-mono text-slate-500">BCH-2026-003</td>
                            <td class="text-xs text-slate-500">15 Aug 2026</td>
                            <td class="text-xs text-slate-500">15 Sep 2026</td>
                            <td><x-status-badge status="completed" /></td>
                            <td>
                                <div class="flex gap-1">
                                    <a href="{{ route('academy.enrollments.show',1) }}" class="btn btn-ghost btn-xs"><i data-lucide="eye" style="width:13px;height:13px"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button onclick="openModal('enroll-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Add Enrollment</button>
            </div>
        </div>

        {{-- Attendance --}}
        <div x-show="tab==='attendance'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Attendance Record</h3><span class="badge badge-approved">92% — Eligible</span></div>
            <div class="card-body">
                <div class="grid grid-cols-3 gap-4 mb-4 text-center">
                    <div class="bg-emerald-50 rounded-xl p-3"><p class="text-2xl font-extrabold text-emerald-600">22</p><p class="text-xs text-slate-500 mt-1">Sessions Present</p></div>
                    <div class="bg-rose-50 rounded-xl p-3"><p class="text-2xl font-extrabold text-rose-600">1</p><p class="text-xs text-slate-500 mt-1">Sessions Absent</p></div>
                    <div class="bg-amber-50 rounded-xl p-3"><p class="text-2xl font-extrabold text-amber-600">1</p><p class="text-xs text-slate-500 mt-1">Sessions Late</p></div>
                </div>
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead><tr><th>Date</th><th>Topic</th><th>Status</th><th>Marked By</th></tr></thead>
                        <tbody>
                            @foreach([
                                ['01 Sep 2026','Workplace Safety — Intro','present','Mr. Rupasinghe'],
                                ['03 Sep 2026','Workplace Safety — Hazards','present','Mr. Rupasinghe'],
                                ['05 Sep 2026','Equipment Handling','present','Mr. Rupasinghe'],
                                ['08 Sep 2026','Labour Law','absent','Mr. Rupasinghe'],
                                ['10 Sep 2026','Cultural Orientation','late','Mr. Rupasinghe'],
                                ['12 Sep 2026','Basic English','present','Ms. Jayasiri'],
                                ['15 Sep 2026','Final Assessment','present','Mr. Rupasinghe'],
                            ] as $att)
                            <tr>
                                <td class="text-sm text-slate-600">{{ $att[0] }}</td>
                                <td class="text-sm text-slate-700">{{ $att[1] }}</td>
                                <td><span class="badge {{ $att[2]==='present'?'badge-approved':($att[2]==='absent'?'badge-rejected':'badge-pending') }}">{{ ucfirst($att[2]) }}</span></td>
                                <td class="text-sm text-slate-500">{{ $att[3] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Exams & Results --}}
        <div x-show="tab==='exams'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Exams & Results</h3></div>
            <div class="card-body space-y-4">
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                    <p class="font-bold text-emerald-800">✓ PASSED — Pre-Departure Final Examination</p>
                    <div class="grid grid-cols-3 gap-3 mt-3 text-sm">
                        <div><p class="text-xs text-slate-400">Exam Date</p><p class="font-semibold">15 Sep 2026</p></div>
                        <div><p class="text-xs text-slate-400">Marks Obtained</p><p class="font-semibold">76/100</p></div>
                        <div><p class="text-xs text-slate-400">Pass Mark</p><p class="font-semibold">50/100</p></div>
                        <div><p class="text-xs text-slate-400">Percentage</p><p class="font-semibold text-emerald-600">76%</p></div>
                        <div><p class="text-xs text-slate-400">Attempt</p><p class="font-semibold">1st Attempt</p></div>
                        <div><p class="text-xs text-slate-400">Result Status</p><p class="font-semibold text-emerald-600">Pass</p></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payments --}}
        <div x-show="tab==='payments'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Payment Records</h3><span class="badge badge-approved">Fully Paid</span></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Payment ID</th><th>Type</th><th>Amount</th><th>Method</th><th>Date</th><th>Reference</th></tr></thead>
                    <tbody>
                        <tr>
                            <td class="font-mono text-xs text-indigo-600">PAY-ACD-88421</td>
                            <td><span class="badge badge-approved">Course Fee</span></td>
                            <td class="text-sm font-bold">LKR 5,000</td>
                            <td class="text-sm text-slate-600">Bank Transfer</td>
                            <td class="text-xs text-slate-500">15 Aug 2026</td>
                            <td class="font-mono text-xs text-slate-500">REF-BT-1122</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button onclick="openModal('payment-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:13px;height:13px"></i>Record Payment</button>
            </div>
        </div>

        {{-- Certificates --}}
        <div x-show="tab==='certificates'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Certificates</h3></div>
            <div class="card-body">
                <div class="flex items-center gap-4 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i data-lucide="award" class="w-6 h-6 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-emerald-800">Pre-Departure Training — Warehouse</p>
                        <p class="text-xs text-slate-500 mt-0.5">CERT-ACD-A8F2 · Issued 17 Sep 2026 · Issued by: Kasun Bandara</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="btn btn-ghost btn-sm"><i data-lucide="eye" style="width:13px;height:13px"></i>View</button>
                        <button class="btn btn-outline btn-sm"><i data-lucide="download" style="width:13px;height:13px"></i>Download</button>
                        <button onclick="openModal('void-cert-modal')" class="btn btn-danger btn-sm">Void</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Activity --}}
        <div x-show="tab==='activity'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Activity & Audit Log</h3></div>
            <div class="card-body">
                <div class="timeline">
                    @foreach([
                        ['emerald','✓','Certificate Issued — CERT-ACD-A8F2','17 Sep 2026','Certificate issued by Kasun Bandara. Auto-linked to Employment profile EMP-1001.'],
                        ['emerald','✓','Exam Results Published — 76/100 PASS','16 Sep 2026','Results published. First attempt. Eligible for certificate issuance.'],
                        ['emerald','✓','Attendance Complete — 92%','15 Sep 2026','24/26 sessions attended. Above configured threshold. Exam eligible.'],
                        ['info','~','Batch BCH-2026-003 Started','01 Sep 2026','Student enrolled in PDT-WH batch.'],
                        ['info','+','Fee Payment Recorded','15 Aug 2026','LKR 5,000 — Bank Transfer (REF-BT-1122). Recorded by Kasun Bandara.'],
                        ['info','+','Course Selected','12 Aug 2026','Pre-Departure Training — Warehouse selected. Batch BCH-2026-003 allocated.'],
                        ['info','+','Student Registered','10 Jan 2026','Walk-in registration. Source: Foreign Employment (EMP-1001). Handler: Kasun Bandara.'],
                    ] as $evt)
                    <div class="timeline-item">
                        <div class="timeline-dot timeline-dot-{{ $evt[0] }}">{{ $evt[1] }}</div>
                        <div class="timeline-content"><div class="timeline-title">{{ $evt[2] }}</div><div class="timeline-meta">{{ $evt[3] }}</div><div class="timeline-body">{{ $evt[4] }}</div></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Journey Status</h3></div>
            <div class="card-body space-y-2 text-sm">
                @foreach([
                    ['Registered','check','emerald'],['Fee Paid','check','emerald'],['Enrolled','check','emerald'],
                    ['Training Complete','check','emerald'],['Exam Passed','check','emerald'],
                    ['Certificate Issued','check','emerald'],['Case Complete','check','emerald'],
                ] as $s)
                <div class="flex items-center gap-2 text-emerald-700">
                    <i data-lucide="{{ $s[1] }}" style="width:14px;height:14px;flex-shrink:0"></i>
                    {{ $s[0] }}
                </div>
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Quick Actions</h3></div>
            <div class="card-body space-y-2">
                <button onclick="openModal('enroll-modal')" class="btn btn-primary w-full btn-sm">New Enrollment</button>
                <button onclick="openModal('payment-modal')" class="btn btn-outline w-full btn-sm">Record Payment</button>
                <button onclick="openModal('close-case-modal')" class="btn btn-danger w-full btn-sm">Close Case</button>
            </div>
        </div>
    </div>
</div>

{{-- Enroll Modal --}}
<div id="enroll-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:480px">
        <div class="modal-header"><span class="modal-title">New Enrollment</span><button onclick="closeModal('enroll-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.students.enroll',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">Select course</option>
                        <option value="PDT-WH">Pre-Departure Training — Warehouse</option>
                        <option value="ENG-INT">English Communication (Intermediate)</option>
                        <option value="ARA-BEG">Arabic Language (Beginners)</option>
                        <option value="CMP-BAS">Computer Literacy — Basic</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Batch</label>
                    <select name="batch_id" class="form-select" required>
                        <option value="">Select batch</option>
                        <option value="BCH-2026-001">BCH-2026-001 — 01 Oct 2026 (6 seats left)</option>
                        <option value="BCH-2026-002">BCH-2026-002 — 20 Oct 2026 (22 seats left)</option>
                    </select>
                </div>
                <div class="alert alert-info text-sm"><i data-lucide="info" style="width:14px;height:14px;flex-shrink:0"></i>Enrollment is confirmed only after course fee is recorded. <a href="{{ route('academy.payments.index') }}" class="underline font-semibold">Record payment →</a></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('enroll-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Enroll</button></div>
        </form>
    </div>
</div>

{{-- Payment Modal --}}
<div id="payment-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Record Payment</span><button onclick="closeModal('payment-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.payments.store') }}">
            @csrf
            <input type="hidden" name="student_id" value="ACD-1001">
            <div class="modal-body space-y-3">
                <div class="form-group"><label class="form-label required">Course</label><input name="course_id" type="text" class="form-input" placeholder="Course code" required></div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="form-group"><label class="form-label required">Amount</label><input name="amount" type="number" min="0.01" step="0.01" class="form-input" required></div>
                    <div class="form-group"><label class="form-label required">Currency</label><select name="currency" class="form-select" required><option value="LKR">LKR</option><option value="USD">USD</option></select></div>
                </div>
                <div class="form-group"><label class="form-label required">Method</label><select name="method" class="form-select" required><option value="cash">Cash</option><option value="Bank Transfer">Bank Transfer</option><option value="Card">Card</option></select></div>
                <div class="form-group"><label class="form-label required">Date Paid</label><input name="paid_on" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                <div class="form-group"><label class="form-label">Reference</label><input name="reference" type="text" class="form-input" placeholder="Receipt / transaction ref."></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('payment-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Record</button></div>
        </form>
    </div>
</div>

{{-- Close Case Modal --}}
<div id="close-case-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Close Student Case</span><button onclick="closeModal('close-case-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.students.close',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Closure Type</label>
                    <select name="close_type" class="form-select" required>
                        <option value="">Select reason type</option>
                        <option value="withdrawn">Student Withdrawal</option>
                        <option value="unresponsive">Unresponsive / No-show</option>
                        <option value="final_fail">Final Failure (all attempts exhausted)</option>
                        <option value="other">Other (specify below)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Closure Reason</label><textarea name="close_reason" rows="4" class="form-textarea" placeholder="Minimum 10 characters. All records will be preserved." required minlength="10"></textarea></div>
                <div class="alert alert-warning text-sm"><i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>All Academy records are preserved. This will NOT close the student's Foreign Employment or Consultancy profile.</div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('close-case-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger" onclick="return confirm('Close this case?')">Close Case</button></div>
        </form>
    </div>
</div>

{{-- Void Certificate Modal --}}
<div id="void-cert-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Void Certificate</span><button onclick="closeModal('void-cert-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.certificates.void',1) }}">
            @csrf
            <div class="modal-body"><div class="form-group"><label class="form-label required">Reason for voiding</label><textarea name="void_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div></div>
            <div class="modal-footer"><button type="button" onclick="closeModal('void-cert-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger" onclick="return confirm('Void this certificate?')">Void Certificate</button></div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
