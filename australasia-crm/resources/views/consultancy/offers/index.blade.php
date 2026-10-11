<x-layouts.app title="Offers & Acceptance — Consultancy">

<x-page-header
    title="Offers & Acceptance"
    subtitle="All institution offers — acceptance, conditional offer conditions, and deadlines"
    :breadcrumbs="[['url'=>route('dashboard'),'label'=>'Dashboard'],['url'=>route('consultancy.dashboard'),'label'=>'Consultancy'],['url'=>'#','label'=>'Offers']]">
    <x-slot:actions>
        <button onclick="openModal('record-offer-modal')" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>Record Offer
        </button>
    </x-slot:actions>
</x-page-header>

@if(session('success'))
<div class="alert alert-success mb-4"><i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0"></i>{{ session('success') }}</div>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach([['19','Total Offers','inbox','indigo'],['11','Accepted','check-circle','emerald'],['5','Conditional','alert-circle','amber'],['3','Deadline <7 Days','clock','rose']] as $k)
    <x-stat-card value="{{ $k[0] }}" label="{{ $k[1] }}" icon="{{ $k[2] }}" color="{{ $k[3] }}" />
    @endforeach
</div>

{{-- Urgent: Deadline Alert --}}
<div class="alert alert-warning mb-5">
    <i data-lucide="clock" style="width:18px;height:18px;flex-shrink:0"></i>
    <div class="text-sm">
        <strong>3 offers have deadlines within 7 days.</strong> Ensure students have made their acceptance decision. Missed deadlines cannot be reversed without contacting the institution.
    </div>
</div>

<div class="space-y-5">
    @php
    $offers=[
        ['id'=>'OFR-CON-0011','app_id'=>'APP-CON-0089','student'=>'Sachini Ranasinghe','sid'=>'CON-0089','institution'=>'Monash University','course'=>'Bachelor of IT','intake'=>'Feb 2027','offer_date'=>'25 Sep 2026','deadline'=>'30 Nov 2026','type'=>'unconditional','decision'=>'accepted','accepted_on'=>'02 Oct 2026','conditions'=>[],'urgent'=>false],
        ['id'=>'OFR-CON-0010','app_id'=>'APP-CON-0088','student'=>'Kavinda Gunasekara','sid'=>'CON-0088','institution'=>'Univ. of Manchester','course'=>'MBA','intake'=>'Sep 2027','offer_date'=>'20 Aug 2026','deadline'=>'15 Oct 2026','type'=>'unconditional','decision'=>'accepted','accepted_on'=>'22 Aug 2026','conditions'=>[],'urgent'=>false],
        ['id'=>'OFR-CON-0009','app_id'=>'APP-CON-0083','student'=>'Chamari Dias','sid'=>'CON-0083','institution'=>'UCL London','course'=>'MSc Data Science','intake'=>'Sep 2027','offer_date'=>'15 Sep 2026','deadline'=>'16 Oct 2026','type'=>'unconditional','decision'=>'pending','accepted_on'=>'','conditions'=>[],'urgent'=>true],
        ['id'=>'OFR-CON-0008','app_id'=>'APP-CON-0081','student'=>'Pradeep Fernando','sid'=>'CON-0081','institution'=>'Univ. of Massachusetts','course'=>'BS Computer Science','intake'=>'Sep 2027','offer_date'=>'10 Sep 2026','deadline'=>'14 Oct 2026','type'=>'conditional','decision'=>'pending','accepted_on'=>'','conditions'=>['Improved IELTS score (min 6.5 overall)','Final A/L results transcript required'],'urgent'=>true],
        ['id'=>'OFR-CON-0007','app_id'=>'APP-CON-0080','student'=>'Indika Chandrasena','sid'=>'CON-0080','institution'=>'Deakin University','course'=>'Graduate Diploma','intake'=>'Mar 2027','offer_date'=>'05 Jul 2026','deadline'=>'30 Oct 2026','type'=>'unconditional','decision'=>'accepted','accepted_on'=>'10 Jul 2026','conditions'=>[],'urgent'=>false],
    ];
    @endphp
    @foreach($offers as $offer)
    <div class="card {{ $offer['urgent'] ? 'border-rose-200':'' }}">
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div>
                    <p class="font-bold text-slate-800">{{ $offer['institution'] }} — {{ $offer['course'] }}</p>
                    <p class="text-xs text-slate-500">{{ $offer['id'] }} · <a href="{{ route('consultancy.students.show',1) }}" class="text-indigo-600 font-semibold">{{ $offer['student'] }}</a> ({{ $offer['sid'] }}) · {{ $offer['intake'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                @if($offer['type']==='conditional')
                <span class="badge badge-pending">Conditional Offer</span>
                @else
                <span class="badge badge-approved">Unconditional</span>
                @endif
                @if($offer['decision']==='accepted')
                <span class="badge badge-approved">Accepted ✓</span>
                @elseif($offer['urgent'])
                <span class="badge badge-refund">Deadline Urgent!</span>
                @else
                <span class="badge badge-pending">Awaiting Decision</span>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                <div><p class="text-xs text-slate-400">Offer Date</p><p class="font-semibold mt-0.5">{{ $offer['offer_date'] }}</p></div>
                <div><p class="text-xs text-slate-400">Acceptance Deadline</p><p class="font-semibold {{ $offer['urgent'] ? 'text-rose-600':'text-slate-800' }} mt-0.5">{{ $offer['deadline'] }}</p></div>
                <div><p class="text-xs text-slate-400">Application</p><a href="{{ route('consultancy.applications.show',1) }}" class="font-semibold text-indigo-600 mt-0.5 block">{{ $offer['app_id'] }}</a></div>
                <div><p class="text-xs text-slate-400">Accepted On</p><p class="font-semibold mt-0.5">{{ $offer['accepted_on'] ?: '—' }}</p></div>
            </div>

            @if($offer['conditions'])
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-4">
                <p class="text-xs font-bold text-amber-800 mb-2">Conditional Offer — Conditions Must Be Satisfied:</p>
                <ul class="space-y-1">
                    @foreach($offer['conditions'] as $cond)
                    <li class="flex items-center gap-2 text-sm text-amber-800">
                        <i data-lucide="circle" style="width:12px;height:12px;flex-shrink:0"></i>{{ $cond }}
                        <form method="POST" action="{{ route('consultancy.offers.conditions.satisfy', ['id' => $offer['id'], 'condId' => rand(1,9)]) }}" class="ml-auto">
                            @csrf<button type="submit" class="btn btn-outline btn-xs">Mark Satisfied</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($offer['decision']==='pending')
            <div class="flex gap-3">
                <form method="POST" action="{{ route('consultancy.offers.accept',$offer['id']) }}" class="flex-1">
                    @csrf
                    <input type="hidden" name="acceptance_method" value="portal">
                    <input type="hidden" name="accepted_on" value="{{ date('Y-m-d') }}">
                    <button type="submit" class="btn btn-success w-full" onclick="return confirm('Record student acceptance for this offer?')">
                        <i data-lucide="check" style="width:14px;height:14px"></i>Record Acceptance
                    </button>
                </form>
                <button onclick="openModal('decline-offer-{{ $offer['id'] }}')" class="btn btn-danger flex-1">
                    <i data-lucide="x" style="width:14px;height:14px"></i>Decline Offer
                </button>
            </div>
            {{-- Decline Modal per offer --}}
            <div id="decline-offer-{{ $offer['id'] }}" class="modal-overlay" style="display:none">
                <div class="modal-box" style="max-width:440px">
                    <div class="modal-header"><span class="modal-title">Decline Offer</span><button onclick="closeModal('decline-offer-{{ $offer['id'] }}')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
                    <form method="POST" action="{{ route('consultancy.offers.decline',$offer['id']) }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label required">Decline Reason</label>
                                <textarea name="decline_reason" rows="4" class="form-textarea" placeholder="Why is the student declining this offer?" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="closeModal('decline-offer-{{ $offer['id'] }}')" class="btn btn-ghost">Cancel</button>
                            <button type="submit" class="btn btn-danger">Decline Offer</button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="text-sm text-emerald-600 font-semibold">✓ Accepted on {{ $offer['accepted_on'] }} — Proceed to visa case preparation</div>
            @if($offer['decision']==='accepted')
            <div class="mt-3"><a href="{{ route('consultancy.visas.index') }}" class="btn btn-outline btn-sm">View Visa Case →</a></div>
            @endif
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Record Offer Modal --}}
<div id="record-offer-modal" class="modal-overlay" style="display:none">
    <div class="modal-box" style="max-width:520px">
        <div class="modal-header"><span class="modal-title">Record New Offer</span><button onclick="closeModal('record-offer-modal')" class="modal-close"><i data-lucide="x" style="width:16px;height:16px"></i></button></div>
        <form method="POST" action="{{ route('consultancy.offers.store') }}">
            @csrf
            <div class="modal-body">
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group col-span-2"><label class="form-label required">Application ID</label><input name="application_id" type="text" class="form-input" placeholder="e.g. APP-CON-0090" required></div>
                    <div class="form-group"><label class="form-label required">Offer Date</label><input name="offer_date" type="date" class="form-input" value="{{ date('Y-m-d') }}" required></div>
                    <div class="form-group"><label class="form-label required">Acceptance Deadline</label><input name="deadline" type="date" class="form-input" required></div>
                    <div class="form-group col-span-2"><label class="form-label required">Offer Type</label>
                        <select name="offer_type" class="form-select" required><option value="unconditional">Unconditional</option><option value="conditional">Conditional</option></select>
                    </div>
                    <div class="form-group col-span-2"><label class="form-label">Conditions (if conditional)</label><textarea name="conditions" rows="3" class="form-textarea" placeholder="List conditions, one per line…"></textarea></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('record-offer-modal')" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn btn-primary">Record Offer</button>
            </div>
        </form>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded',()=>lucide.createIcons());</script>
</x-layouts.app>
