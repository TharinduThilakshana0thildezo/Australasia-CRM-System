<x-layouts.app title="Registration Links — Academy">

<x-page-header
    title="Registration Links"
    subtitle="Shareable links for online student self-registration"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('academy.dashboard'),'label'=>'Academy'],['url'=>'#','label'=>'Registration Links']]">
    <x-slot:actions>
        <button onclick="openModal('create-link-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="link" style="width:14px;height:14px"></i>Generate Link
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-info mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>How it works:</strong> Generate a secure, expiring link for a specific course or batch. Share it with potential students. When they submit the form, a pre-registration record is created for staff review. No student profile is created until staff confirms and approves the application.
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
    @foreach([['5','Active Links','link','emerald'],['22','Applications Received','inbox','indigo'],['14','Converted to Enrolled','check-circle','teal'],['2','Expired Links','clock','slate']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

<div class="card mb-6">
    <div class="card-header"><h3 class="card-title">Active Registration Links</h3></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Link Code</th><th>Course</th><th>Expires</th><th>Uses</th><th>Applications</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @php
                $links=[
                    ['LINK-ACD-A1B2','Pre-Departure — Warehouse','20 Oct 2026','20 max',8,'active'],
                    ['LINK-ACD-C3D4','English Communication (Int.)','25 Oct 2026','15 max',5,'active'],
                    ['LINK-ACD-E5F6','Arabic Language (Beg.)','31 Oct 2026','Unlimited',3,'active'],
                    ['LINK-ACD-G7H8','Computer Literacy — Basic','15 Oct 2026','10 max',6,'active'],
                    ['LINK-ACD-I9J0','Hospitality Service','18 Oct 2026','15 max',0,'active'],
                    ['LINK-ACD-EXP1','Pre-Departure — Care Work','01 Oct 2026','10 max',3,'expired'],
                    ['LINK-ACD-EXP2','English Communication (Beg.)','25 Sep 2026','Unlimited',11,'expired'],
                ];
                @endphp
                @foreach($links as $l)
                <tr>
                    <td><code class="text-xs font-mono {{ $l[5]==='active'?'text-emerald-600':'text-slate-400' }}">{{ $l[0] }}</code></td>
                    <td class="text-sm font-semibold text-slate-800">{{ $l[1] }}</td>
                    <td class="text-xs text-slate-500">{{ $l[2] }}</td>
                    <td class="text-xs text-slate-500">{{ $l[3] }}</td>
                    <td class="text-sm font-bold {{ $l[4]>0?'text-indigo-600':'text-slate-400' }}">{{ $l[4] }}</td>
                    <td><x-status-badge :status="$l[5]" /></td>
                    <td>
                        <div class="flex gap-1">
                            @if($l[5]==='active')
                            <button class="btn btn-ghost btn-xs copy-btn" data-url="https://crm.australasiagroup.lk/register/{{ strtolower($l[0]) }}" title="Copy link">
                                <i data-lucide="copy" style="width:13px;height:13px"></i>
                            </button>
                            <a href="{{ route('academy.registration-links.applications',1) }}" class="btn btn-outline btn-xs">Applications ({{ $l[4] }})</a>
                            <form method="POST" action="{{ route('academy.registration-links.deactivate',1) }}" class="inline">@csrf
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Deactivate this link?')">Deactivate</button>
                            </form>
                            @else
                            <span class="text-xs text-slate-400">Expired</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Pending Applications from Links --}}
<div class="card">
    <div class="card-header"><h3 class="card-title">Pending Applications from Links</h3><span class="badge badge-pending">8 pending review</span></div>
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead><tr><th>Submitted</th><th>Name</th><th>NIC</th><th>Phone</th><th>Course Interest</th><th>Link Source</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach([
                    ['09 Oct 2026','Priyantha Kumara','199901234567','0771234888','Pre-Departure — Warehouse','LINK-ACD-A1B2'],
                    ['08 Oct 2026','Sandya Jayawardena','200105678901','0762345999','Computer Literacy — Basic','LINK-ACD-G7H8'],
                    ['07 Oct 2026','Nirmala Silva','199807345678','0753456000','English Communication','LINK-ACD-C3D4'],
                ] as $a)
                <tr>
                    <td class="text-xs text-slate-500">{{ $a[0] }}</td>
                    <td class="text-sm font-semibold text-slate-800">{{ $a[1] }}</td>
                    <td class="font-mono text-xs text-slate-600">{{ $a[2] }}</td>
                    <td class="text-sm text-slate-600">{{ $a[3] }}</td>
                    <td class="text-sm text-slate-700">{{ $a[4] }}</td>
                    <td class="text-xs font-mono text-indigo-600">{{ $a[5] }}</td>
                    <td>
                        <div class="flex gap-1">
                            <form method="POST" action="{{ route('academy.students.store') }}" class="inline">@csrf
                                <input type="hidden" name="from_link" value="1">
                                <button type="submit" class="btn btn-success btn-xs">Approve & Register</button>
                            </form>
                            <button onclick="openModal('reject-modal')" class="btn btn-danger btn-xs">Reject</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Create Link Modal --}}
<div id="create-link-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:480px">
        <div class="modal-header"><span class="modal-title">Generate Registration Link</span><button onclick="closeModal('create-link-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.registration-links.store') }}">
            @csrf
            <div class="modal-body space-y-4">
                <div class="form-group"><label class="form-label required">Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">Select course</option>
                        <option>Pre-Departure — Warehouse</option>
                        <option>English Communication (Int.)</option>
                        <option>Arabic Language (Beg.)</option>
                        <option>Computer Literacy — Basic</option>
                        <option>Hospitality Service</option>
                    </select>
                </div>
                <div class="form-group"><label class="form-label required">Expiry Date</label>
                    <input name="expires_at" type="date" class="form-input" required>
                </div>
                <div class="form-group"><label class="form-label">Max Uses</label>
                    <input name="max_uses" type="number" min="1" class="form-input" placeholder="Leave blank for unlimited">
                </div>
                <div class="form-group"><label class="form-label">Notes / Purpose</label>
                    <textarea name="notes" rows="2" class="form-textarea" placeholder="e.g. WhatsApp group campaign Oct 2026"></textarea>
                </div>
            </div>
            <div class="modal-footer"><button type="button" onclick="closeModal('create-link-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-primary">Generate Link</button></div>
        </form>
    </div>
</div>

{{-- Reject Modal --}}
<div id="reject-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:440px">
        <div class="modal-header"><span class="modal-title">Reject Application</span><button onclick="closeModal('reject-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('academy.registration-links.reject',1) }}">
            @csrf
            <div class="modal-body"><div class="form-group"><label class="form-label required">Reason for Rejection</label><textarea name="reject_reason" rows="4" class="form-textarea" required minlength="10"></textarea></div></div>
            <div class="modal-footer"><button type="button" onclick="closeModal('reject-modal')" class="btn btn-ghost">Cancel</button><button type="submit" class="btn btn-danger">Reject Application</button></div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded',()=>{
    lucide.createIcons();
    document.querySelectorAll('.copy-btn').forEach(btn=>{
        btn.addEventListener('click',()=>{
            navigator.clipboard?.writeText(btn.dataset.url).then(()=>{
                btn.innerHTML='<i data-lucide="check" style="width:13px;height:13px"></i>';
                lucide.createIcons();
                setTimeout(()=>{btn.innerHTML='<i data-lucide="copy" style="width:13px;height:13px"></i>';lucide.createIcons();},2000);
            });
        });
    });
});
</script>
</x-layouts.app>
