<x-layouts.app title="Make-up Sessions — Academy">

<x-page-header
    title="Make-up Sessions"
    subtitle="Schedule and track attendance make-up for below-threshold students"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.attendance.index'),'label'=>'Attendance'],['url'=>'#','label'=>'Make-up Sessions']]">
    <x-slot:actions>
        <button onclick="openModal('makeup-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Schedule Make-up</button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-warning mb-5">
    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div>
        <strong>Attendance Threshold Policy (Pending Confirmation)</strong>
        <p class="text-sm mt-0.5">The minimum attendance percentage for exam eligibility is configurable.
        Currently set to <strong>75%</strong> (default) — <a href="{{ route('academy.settings') }}" class="underline font-semibold">update in Settings</a>.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    {{-- Students needing make-up --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Students Requiring Make-up</h3></div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Student</th><th>Batch</th><th>Attendance</th><th>Gap to Threshold</th></tr></thead>
                <tbody>
                    @foreach([
                        ['ACD-1007','Chamari Ranasinghe','BCH-2026-001','62%','13%'],
                        ['ACD-1015','Roshan Kumara','BCH-2026-002','58%','17%'],
                        ['ACD-1022','Amali Jayasiri','BCH-2026-003','71%','4%'],
                    ] as $b)
                    <tr>
                        <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $b[1] }}</a><p class="text-xs text-slate-400">{{ $b[0] }}</p></td>
                        <td class="text-xs font-mono text-slate-500">{{ $b[2] }}</td>
                        <td class="text-sm font-bold text-rose-600">{{ $b[3] }}</td>
                        <td class="text-sm font-bold text-amber-600">{{ $b[4] }} needed</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Scheduled Make-up Sessions --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Scheduled Make-up Sessions</h3></div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead><tr><th>Student</th><th>Original Session</th><th>Make-up Date</th><th>Status</th></tr></thead>
                <tbody>
                    @foreach([
                        ['Chamari Ranasinghe','SES-002','12 Oct 2026','scheduled'],
                        ['Roshan Kumara','SES-001','13 Oct 2026','scheduled'],
                        ['Chamari Ranasinghe','SES-001','10 Oct 2026','completed'],
                    ] as $mu)
                    <tr>
                        <td class="text-sm font-semibold text-slate-800">{{ $mu[0] }}</td>
                        <td class="text-xs font-mono text-slate-500">{{ $mu[1] }}</td>
                        <td class="text-xs text-slate-500">{{ $mu[2] }}</td>
                        <td><x-status-badge :status="$mu[3]" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Schedule Make-up Modal --}}
<div id="makeup-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:460px">
        <div class="modal-header"><span class="modal-title">Schedule Make-up Session</span><button onclick="closeModal('makeup-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.attendance.makeup.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select student</option>
                        <option value="ACD-1007">ACD-1007 — Chamari Ranasinghe (62%)</option>
                        <option value="ACD-1015">ACD-1015 — Roshan Kumara (58%)</option>
                        <option value="ACD-1022">ACD-1022 — Amali Jayasiri (71%)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Original Session Missed</label>
                    <select name="session_id" class="form-select" required>
                        <option value="">Select missed session</option>
                        <option value="SES-001">SES-001 — Workplace Safety (01 Oct)</option>
                        <option value="SES-002">SES-002 — Hazard Awareness (03 Oct)</option>
                        <option value="SES-003">SES-003 — Equipment Handling (05 Oct)</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Make-up Date</label>
                    <input name="makeup_date" type="date" class="form-input" required>
                </div>
                <div class="form-group"><label class="form-label required">Reason / Arrangement</label>
                    <textarea name="reason" rows="3" class="form-textarea" required placeholder="Describe the make-up arrangement…"></textarea>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('makeup-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Schedule Make-up</button></div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
