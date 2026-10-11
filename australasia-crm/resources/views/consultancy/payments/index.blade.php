<x-layouts.app title="Payments — Consultancy">

<x-page-header
    title="Payments"
    subtitle="All consultancy payment records — registration fees, final fees, and refunds"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Payments']]">
    <x-slot:actions>
        <button onclick="openModal('record-payment-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>Record Payment
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-info mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>⚠ Refund Policy — Pending Confirmation:</strong> The consultancy registration fee refund policy has not yet been confirmed by management. Do not apply or promise refunds without director authorization.
        <a href="{{ route('consultancy.settings') }}" class="underline font-semibold ml-1">Configure in Settings →</a>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([
        ['LKR 2.3M','Total Collected (Oct)','credit-card','emerald'],
        ['14','Reg. Fee Pending','clock','amber'],
        ['6','Final Fee Pending','banknote','rose'],
        ['LKR 0','Refunds Issued (TBC)','rotate-ccw','slate'],
    ] as $k)
    <div class="stat-card">
        <div class="stat-accent" style="background:{{ ['emerald'=>'#10b981','amber'=>'#f59e0b','rose'=>'#f43f5e','slate'=>'#64748b'][$k[3]] }}"></div>
        <div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-5 h-5 text-{{ $k[3] }}-600"></i></div>
        <div class="stat-value">{{ $k[0] }}</div>
        <div class="stat-label">{{ $k[1] }}</div>
    </div>
    @endforeach
</div>

{{-- Pending Reg Fees --}}
<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">Registration Fee Pending</h3>
        <span class="badge badge-pending">14 students awaiting fee</span>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Student</th><th>Registered</th><th>Consultant</th><th>Days Overdue</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach([
                    ['Amara Dissanayake','CON-0085','20 Sep 2026','Amila P.',20],
                    ['Roshan Wijesinghe','CON-0082','06 Oct 2026','Kasun B.',4],
                    ['Nimasha Pathirana','CON-0091','10 Oct 2026','Priya H.',0],
                    ['Tharaka Silva','CON-0090','09 Oct 2026','Kasun B.',1],
                ] as $p)
                <tr>
                    <td><a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $p[0] }}</a><p class="text-xs text-slate-400">{{ $p[1] }}</p></td>
                    <td class="text-xs text-slate-500">{{ $p[2] }}</td>
                    <td class="text-sm text-slate-600">{{ $p[3] }}</td>
                    <td><span class="{{ $p[4]>7?'badge badge-refund':($p[4]>0?'badge badge-pending':'badge badge-lead') }}">{{ $p[4] > 0 ? "{$p[4]}d overdue" : 'Today' }}</span></td>
                    <td><button onclick="openModal('record-payment-modal')" class="btn btn-primary btn-xs">Record Fee</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- All Payments --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Payment Records</h3>
        <div class="search-wrapper" style="width:240px">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" class="search-input" placeholder="Search student, receipt…">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Payment ID</th><th>Student</th><th>Type</th><th>Amount</th><th>Currency</th><th>Method</th><th>Date</th><th>Reference</th><th>Recorded By</th></tr></thead>
            <tbody>
                @php
                $payments=[
                    ['PAY-CON-89042','Sachini Ranasinghe','CON-0089','Final Fee',75000,'LKR','Card','08 Oct 2026','REF-CC-1047','Finance'],
                    ['PAY-CON-88031','Sachini Ranasinghe','CON-0089','Registration',25000,'LKR','Bank Transfer','05 Aug 2026','REF-BT-0841','Kasun B.'],
                    ['PAY-CON-88018','Kavinda Gunasekara','CON-0088','Registration',25000,'LKR','Cash','12 Aug 2026','RCP-CON-0051','Amila P.'],
                    ['PAY-CON-88019','Kavinda Gunasekara','CON-0088','Final Fee',80000,'LKR','Bank Transfer','22 Aug 2026','REF-BT-0920','Finance'],
                    ['PAY-CON-84011','Ruwan Bandara','CON-0084','Registration',25000,'LKR','Card','10 Jul 2026','REF-CC-0781','Priya H.'],
                    ['PAY-CON-84012','Ruwan Bandara','CON-0084','Final Fee',75000,'LKR','Bank Transfer','20 Aug 2026','REF-BT-0855','Finance'],
                    ['PAY-CON-83009','Chamari Dias','CON-0083','Registration',25000,'LKR','Cash','22 Jul 2026','RCP-CON-0042','Priya H.'],
                    ['PAY-CON-80007','Indika Chandrasena','CON-0080','Registration',25000,'LKR','Bank Transfer','17 Jun 2026','REF-BT-0720','Nimal J.'],
                ];
                @endphp
                @foreach($payments as $p)
                <tr>
                    <td><span class="font-mono text-xs text-indigo-600">{{ $p[0] }}</span></td>
                    <td><a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $p[1] }}</a><p class="text-xs text-slate-400">{{ $p[2] }}</p></td>
                    <td><span class="badge {{ $p[3]==='Registration'?'badge-pending':'badge-approved' }}">{{ $p[3] }}</span></td>
                    <td class="text-sm font-bold text-slate-800">{{ number_format($p[4]) }}</td>
                    <td class="text-sm text-slate-600">{{ $p[5] }}</td>
                    <td class="text-sm text-slate-600">{{ $p[6] }}</td>
                    <td class="text-xs text-slate-500">{{ $p[7] }}</td>
                    <td class="font-mono text-xs text-slate-500">{{ $p[8] }}</td>
                    <td class="text-sm text-slate-500">{{ $p[9] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <p class="text-xs text-slate-400">Payment records are permanent and cannot be deleted. Contact a director for any disputes.</p>
    </div>
</div>

{{-- Record Payment Modal --}}
<div id="record-payment-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:500px">
        <div class="modal-header"><span class="modal-title">Record Payment</span><button onclick="closeModal('record-payment-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.payments.store') }}">
            @csrf
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2">
                        <label class="form-label required">Student ID</label>
                        <input name="student_id" type="text" class="form-input" placeholder="e.g. CON-0089" required>
                    </div>
                    <div class="form-group col-span-2">
                        <label class="form-label required">Payment Type</label>
                        <select name="payment_type" class="form-select" required>
                            <option value="registration">Registration Fee</option>
                            <option value="final">Final Consultancy Fee</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-label required">Amount</label><input name="amount" type="number" min="0.01" step="0.01" class="form-input" placeholder="0.00" required></div>
                    <div class="form-group"><label class="form-label required">Currency</label>
                        <select name="currency" class="form-select" required><option value="LKR">LKR</option><option value="USD">USD</option><option value="AUD">AUD</option><option value="GBP">GBP</option></select>
                    </div>
                    <div class="form-group"><label class="form-label required">Method</label>
                        <select name="method" class="form-select" required><option value="cash">Cash</option><option value="Bank Transfer">Bank Transfer</option><option value="Card">Card</option><option value="Cheque">Cheque</option></select>
                    </div>
                    <div class="form-group"><label class="form-label required">Date Paid</label><input name="paid_on" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                    <div class="form-group col-span-2"><label class="form-label">Reference / Receipt No.</label><input name="reference" type="text" class="form-input" placeholder="e.g. REF-BT-0001"></div>
                </div>
                <div class="alert alert-warning mt-3 text-xs">
                    <i data-lucide="alert-triangle" style="width:14px;height:14px;flex-shrink:0"></i>
                    Only record payments with actual receipt or written authorization. Records cannot be deleted.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('record-payment-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary"><i data-lucide="check" style="width:14px;height:14px"></i>Record Payment</button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
