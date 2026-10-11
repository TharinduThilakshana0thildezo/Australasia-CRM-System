<x-layouts.app title="EXM-001 — Pre-Departure Final Assessment">

<x-page-header
    title="Pre-Departure Final Assessment"
    subtitle="EXM-001 · BCH-2026-001 · 15 Oct 2026 · 100 marks / 50 pass"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.exams.index'),'label'=>'Exams'],['url'=>'#','label'=>'EXM-001']]">
    <x-slot:actions>
        <a href="{{ route('academy.exams.marks',1) }}" class="btn btn-primary btn-sm"><i data-lucide="edit" style="width:14px;height:14px"></i>Enter Marks</a>
        <button onclick="openModal('publish-modal')" class="btn btn-success btn-sm"><i data-lucide="send" style="width:14px;height:14px"></i>Publish Results</button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{tab:'results'}">
    <div class="lg:col-span-2">
        <div class="tab-bar mb-5">
            <button @click="tab='results'" :class="tab==='results'?'tab-active':'tab'" class="tab">Results</button>
            <button @click="tab='details'" :class="tab==='details'?'tab-active':'tab'" class="tab">Exam Details</button>
            <button @click="tab='history'" :class="tab==='history'?'tab-active':'tab'" class="tab">Attempt History</button>
        </div>

        {{-- Results --}}
        <div x-show="tab==='results'" class="card">
            <div class="card-header">
                <h3 class="card-title">Results — 24 Students</h3>
                <div class="flex gap-2">
                    <span class="badge badge-approved">22 Passed</span>
                    <span class="badge badge-rejected">2 Failed</span>
                    <span class="badge badge-draft">Status: Draft</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Eligibility</th><th>Marks</th><th>%</th><th>Outcome</th><th>Attempt</th><th>Actions</th></tr></thead>
                    <tbody>
                        @php
                        $results=[
                            ['ACD-1001','Kamal Pradeep','Eligible',76,76,'Pass',1],
                            ['ACD-1002','Nimesha Silva','Eligible',68,68,'Pass',1],
                            ['ACD-1003','Samantha Perera','Eligible',82,82,'Pass',1],
                            ['ACD-1004','Thilina Jayawardena','Eligible',55,55,'Pass',1],
                            ['ACD-1005','Dulani Wickramasinghe','Eligible',91,91,'Pass',1],
                            ['ACD-1006','Asanka Fernando','Eligible',61,61,'Pass',1],
                            ['ACD-1007','Chamari Ranasinghe','⚠ Below Threshold',44,44,'Fail — Re-sit',1],
                            ['ACD-1008','Roshan Dissanayake','⚠ Below Threshold',38,38,'Fail — Re-sit',1],
                        ];
                        @endphp
                        @foreach($results as $r)
                        <tr>
                            <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $r[1] }}</a><p class="text-xs text-slate-400">{{ $r[0] }}</p></td>
                            <td class="text-sm {{ str_contains($r[2],'⚠')?'text-rose-600 font-semibold':'' }}">{{ $r[2] }}</td>
                            <td class="text-sm font-bold text-slate-800">{{ $r[3] }}/100</td>
                            <td class="text-sm font-bold {{ $r[4]>=50?'text-emerald-600':'text-rose-600' }}">{{ $r[4] }}%</td>
                            <td>
                                <span class="badge {{ str_contains($r[5],'Pass')?'badge-approved':'badge-rejected' }}">{{ $r[5] }}</span>
                            </td>
                            <td class="text-sm text-slate-500">{{ $r[6] }}st</td>
                            <td>
                                @if(str_contains($r[5],'Fail'))
                                <button onclick="openModal('resit-modal')" class="btn btn-warning btn-xs">Re-sit</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Exam Details --}}
        <div x-show="tab==='details'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Exam Information</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm mb-4">
                    @foreach([['Exam ID','EXM-001'],['Course','Pre-Departure — Warehouse'],['Batch','BCH-2026-001'],['Type','Written Examination'],['Date','15 Oct 2026'],['Examiner','Mr. Rupasinghe'],['Max Marks','100'],['Pass Marks','50'],['Status','Draft']] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
                <div><p class="text-xs text-slate-400 mb-1">Instructions</p><p class="text-sm text-slate-700">Students must answer all questions. No electronic devices permitted. Duration: 2 hours. Books allowed: none.</p></div>
            </div>
        </div>

        {{-- Attempt History --}}
        <div x-show="tab==='history'" class="card" style="display:none">
            <div class="card-header"><h3 class="card-title">Attempt History for Failed Students</h3></div>
            <div class="card-body">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Attempt</th><th>Exam</th><th>Date</th><th>Marks</th><th>Outcome</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['Chamari Ranasinghe',1,'EXM-001','15 Oct 2026','44/100','Fail'],
                            ['Roshan Dissanayake',1,'EXM-001','15 Oct 2026','38/100','Fail'],
                        ] as $h)
                        <tr>
                            <td class="text-sm font-semibold text-slate-800">{{ $h[0] }}</td>
                            <td class="text-sm text-slate-500">{{ $h[1] }}st</td>
                            <td class="text-xs font-mono text-slate-500">{{ $h[2] }}</td>
                            <td class="text-xs text-slate-500">{{ $h[3] }}</td>
                            <td class="text-sm font-bold text-rose-600">{{ $h[4] }}</td>
                            <td><span class="badge badge-rejected">{{ $h[5] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-xs text-slate-400 mt-3">All previous attempts are preserved permanently and cannot be deleted.</p>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-4">
        <div class="card">
            <div class="card-body text-center space-y-3">
                <div class="text-3xl font-extrabold text-emerald-600">92%</div>
                <div class="text-xs text-slate-400">Pass Rate</div>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div class="bg-emerald-50 rounded-xl p-2"><span class="font-bold text-emerald-700">22</span><p class="text-xs text-slate-400">Passed</p></div>
                    <div class="bg-rose-50 rounded-xl p-2"><span class="font-bold text-rose-700">2</span><p class="text-xs text-slate-400">Failed</p></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Actions</h3></div>
            <div class="card-body space-y-2">
                <a href="{{ route('academy.exams.marks',1) }}" class="btn btn-primary w-full btn-sm">Enter/Edit Marks</a>
                <button onclick="openModal('publish-modal')" class="btn btn-success w-full btn-sm">Publish Results</button>
                <button onclick="openModal('resit-modal')" class="btn btn-warning w-full btn-sm">Schedule Re-sit</button>
            </div>
        </div>
    </div>
</div>

{{-- Publish Modal --}}
<div id="publish-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Publish Results</span><button onclick="closeModal('publish-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.exams.publish',1) }}">
            @csrf
            <div class="modal-body">
                <div class="alert alert-warning mb-3 text-sm"><i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>Once published, results are visible to authorized staff. Passed students will become eligible for certificate issuance.</div>
                <div class="form-group"><label class="form-label">Publication Notes</label><textarea name="publish_notes" rows="3" class="form-textarea" placeholder="Optional notes about result publication…"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('publish-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-success">Publish Results</button></div>
        </form>
    </div>
</div>

{{-- Re-sit Modal --}}
<div id="resit-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Schedule Re-sit</span><button onclick="closeModal('resit-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.exams.resit.schedule',1) }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="ACD-1007">ACD-1007 — Chamari Ranasinghe (44/100)</option>
                        <option value="ACD-1008">ACD-1008 — Roshan Dissanayake (38/100)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Re-sit Date</label><input name="resit_date" type="date" class="form-input" required></div>
                <div class="form-group"><label class="form-label">Notes</label><textarea name="resit_reason" rows="2" class="form-textarea"></textarea></div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('resit-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-warning">Schedule Re-sit</button></div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
