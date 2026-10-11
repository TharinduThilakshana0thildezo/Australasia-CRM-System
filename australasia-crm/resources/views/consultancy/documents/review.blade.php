<x-layouts.app title="Document Review Queue — Consultancy">

<x-page-header
    title="Document Review Queue"
    subtitle="Documents awaiting staff review — approve or request corrections"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>route('consultancy.documents.index'),'label'=>'Documents'],['url'=>'#','label'=>'Review Queue']]">
    <x-slot:actions>
        <a href="{{ route('consultancy.documents.index') }}" class="btn btn-ghost btn-sm">
            <i data-lucide="arrow-left" style="width:14px;height:14px"></i>All Documents
        </a>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="alert alert-info mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>Review Policy:</strong> Documents must be reviewed within 48 hours of upload. Approving a document moves the student's case forward. Requesting correction puts the case on hold and notifies the student/consultant to re-upload.
    </div>
</div>

<div class="space-y-5">
    @php
    $reviewDocs=[
        ['id'=>'DOC-0892','student'=>'Dinusha Jayasena','sid'=>'CON-0086','type'=>'CV / Resume','file'=>'cv_dinusha.pdf','uploaded'=>'18 Sep 2026 · 14:32','size'=>'245 KB','notes'=>'First-time upload. No previous consultant comments.','country'=>'New Zealand'],
        ['id'=>'DOC-0893','student'=>'Amara Dissanayake','sid'=>'CON-0085','type'=>'Passport','file'=>'passport_amara.pdf','uploaded'=>'23 Sep 2026 · 09:11','size'=>'1.2 MB','notes'=>'','country'=>'Australia'],
        ['id'=>'DOC-0901','student'=>'Roshan Wijesinghe','sid'=>'CON-0082','type'=>'NIC','file'=>'nic_roshan_front.jpg','uploaded'=>'06 Oct 2026 · 10:05','size'=>'340 KB','notes'=>'','country'=>'Canada'],
        ['id'=>'DOC-0902','student'=>'Roshan Wijesinghe','sid'=>'CON-0082','type'=>'Educational Certificates','file'=>'al_roshan.pdf','uploaded'=>'06 Oct 2026 · 10:08','size'=>'890 KB','notes'=>'Student says this is a certified copy.','country'=>'Canada'],
        ['id'=>'DOC-0915','student'=>'Nimasha Pathirana','sid'=>'CON-0089','type'=>'Experience Letter','file'=>'exp_nimasha.pdf','uploaded'=>'07 Oct 2026 · 16:40','size'=>'190 KB','notes'=>'Re-upload after first correction request.','country'=>'Australia'],
    ];
    @endphp
    @foreach($reviewDocs as $doc)
    <div class="card" id="review-card-{{ $doc['id'] }}">
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-lg bg-amber-100 text-amber-600"><i data-lucide="file-text" style="width:18px;height:18px"></i></div>
                <div>
                    <p class="font-bold text-slate-800">{{ $doc['type'] }}</p>
                    <p class="text-xs text-slate-500">{{ $doc['id'] }} · <a href="{{ route('consultancy.students.show',1) }}" class="text-indigo-600 font-semibold">{{ $doc['student'] }}</a> ({{ $doc['sid'] }}) · Uploaded {{ $doc['uploaded'] }} · {{ $doc['size'] }}</p>
                </div>
            </div>
            <span class="badge badge-pending">Under Review</span>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Document Preview Area --}}
                <div class="bg-slate-50 border border-slate-200 rounded-xl flex flex-col items-center justify-center p-8 gap-3">
                    <i data-lucide="file-text" style="width:48px;height:48px;color:#94a3b8"></i>
                    <p class="text-sm font-mono text-slate-600">{{ $doc['file'] }}</p>
                    <p class="text-xs text-slate-400">{{ $doc['size'] }}</p>
                    <div class="flex gap-2">
                        <button class="btn btn-outline btn-sm"><i data-lucide="eye" style="width:13px;height:13px"></i>Preview</button>
                        <button class="btn btn-ghost btn-sm"><i data-lucide="download" style="width:13px;height:13px"></i>Download</button>
                    </div>
                </div>
                {{-- Review Actions --}}
                <div>
                    <p class="text-sm font-semibold text-slate-700 mb-2">Student / Context</p>
                    <div class="space-y-1.5 text-sm mb-4">
                        <div class="flex gap-2"><span class="text-slate-400 w-24 flex-shrink-0">Student</span><span class="font-medium text-slate-700">{{ $doc['student'] }} ({{ $doc['sid'] }})</span></div>
                        <div class="flex gap-2"><span class="text-slate-400 w-24 flex-shrink-0">Doc Type</span><span class="font-medium text-slate-700">{{ $doc['type'] }}</span></div>
                        <div class="flex gap-2"><span class="text-slate-400 w-24 flex-shrink-0">Destination</span><span class="font-medium text-slate-700">{{ $doc['country'] }}</span></div>
                        @if($doc['notes'])
                        <div class="flex gap-2"><span class="text-slate-400 w-24 flex-shrink-0">Notes</span><span class="text-slate-600">{{ $doc['notes'] }}</span></div>
                        @endif
                    </div>

                    <div class="space-y-3" x-data="{showReject:false}">
                        {{-- APPROVE --}}
                        <form method="POST" action="{{ route('consultancy.documents.approve', $doc['id']) }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="form-label text-xs">Reviewer Notes (optional)</label>
                                <textarea name="reviewer_notes" rows="2" class="form-textarea text-sm" placeholder="Any notes about the approval…"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-full" onclick="return confirm('Approve this document?')">
                                <i data-lucide="check" style="width:15px;height:15px"></i>Approve Document
                            </button>
                        </form>

                        <div class="relative"><div class="border-t border-slate-200"></div><span class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-white px-2 text-xs text-slate-400">or</span></div>

                        {{-- REQUEST CORRECTION --}}
                        <div>
                            <button @click="showReject=!showReject" class="btn btn-danger w-full">
                                <i data-lucide="alert-triangle" style="width:15px;height:15px"></i>Request Correction
                            </button>
                            <div x-show="showReject" x-transition class="mt-3" style="display:none">
                                <form method="POST" action="{{ route('consultancy.documents.request-correction', $doc['id']) }}">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label class="form-label required text-xs">Reason (will be shown to student/consultant)</label>
                                        <textarea name="correction_reason" rows="3" class="form-textarea text-sm" placeholder="e.g. Document is blurry, expired, wrong page uploaded…" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-full">Submit Correction Request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="card">
        <div class="card-body text-center py-8">
            <i data-lucide="check-circle" style="width:40px;height:40px;color:#10b981;margin:0 auto 8px"></i>
            <p class="font-bold text-slate-700">18 more documents</p>
            <p class="text-sm text-slate-500">Load more documents from the review queue</p>
            <button class="btn btn-outline btn-sm mt-3">Load More (18)</button>
        </div>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
