<!-- Payments Tab -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payments</h3>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i> Record Payment
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Date</th>
                    <th>Recorded By</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-mono text-sm text-indigo-600">PMT-000842</td>
                    <td class="text-sm text-slate-700">Registration Fee</td>
                    <td class="font-bold text-slate-800">LKR 15,000</td>
                    <td class="text-sm text-slate-600">Bank Transfer</td>
                    <td class="text-sm text-slate-600">16 Sep 2026</td>
                    <td class="text-sm text-slate-600">Finance Dept</td>
                    <td><x-status-badge status="paid" /></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="text-xs text-slate-500">
            <strong class="text-emerald-600">Note:</strong> Registration fee is refundable under the Foreign Employment refund policy.
        </div>
    </div>
</div>
