<x-layouts.app title="Finance Dashboard">

<x-page-header
    title="Finance"
    subtitle="Revenue, payments, invoices and refunds across all modules"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Finance']]">
    <x-slot:actions>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            Record Payment
        </button>
    </x-slot:actions>
</x-page-header>

<!-- KPIs -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-stat-card value="LKR 7.1M" label="Revenue (Oct)"   icon="trending-up"   color="emerald" />
    <x-stat-card value="28"       label="Pending Payments" icon="clock"         color="amber" />
    <x-stat-card value="14"       label="Refund Cases"     icon="rotate-ccw"    color="rose" />
    <x-stat-card value="142"      label="Transactions"     icon="credit-card"   color="indigo" />
</div>

<!-- Chart + Recent transactions -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
    <div class="card xl:col-span-2">
        <div class="card-header"><h3 class="card-title">Revenue Trend</h3></div>
        <div class="card-body">
            <canvas id="financeChart" height="200"></canvas>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3 class="card-title">Revenue by Module</h3></div>
        <div class="card-body">
            <canvas id="moduleRevenueChart" height="200"></canvas>
            <div class="mt-4 space-y-2">
                @foreach([['Foreign Employment','LKR 4.8M','#6366f1'], ['Consultancy','LKR 1.6M','#a855f7'], ['Academy','LKR 0.7M','#10b981']] as $m)
                <div class="flex justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-sm" style="background:{{ $m[2] }}"></span>
                        <span class="text-slate-600">{{ $m[0] }}</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $m[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Recent Transactions</h3>
        <a href="#" class="text-sm text-indigo-600 font-semibold">View all →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Person</th>
                    <th>Type</th>
                    <th>Module</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $txns = [
                    ['id' => 'PMT-000901', 'person' => 'Thilini Madushan',    'type' => 'Registration Fee', 'module' => 'Employment',   'amount' => 'LKR 15,000', 'method' => 'Bank Transfer', 'date' => '06 Oct 2026', 'status' => 'paid'],
                    ['id' => 'PMT-000900', 'person' => 'Sachini Ranasinghe',  'type' => 'Consultancy Fee',  'module' => 'Consultancy',  'amount' => 'LKR 45,000', 'method' => 'Cash',          'date' => '05 Oct 2026', 'status' => 'paid'],
                    ['id' => 'PMT-000899', 'person' => 'Kavinda Gunasekara',  'type' => 'Course Fee',       'module' => 'Academy',      'amount' => 'LKR 8,500',  'method' => 'Online',        'date' => '05 Oct 2026', 'status' => 'paid'],
                    ['id' => 'REF-000014', 'person' => 'Ruwan Pathirana',     'type' => 'Refund',           'module' => 'Employment',   'amount' => 'LKR 15,000', 'method' => 'Bank Transfer', 'date' => '04 Oct 2026', 'status' => 'processing'],
                    ['id' => 'PMT-000897', 'person' => 'Chamari Dias',        'type' => 'Registration Fee', 'module' => 'Employment',   'amount' => 'LKR 15,000', 'method' => 'Cash',          'date' => '03 Oct 2026', 'status' => 'pending'],
                ];
                @endphp
                @foreach($txns as $t)
                <tr>
                    <td><code class="font-mono text-sm text-indigo-600">{{ $t['id'] }}</code></td>
                    <td class="text-sm font-semibold text-slate-800">{{ $t['person'] }}</td>
                    <td class="text-sm text-slate-600">{{ $t['type'] }}</td>
                    <td><span class="badge badge-employer">{{ $t['module'] }}</span></td>
                    <td class="font-bold text-slate-800">{{ $t['amount'] }}</td>
                    <td class="text-sm text-slate-600">{{ $t['method'] }}</td>
                    <td class="text-sm text-slate-500">{{ $t['date'] }}</td>
                    <td><x-status-badge :status="$t['status']" /></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('financeChart'), {
        type: 'line',
        data: {
            labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            datasets: [{
                label: 'Revenue (LKR)',
                data: [3200000, 4800000, 4100000, 5900000, 6200000, 5400000, 7100000],
                borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,0.1)',
                fill: true, tension: 0.4, pointRadius: 4, pointBackgroundColor: '#6366f1',
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: {
            y: { beginAtZero: true, ticks: { callback: v => 'LKR ' + (v/1000000).toFixed(1) + 'M' }, grid: { color: 'rgba(0,0,0,0.04)' } },
            x: { grid: { display: false } }
        }}
    });
    new Chart(document.getElementById('moduleRevenueChart'), {
        type: 'doughnut',
        data: {
            labels: ['Foreign Employment', 'Consultancy', 'Academy'],
            datasets: [{ data: [4800000, 1600000, 700000], backgroundColor: ['#6366f1', '#a855f7', '#10b981'], borderWidth: 3, borderColor: '#fff' }]
        },
        options: { responsive: true, cutout: '60%', plugins: { legend: { display: false } } }
    });
    lucide.createIcons();
});
</script>
</x-layouts.app>
