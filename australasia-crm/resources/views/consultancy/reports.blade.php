<x-layouts.app title="Reports — Consultancy">

<x-page-header
    title="Consultancy Reports"
    subtitle="Analytics, performance metrics, and exportable reports for the consultancy pipeline"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Reports']]">
    <x-slot:actions>
        <button class="btn btn-secondary btn-sm" onclick="window.print()">
            <i data-lucide="printer" style="width:14px;height:14px"></i>Print
        </button>
        <button class="btn btn-primary btn-sm">
            <i data-lucide="download" style="width:14px;height:14px"></i>Export CSV
        </button>
    </x-slot:actions>
</x-page-header>

{{-- Date Range --}}
<div class="card mb-6">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <label class="text-sm font-medium text-slate-600">Date Range:</label>
            <select class="form-select" style="width:auto">
                <option>This Month (Oct 2026)</option>
                <option>Last Month (Sep 2026)</option>
                <option>This Quarter</option>
                <option>This Year</option>
                <option>All Time</option>
                <option>Custom Range</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Consultants</option>
                <option>Priya Hewage</option>
                <option>Kasun Bandara</option>
                <option>Nimal Jayawardena</option>
                <option>Amila Perera</option>
            </select>
            <select class="form-select" style="width:auto">
                <option>All Countries</option>
                <option>Australia</option>
                <option>UK</option>
                <option>Canada</option>
                <option>New Zealand</option>
                <option>USA</option>
            </select>
            <button class="btn btn-primary btn-sm">Apply Filters</button>
        </div>
    </div>
</div>

{{-- KPI Summary --}}
<div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-8 gap-3 mb-6">
    @php $reportKPIs = [
        ['New Leads','22','user','slate'],['Registered','42','users','violet'],['Fee Collected','89','credit-card','emerald'],
        ['Docs Reviewed','134','file-check','amber'],['Sessions','41','message-circle','cyan'],['Applications','34','file-text','blue'],
        ['Offers','19','inbox','indigo'],['Enrolled','7','graduation-cap','teal'],
    ]; @endphp
    @foreach($reportKPIs as $k)
    <div class="stat-card">
        <div class="stat-icon bg-{{ $k[3] }}-100"><i data-lucide="{{ $k[2] }}" class="w-4 h-4 text-{{ $k[3] }}-600"></i></div>
        <div class="stat-value text-xl">{{ $k[1] }}</div>
        <div class="stat-label text-xs">{{ $k[0] }}</div>
    </div>
    @endforeach
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
    {{-- Monthly Trend --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Monthly Registrations vs Enrollments</h3></div>
        <div class="card-body"><canvas id="rptTrendChart" height="220"></canvas></div>
    </div>
    {{-- Conversion Funnel --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Conversion Funnel</h3></div>
        <div class="card-body">
            @php $funnel=[['Leads',22,'#64748b'],['Registered',89,'#8b5cf6'],['Docs Approved',67,'#6366f1'],['Counselled',57,'#3b82f6'],['Applied',34,'#06b6d4'],['Offer Received',19,'#10b981'],['Visa Approved',15,'#14b8a6'],['Enrolled',12,'#22c55e']]; @endphp
            <div class="space-y-2">
                @foreach($funnel as $stage)
                @php $pct = $stage[1] / 89 * 100; @endphp
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-600 font-medium">{{ $stage[0] }}</span>
                        <span class="font-bold text-slate-800">{{ $stage[1] }}</span>
                    </div>
                    <div class="progress-bar-track">
                        <div class="progress-bar-fill rounded-full" style="width:{{ $pct }}%;background:{{ $stage[2] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
    {{-- By Country --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Students by Country</h3></div>
        <div class="card-body"><canvas id="rptCountryChart" height="230"></canvas></div>
    </div>
    {{-- By Source --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Leads by Source</h3></div>
        <div class="card-body"><canvas id="rptSourceChart" height="230"></canvas></div>
    </div>
    {{-- By Consultant --}}
    <div class="card">
        <div class="card-header"><h3 class="card-title">Cases by Consultant</h3></div>
        <div class="card-body">
            @foreach([['Priya Hewage',34,85],['Kasun Bandara',28,70],['Nimal Jayawardena',22,55],['Amila Perera',19,47.5]] as $c)
            <div class="mb-3">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-slate-600">{{ $c[0] }}</span>
                    <span class="font-bold text-slate-800">{{ $c[1] }} cases</span>
                </div>
                <div class="progress-bar-track"><div class="progress-bar-fill bg-indigo-500" style="width:{{ $c[2] }}%"></div></div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Revenue Summary --}}
<div class="card mb-6">
    <div class="card-header"><h3 class="card-title">Revenue Summary (Oct 2026)</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Category</th><th>Count</th><th>Amount (LKR)</th><th>vs Last Month</th></tr></thead>
            <tbody>
                @foreach([
                    ['Registration Fees (new)',14,'350,000','+4'],
                    ['Final Consultancy Fees',6,'525,000','+2'],
                    ['Total Collected','20','875,000','+28%'],
                    ['Refunds Issued (TBC)','0','0','N/A — Policy Pending'],
                ] as $r)
                <tr>
                    <td class="text-sm font-medium text-slate-700">{{ $r[0] }}</td>
                    <td class="text-sm text-slate-600">{{ $r[1] }}</td>
                    <td class="text-sm font-bold text-slate-800">LKR {{ $r[2] }}</td>
                    <td class="{{ str_contains($r[3],'+') ? 'text-emerald-600':'text-slate-500' }} text-sm font-semibold">{{ $r[3] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <p class="text-xs text-amber-700 bg-amber-50 border border-amber-200 rounded-lg p-2">⚠ Refund figures are showing 0 as refund policy is pending management confirmation. See Settings.</p>
    </div>
</div>

{{-- Top Institutions --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Top Institutions by Applications</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Institution</th><th>Country</th><th>Applications</th><th>Offers</th><th>Accepted</th><th>Offer Rate</th></tr></thead>
            <tbody>
                @foreach([
                    ['Monash University','Australia',14,11,9,'79%'],
                    ['Univ. of Manchester','UK',7,4,4,'57%'],
                    ['UCL London','UK',5,2,2,'40%'],
                    ['RMIT University','Australia',9,7,6,'78%'],
                    ['Deakin University','Australia',6,5,5,'83%'],
                ] as $inst)
                <tr>
                    <td class="text-sm font-semibold text-slate-800">{{ $inst[0] }}</td>
                    <td class="text-sm text-slate-600">{{ $inst[1] }}</td>
                    <td class="text-sm text-slate-600">{{ $inst[2] }}</td>
                    <td class="text-sm text-emerald-600 font-semibold">{{ $inst[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $inst[4] }}</td>
                    <td><div class="flex items-center gap-2"><span class="text-sm font-bold text-slate-700">{{ $inst[5] }}</span><div class="progress-bar-track w-16"><div class="progress-bar-fill bg-indigo-500" style="width:{{ $inst[5] }}"></div></div></div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    new Chart(document.getElementById('rptTrendChart'), {
        type:'line',
        data:{
            labels:['May','Jun','Jul','Aug','Sep','Oct'],
            datasets:[
                {label:'Registrations',data:[18,22,31,28,35,42],borderColor:'#8b5cf6',backgroundColor:'rgba(139,92,246,0.07)',fill:true,tension:0.4,pointRadius:4,pointBackgroundColor:'#8b5cf6'},
                {label:'Enrollments',data:[4,6,8,9,10,7],borderColor:'#10b981',backgroundColor:'rgba(16,185,129,0.07)',fill:true,tension:0.4,pointRadius:4,pointBackgroundColor:'#10b981'},
            ]
        },
        options:{responsive:true,plugins:{legend:{position:'bottom',labels:{font:{family:'Inter',size:11}}}},scales:{y:{beginAtZero:true,grid:{color:'rgba(0,0,0,0.04)'}},x:{grid:{display:false}}}}
    });
    new Chart(document.getElementById('rptCountryChart'),{
        type:'doughnut',
        data:{labels:['Australia','UK','Canada','New Zealand','USA'],datasets:[{data:[38,24,18,12,8],backgroundColor:['#6366f1','#8b5cf6','#10b981','#06b6d4','#f59e0b'],borderWidth:3,borderColor:'#fff'}]},
        options:{responsive:true,cutout:'60%',plugins:{legend:{position:'bottom',labels:{font:{family:'Inter',size:11}}}}}
    });
    new Chart(document.getElementById('rptSourceChart'),{
        type:'bar',
        data:{
            labels:['Walk-in','Referral','Online','Agent','Social'],
            datasets:[{label:'Leads',data:[28,32,20,14,6],backgroundColor:['#6366f1','#8b5cf6','#10b981','#f59e0b','#06b6d4'],borderRadius:6}]
        },
        options:{responsive:true,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,grid:{color:'rgba(0,0,0,0.04)'}},x:{grid:{display:false}}}}
    });
});
</script>
</x-layouts.app>
