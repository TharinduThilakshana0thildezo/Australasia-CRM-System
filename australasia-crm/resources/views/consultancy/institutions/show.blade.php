<x-layouts.app title="Monash University — Institution Detail">

<x-page-header
    title="Monash University"
    subtitle="Melbourne, Australia · QS Rank #58 (2026)"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.institutions.index'),'label'=>'Institutions'],['url'=>'#','label'=>'Monash University']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.courses.index') }}" class="btn btn-secondary btn-sm"><i data-lucide="book-open" style="width:14px;height:14px"></i>Browse Courses</a>
    </x-slot:actions>
</x-page-header>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Institution Overview</h3></div>
            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    @foreach([['Country','Australia'],['City','Melbourne'],['Type','Public Research University'],['QS Rank','#58 (2026)'],['Founded','1958'],['IELTS Min.','6.5 overall'],['PTE Min.','58 overall'],['Acceptance Rate','~52%'],['Programs','128 available'],['Application Fee','AUD 0 (online)'],['Processing Time','4–6 weeks'],['Partner Status','Registered Partner']] as $r)
                    <div><p class="text-xs text-slate-400">{{ $r[0] }}</p><p class="font-semibold text-slate-800 mt-0.5">{{ $r[1] }}</p></div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3 class="card-title">Our Students at Monash</h3></div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead><tr><th>Student</th><th>Course</th><th>Intake</th><th>Application</th><th>Status</th></tr></thead>
                    <tbody>
                        @foreach([
                            ['Sachini Ranasinghe','Bachelor of IT','Feb 2027','APP-CON-0089','enrolled'],
                            ['Ruwan Bandara','Bachelor of IT','Feb 2027','APP-CON-0078','enrolled'],
                            ['Nimasha Pathirana','Bachelor of IT','Feb 2027','APP-CON-0092','submitted'],
                        ] as $s)
                        <tr>
                            <td><a href="{{ route('consultancy.students.show',1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $s[0] }}</a></td>
                            <td class="text-sm text-slate-600">{{ $s[1] }}</td>
                            <td class="text-sm text-slate-600">{{ $s[2] }}</td>
                            <td><a href="{{ route('consultancy.applications.show',1) }}" class="text-xs font-mono text-indigo-600">{{ $s[3] }}</a></td>
                            <td><x-status-badge :status="$s[4]" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="stat-card">
            <div class="stat-icon bg-blue-100"><i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i></div>
            <div class="stat-value">14</div>
            <div class="stat-label">Applications Sent</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-emerald-100"><i data-lucide="inbox" class="w-5 h-5 text-emerald-600"></i></div>
            <div class="stat-value">11</div>
            <div class="stat-label">Offers Received (79%)</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-teal-100"><i data-lucide="graduation-cap" class="w-5 h-5 text-teal-600"></i></div>
            <div class="stat-value">9</div>
            <div class="stat-label">Students Enrolled</div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Contact</h3></div>
            <div class="card-body text-sm space-y-1.5">
                <div><span class="text-slate-400">Agent Portal</span><p class="font-medium">agents.monash.edu</p></div>
                <div><span class="text-slate-400">Support Email</span><p class="font-medium">intlagents@monash.edu</p></div>
                <div><span class="text-slate-400">Our Agent Code</span><p class="font-mono font-medium">AUST-LKA-ARC-0042</p></div>
            </div>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
