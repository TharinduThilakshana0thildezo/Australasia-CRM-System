<x-layouts.app title="Enrollment ENR-ACD-0047">

<x-page-header
    title="Enrollment ENR-ACD-0047"
    subtitle="Kamal Pradeep · Pre-Departure Training — Warehouse · Completed"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>route('academy.enrollments.index'),'label'=>'Enrollments'],['url'=>'#','label'=>'ENR-ACD-0047']]">
</x-page-header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Enrollment Details</h3><x-status-badge status="completed" /></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['Enrollment ID','ENR-ACD-0047'],['Student','Kamal Pradeep (ACD-1001)'],['Course','Pre-Departure — Warehouse'],
                        ['Batch','BCH-2026-003-P'],['Enrolled On','15 Aug 2026'],['Completed On','15 Sep 2026'],
                        ['Fee Status','Paid — LKR 5,000'],['Attendance','92% (22/24 sessions)'],['Exam Result','Pass — 76/100'],
                    ] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Completion Checklist</h3></div>
            <div class="card-body space-y-3">
                @foreach([
                    ['Course Fee Paid','check','emerald','LKR 5,000 paid on 15 Aug 2026'],
                    ['Attendance Above Threshold','check','emerald','92% — above configured threshold (75%)'],
                    ['Exam Completed','check','emerald','EXM-001 — 76/100 — Pass'],
                    ['Results Published','check','emerald','Published 16 Sep 2026 by Kasun Bandara'],
                    ['Certificate Issued','check','emerald','CERT-ACD-A8F2 — 17 Sep 2026'],
                    ['Enrollment Marked Complete','check','emerald','15 Sep 2026'],
                ] as $c)
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 bg-{{ $c[2] }}-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i data-lucide="{{ $c[1] }}" class="w-3.5 h-3.5 text-{{ $c[2] }}-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-800">{{ $c[0] }}</p>
                        <p class="text-xs text-slate-400">{{ $c[3] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="card"><div class="card-header"><h3 class="card-title">Student</h3></div>
            <div class="card-body">
                <div class="flex items-center gap-3 mb-3">
                    <div class="avatar avatar-sm avatar-violet">KP</div>
                    <div><p class="font-semibold text-slate-800">Kamal Pradeep</p><p class="text-xs text-slate-400">ACD-1001 · 0771234567</p></div>
                </div>
                <a href="{{ route('academy.students.show',1) }}" class="btn btn-outline w-full btn-sm">View Full Profile</a>
            </div>
        </div>
        <div class="card"><div class="card-header"><h3 class="card-title">Cross-Module</h3></div>
            <div class="card-body">
                <div class="p-2 bg-blue-50 border border-blue-200 rounded-xl text-sm">
                    <p class="font-semibold text-blue-800">Employment: EMP-1001</p>
                    <p class="text-xs text-blue-600 mt-0.5">Pre-departure training COMPLETED. Status updated to Deployment Ready.</p>
                </div>
            </div>
        </div>
        <div class="card"><div class="card-header"><h3 class="card-title">Certificate</h3></div>
            <div class="card-body space-y-2">
                <p class="text-sm font-mono text-emerald-600">CERT-ACD-A8F2</p>
                <button class="btn btn-outline w-full btn-sm"><i data-lucide="download" style="width:13px;height:13px"></i>Download Certificate</button>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
