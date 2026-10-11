<x-layouts.app title="Courses — Consultancy">

<x-page-header
    title="Course Directory"
    subtitle="Browse all available courses across partner institutions"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.institutions.index'),'label'=>'Institutions'],['url'=>'#','label'=>'Courses']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.institutions.index') }}" class="btn btn-ghost btn-sm">
            <i data-lucide="building-2" style="width:14px;height:14px"></i>View Institutions
        </a>
    </x-slot:actions>
</x-page-header>

{{-- Filters --}}
<div class="card mb-5">
    <div class="card-body py-3">
        <div class="flex flex-wrap gap-3 items-center">
            <div class="search-wrapper flex-1 min-w-48">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input id="course-search" type="text" class="search-input" placeholder="Search course name, institution…">
            </div>
            <select id="course-country" class="form-select" style="width:auto">
                <option value="">All Countries</option>
                <option>Australia</option><option>UK</option><option>Canada</option><option>New Zealand</option><option>USA</option>
            </select>
            <select id="course-level" class="form-select" style="width:auto">
                <option value="">All Levels</option>
                <option>Bachelor's</option><option>Master's</option><option>Diploma</option><option>Graduate Certificate</option><option>PhD</option>
            </select>
            <select id="course-field" class="form-select" style="width:auto">
                <option value="">All Fields</option>
                <option>IT / Computer Science</option><option>Business / MBA</option><option>Engineering</option><option>Health Sciences</option><option>Arts / Social Sciences</option>
            </select>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><h3 class="card-title">Available Courses</h3><span class="text-sm text-slate-500">748 courses across 9 institutions</span></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Course</th><th>Level</th><th>Institution</th><th>Country</th><th>Duration</th><th>Annual Fee (AUD/GBP)</th><th>IELTS Min.</th><th>Intakes</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $courses=[
                    ['Bachelor of Information Technology','Bachelor\'s','Monash University','Australia','3 years','AUD 32,000','6.5','Feb, Jul'],
                    ['Bachelor of IT (Hons)','Bachelor\'s','RMIT University','Australia','4 years','AUD 30,000','6.5','Feb, Jul'],
                    ['Bachelor of Computer Science','Bachelor\'s','Deakin University','Australia','3 years','AUD 28,500','6.0','Mar, Jul'],
                    ['MBA — General','Master\'s','Univ. of Manchester','UK','1 year','GBP 30,500','6.5','Sep'],
                    ['MSc Data Science','Master\'s','UCL London','UK','1 year','GBP 33,000','7.0','Sep'],
                    ['Diploma of IT','Diploma','Toronto Metropolitan','Canada','2 years','CAD 22,000','6.5','Jan, Sep'],
                    ['Bachelor of Engineering (Mechatronics)','Bachelor\'s','McMaster University','Canada','4 years','CAD 38,000','6.5','Sep'],
                    ['Master of Computer Science','Master\'s','Univ. of Auckland','New Zealand','1.5 years','NZD 38,000','6.0','Feb, Jul'],
                    ['BS Computer Science','Bachelor\'s','Univ. of Massachusetts','USA','4 years','USD 34,000','6.5','Sep'],
                ];
                @endphp
                @foreach($courses as $c)
                <tr class="course-row">
                    <td class="text-sm font-semibold text-slate-800">{{ $c[0] }}</td>
                    <td><span class="badge badge-lead">{{ $c[1] }}</span></td>
                    <td class="text-sm text-slate-600">{{ $c[2] }}</td>
                    <td class="text-sm text-slate-600">{{ $c[3] }}</td>
                    <td class="text-sm text-slate-600">{{ $c[4] }}</td>
                    <td class="text-sm font-semibold text-slate-700">{{ $c[5] }}</td>
                    <td class="text-sm text-slate-600">{{ $c[6] }}</td>
                    <td class="text-sm text-slate-500">{{ $c[7] }}</td>
                    <td><button onclick="openModal('shortlist-from-course')" class="btn btn-primary btn-xs">Shortlist</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Quick Shortlist Modal --}}
<div id="shortlist-from-course" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Add to Student Shortlist</span><button onclick="closeModal('shortlist-from-course')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.shortlists.store') }}">
            @csrf
            <div class="modal-body space-y-3">
                <div class="form-group"><label class="form-label required">Student</label>
                    <select name="student_id" class="form-select" required>
                        <option value="">Select student</option>
                        <option value="CON-0089">CON-0089 — Sachini Ranasinghe</option>
                        <option value="CON-0088">CON-0088 — Kavinda Gunasekara</option>
                        <option value="CON-0086">CON-0086 — Dinusha Jayasena</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Institution</label><input name="institution_id" type="text" class="form-input" value="Monash University" required></div>
                <div class="form-group"><label class="form-label required">Course</label><input name="course" type="text" class="form-input" value="Bachelor of Information Technology" required></div>
                <div class="form-group"><label class="form-label required">Preferred Intake</label><input name="intake" type="text" class="form-input" placeholder="e.g. Feb 2027" required></div>
                <div class="form-group"><label class="form-label required">Est. Annual Cost</label><input name="estimated_cost" type="number" class="form-input" value="32000" required></div>
                <div class="form-group"><label class="form-label required">Currency</label>
                    <select name="currency" class="form-select" required><option value="AUD">AUD</option><option value="GBP">GBP</option><option value="CAD">CAD</option><option value="USD">USD</option><option value="NZD">NZD</option></select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('shortlist-from-course')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Add to Shortlist</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();
    const s=document.getElementById('course-search');
    const rows=document.querySelectorAll('tr.course-row');
    s?.addEventListener('input',()=>{const q=s.value.toLowerCase();rows.forEach(r=>{r.style.display=!q||r.textContent.toLowerCase().includes(q)?'':'none';});});
});
</script>
</x-layouts.app>
