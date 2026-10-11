<x-layouts.app title="Payments — Academy">

<x-page-header
    title="Fee Payments"
    subtitle="Course fee payment records and outstanding balances"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Payments']]">
    <x-slot:actions>
        <button onclick="openModal('payment-modal')" class="btn btn-primary btn-sm"><i data-lucide="plus" style="width:14px;height:14px"></i>Record Payment</button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-warning mb-5">
    <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0"></i>
    <div><strong>Unpaid Enrollment Policy — Pending Confirmation</strong>
        <p class="text-sm mt-0.5">The policy for holding or releasing seats for students with unpaid fees is not yet confirmed. <a href="{{ route('academy.settings') }}" class="underline font-semibold">Configure in Settings</a>.</p>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['18','Fee Pending','credit-card','rose'],['134','Fully Paid','check-circle','emerald'],['LKR 670K','Collected This Month','trending-up','indigo'],['LKR 90K','Outstanding','alert-circle','amber']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

{{-- Outstanding fees --}}
<div class="card mb-5 border-rose-200">
    <div class="card-header bg-rose-50"><div class="flex items-center gap-2"><i data-lucide="alert-circle" style="width:18px;height:18px;color:#ef4444"></i><h3 class="card-title text-rose-700">18 Students with Outstanding Fees</h3></div></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Course</th><th>Fee Due</th><th>Enrolled On</th><th>Action</th></tr></thead>
            <tbody>
                @foreach([
                    ['ACD-1005','Dulani Wickramasinghe','Arabic Language','LKR 14,000','19 Aug'],
                    ['ACD-1006','Asanka Fernando','Pre-Departure — HOS','LKR 6,000','20 Aug'],
                    ['ACD-1011','Ishara Perera','Computer Literacy','LKR 8,000','22 Aug'],
                ] as $r)
                <tr>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $r[1] }}</a><p class="text-xs text-slate-400">{{ $r[0] }}</p></td>
                    <td class="text-sm text-slate-600">{{ $r[2] }}</td>
                    <td class="text-sm font-bold text-rose-600">{{ $r[3] }}</td>
                    <td class="text-xs text-slate-500">{{ $r[4] }}</td>
                    <td><button onclick="openModal('payment-modal')" class="btn btn-primary btn-xs">Record Payment</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- All Payments --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="pay-search" type="text" class="search-input" placeholder="Search student, payment ID, reference…">
            </div>
            <select id="pay-method" class="form-select" style="width:auto">
                <option value="">All Methods</option>
                <option>Cash</option><option>Bank Transfer</option><option>Card</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">Payment Ledger</h3><p class="text-xs text-amber-600">Financial records are permanent and cannot be deleted.</p></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Payment ID</th><th>Student</th><th>Course</th><th>Amount</th><th>Method</th><th>Date</th><th>Reference</th><th>Recorded By</th></tr></thead>
            <tbody>
                @foreach([
                    ['PAY-ACD-88421','ACD-1001','Kamal Pradeep','Pre-Departure — WH','LKR 5,000','Bank Transfer','15 Aug 2026','REF-BT-1122','Kasun B.'],
                    ['PAY-ACD-88422','ACD-1002','Nimesha Silva','English Comm.','LKR 12,000','Cash','16 Aug 2026','—','Priya H.'],
                    ['PAY-ACD-88423','ACD-1003','Samantha Perera','Pre-Departure — WH','LKR 5,000','Bank Transfer','17 Aug 2026','REF-BT-1198','Kasun B.'],
                    ['PAY-ACD-88424','ACD-1004','Thilina Jayawardena','Arabic Language','LKR 14,000','Card','18 Aug 2026','CARD-4521','Nimal J.'],
                ] as $p)
                <tr>
                    <td class="font-mono text-xs text-indigo-600">{{ $p[0] }}</td>
                    <td><a href="{{ route('academy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $p[2] }}</a><p class="text-xs text-slate-400">{{ $p[1] }}</p></td>
                    <td class="text-sm text-slate-600">{{ $p[3] }}</td>
                    <td class="text-sm font-bold text-slate-800">{{ $p[4] }}</td>
                    <td class="text-sm text-slate-600">{{ $p[5] }}</td>
                    <td class="text-xs text-slate-500">{{ $p[6] }}</td>
                    <td class="font-mono text-xs text-slate-400">{{ $p[7] }}</td>
                    <td class="text-sm text-slate-500">{{ $p[8] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Record Payment Modal --}}
<div id="payment-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:480px">
        <div class="modal-header"><span class="modal-title">Record Payment</span><button onclick="closeModal('payment-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.payments.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="grid grid-cols-2 gap-3">
                    <div class="form-group col-span-2"><label class="form-label required">Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">Select student</option>
                            <option value="ACD-1005">ACD-1005 — Dulani Wickramasinghe</option>
                            <option value="ACD-1006">ACD-1006 — Asanka Fernando</option>
                        </select>
                    </div>
                    <div class="form-group col-span-2"><label class="form-label required">Course</label>
                        <select name="course_id" class="form-select" required>
                            <option value="">Select course</option>
                            <option>Pre-Departure — Warehouse (LKR 5,000)</option>
                            <option>Arabic Language — Beginners (LKR 14,000)</option>
                            <option>English Communication (LKR 12,000)</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Amount</label><input name="amount" type="number" min="0.01" step="0.01" class="form-input" required></div>
                    <div class="form-group"><label class="form-label required">Currency</label><select name="currency" class="form-select" required><option value="LKR">LKR</option><option value="USD">USD</option></select></div>
                    <div class="form-group"><label class="form-label required">Method</label>
                        <select name="method" class="form-select" required>
                            <option value="cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Card">Card</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Date Paid</label><input name="paid_on" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                    <div class="form-group col-span-2"><label class="form-label">Reference / Receipt No.</label><input name="reference" type="text" class="form-input" placeholder="Optional"></div>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('payment-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Record Payment</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    const s=document.getElementById('pay-search');
    s?.addEventListener('input',()=>{const q=s.value.toLowerCase();document.querySelectorAll('.data-table tbody tr').forEach(r=>{r.style.display=!q||r.textContent.toLowerCase().includes(q)?'':'none';});});
});
</script>
</x-layouts.app>
