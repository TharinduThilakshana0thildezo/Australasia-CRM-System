<x-layouts.app title="Institutions — Consultancy">

<x-page-header
    title="Partner Institutions"
    subtitle="University and institution directory for study abroad consultancy"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Institutions']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.courses.index') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="book-open" style="width:14px;height:14px"></i>Browse Courses
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

{{-- Filter --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="inst-search" type="text" class="search-input" placeholder="Search institution, country, course…">
            </div>
            <select id="inst-country" class="form-select" style="width:auto">
                <option value="">All Countries</option>
                <option value="Australia">Australia</option>
                <option value="UK">UK</option>
                <option value="Canada">Canada</option>
                <option value="New Zealand">New Zealand</option>
                <option value="USA">USA</option>
            </select>
            <select id="inst-rank" class="form-select" style="width:auto">
                <option value="">All Ranks</option>
                <option value="top50">QS Top 50</option>
                <option value="top100">QS Top 100</option>
                <option value="top200">QS Top 200</option>
                <option value="other">Other</option>
            </select>
            <button id="inst-clear" class="btn btn-ghost btn-sm"><i data-lucide="x" style="width:14px;height:14px"></i>Clear</button>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @php
    $institutions=[
        ['name'=>'Monash University','country'=>'Australia','city'=>'Melbourne','rank'=>'#58 QS 2026','acceptance_rate'=>'52%','courses'=>128,'apps'=>14,'offers'=>11,'ielts'=>'6.5','logo_color'=>'bg-blue-100 text-blue-600','status'=>'active'],
        ['name'=>'RMIT University','country'=>'Australia','city'=>'Melbourne','rank'=>'#132 QS 2026','acceptance_rate'=>'65%','courses'=>89,'apps'=>9,'offers'=>7,'ielts'=>'6.5','logo_color'=>'bg-red-100 text-red-600','status'=>'active'],
        ['name'=>'Deakin University','country'=>'Australia','city'=>'Melbourne','rank'=>'#252 QS 2026','acceptance_rate'=>'72%','courses'=>76,'apps'=>6,'offers'=>5,'ielts'=>'6.0','logo_color'=>'bg-green-100 text-green-600','status'=>'active'],
        ['name'=>'University of Manchester','country'=>'UK','city'=>'Manchester','rank'=>'#34 QS 2026','acceptance_rate'=>'41%','courses'=>156,'apps'=>7,'offers'=>4,'ielts'=>'6.5','logo_color'=>'bg-yellow-100 text-yellow-700','status'=>'active'],
        ['name'=>'UCL London','country'=>'UK','city'=>'London','rank'=>'#9 QS 2026','acceptance_rate'=>'28%','courses'=>210,'apps'=>5,'offers'=>2,'ielts'=>'7.0','logo_color'=>'bg-purple-100 text-purple-600','status'=>'active'],
        ['name'=>'Toronto Metropolitan University','country'=>'Canada','city'=>'Toronto','rank'=>'Top 100 Canada','acceptance_rate'=>'55%','courses'=>65,'apps'=>4,'offers'=>3,'ielts'=>'6.5','logo_color'=>'bg-orange-100 text-orange-600','status'=>'active'],
        ['name'=>'University of British Columbia','country'=>'Canada','city'=>'Vancouver','rank'=>'#38 QS 2026','acceptance_rate'=>'39%','courses'=>198,'apps'=>3,'offers'=>2,'ielts'=>'6.5','logo_color'=>'bg-teal-100 text-teal-600','status'=>'active'],
        ['name'=>'University of Auckland','country'=>'New Zealand','city'=>'Auckland','rank'=>'#68 QS 2026','acceptance_rate'=>'62%','courses'=>112,'apps'=>5,'offers'=>4,'ielts'=>'6.0','logo_color'=>'bg-indigo-100 text-indigo-600','status'=>'active'],
        ['name'=>'University of Massachusetts','country'=>'USA','city'=>'Boston','rank'=>'#153 QS 2026','acceptance_rate'=>'61%','courses'=>88,'apps'=>2,'offers'=>1,'ielts'=>'6.5','logo_color'=>'bg-rose-100 text-rose-600','status'=>'active'],
    ];
    @endphp
    @foreach($institutions as $inst)
    <div class="card inst-card" data-country="{{ $inst['country'] }}">
        <div class="card-body">
            <div class="flex items-start gap-3 mb-4">
                <div class="flex-shrink-0 w-12 h-12 {{ $inst['logo_color'] }} rounded-xl flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr($inst['name'],0,2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{ route('consultancy.institutions.show',1) }}" class="text-base font-bold text-slate-800 hover:text-indigo-600 leading-tight">{{ $inst['name'] }}</a>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $inst['city'] }}, {{ $inst['country'] }}</p>
                    <p class="text-xs text-indigo-600 font-semibold mt-0.5">{{ $inst['rank'] }}</p>
                </div>
                <x-status-badge status="approved" />
            </div>
            <div class="grid grid-cols-3 gap-2 text-center mb-4">
                <div class="bg-slate-50 rounded-lg py-2">
                    <p class="text-lg font-bold text-slate-800">{{ $inst['apps'] }}</p>
                    <p class="text-xs text-slate-500">Applications</p>
                </div>
                <div class="bg-slate-50 rounded-lg py-2">
                    <p class="text-lg font-bold text-emerald-600">{{ $inst['offers'] }}</p>
                    <p class="text-xs text-slate-500">Offers</p>
                </div>
                <div class="bg-slate-50 rounded-lg py-2">
                    <p class="text-lg font-bold text-slate-800">{{ $inst['courses'] }}</p>
                    <p class="text-xs text-slate-500">Courses</p>
                </div>
            </div>
            <div class="flex justify-between text-sm mb-3">
                <div><span class="text-xs text-slate-400">Entry (English)</span><p class="font-semibold text-slate-700">IELTS {{ $inst['ielts'] }}</p></div>
                <div class="text-right"><span class="text-xs text-slate-400">Acceptance Rate</span><p class="font-semibold text-slate-700">{{ $inst['acceptance_rate'] }}</p></div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('consultancy.institutions.show',1) }}" class="btn btn-outline btn-sm flex-1">View Institution</a>
                <a href="{{ route('consultancy.courses.index') }}" class="btn btn-ghost btn-sm flex-1">Courses</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const s=document.getElementById('inst-search'),c=document.getElementById('inst-country'),clr=document.getElementById('inst-clear');
    const cards=document.querySelectorAll('.inst-card');
    function filter(){const q=(s?.value||'').toLowerCase(),country=(c?.value||'');cards.forEach(card=>{const ok=(!q||card.textContent.toLowerCase().includes(q))&&(!country||card.dataset.country===country);card.style.display=ok?'':'none';});}
    s?.addEventListener('input',filter);c?.addEventListener('change',filter);
    clr?.addEventListener('click',()=>{if(s)s.value='';if(c)c.value='';filter();});
});
</script>
</x-layouts.app>
