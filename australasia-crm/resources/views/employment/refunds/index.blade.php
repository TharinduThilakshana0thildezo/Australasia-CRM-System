<x-layouts.app title="Refund Cases — Foreign Employment">

<x-page-header
    title="Refund Cases"
    subtitle="Manage exception refund workflows with management approval"
    :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.dashboard'), 'label' => 'Employment'], ['url' => '#', 'label' => 'Refunds']]">
    <x-slot:actions>
        <a href="{{ route('employment.refunds.create') }}" class="btn btn-primary btn-sm">
            <i data-lucide="plus" style="width:14px;height:14px"></i>
            Initiate Refund
        </a>
    </x-slot:actions>
</x-page-header>

<!-- Policy notice -->
<div class="alert alert-warning mb-5">
    <i data-lucide="info" style="width:18px;height:18px;flex-shrink:0"></i>
    <div>
        <p class="font-bold">Refund Policy — Management Review Required</p>
        <p class="text-sm mt-0.5">Not all withdrawals are automatically eligible for refunds. Eligibility is subject to management review based on the trigger reason, stage, and business rules. Candidate withdrawal/unresponsive refund eligibility is <strong>pending policy confirmation</strong>.</p>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <x-stat-card value="14"  label="Total Cases"    icon="rotate-ccw"   color="rose" />
    <x-stat-card value="4"   label="Eligible"       icon="check-circle" color="amber" />
    <x-stat-card value="3"   label="Under Review"   icon="search"       color="violet" />
    <x-stat-card value="5"   label="Approved"       icon="thumbs-up"    color="indigo" />
    <x-stat-card value="2"   label="Refunded"       icon="banknote"     color="emerald" />
</div>

<!-- Table -->
<div class="card">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Refund ID</th>
                    <th>Candidate</th>
                    <th>Trigger Reason</th>
                    <th>Triggered Stage</th>
                    <th>Reg. Fee</th>
                    <th>Requested By</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $refunds = [
                    ['id' => 'REF-0014', 'candidate' => 'Ruwan Pathirana',    'cid' => 'CAND-1293', 'reason' => 'Visa delay exceeded timeframe', 'stage' => 'Visa Processing', 'fee' => 'LKR 15,000', 'by' => 'Director', 'date' => '06 Oct 2026', 'status' => 'approved'],
                    ['id' => 'REF-0013', 'candidate' => 'Indika Chandrasena', 'cid' => 'CAND-1289', 'reason' => 'Visa delay exceeded timeframe', 'stage' => 'Visa Processing', 'fee' => 'LKR 15,000', 'by' => 'Nimal J.', 'date' => '05 Oct 2026', 'status' => 'under_review'],
                    ['id' => 'REF-0012', 'candidate' => 'Malith Perera',      'cid' => 'CAND-1281', 'reason' => 'Documents incomplete — deadline missed', 'stage' => 'Document Review', 'fee' => 'LKR 15,000', 'by' => 'Priya H.', 'date' => '01 Oct 2026', 'status' => 'under_review'],
                    ['id' => 'REF-0011', 'candidate' => 'Kasuni Jayawardena', 'cid' => 'CAND-1270', 'reason' => 'Checklist failure — repeated correction', 'stage' => 'Checklist', 'fee' => 'LKR 15,000', 'by' => 'Kasun B.', 'date' => '28 Sep 2026', 'status' => 'refunded'],
                    ['id' => 'REF-0010', 'candidate' => 'Ashan Weerasinghe',  'cid' => 'CAND-1265', 'reason' => 'Candidate withdrawal — policy pending', 'stage' => 'Talent Pool', 'fee' => 'LKR 15,000', 'by' => 'Amila P.', 'date' => '20 Sep 2026', 'status' => 'rejected'],
                ];
                $statusMap = ['approved' => 'badge-approved', 'under_review' => 'badge-review', 'refunded' => 'badge-paid', 'rejected' => 'badge-rejected', 'eligible' => 'badge-pending', 'requested' => 'badge-registered', 'processing' => 'badge-processing'];
                $labelMap  = ['approved' => 'Approved', 'under_review' => 'Under Review', 'refunded' => 'Refunded', 'rejected' => 'Rejected', 'eligible' => 'Eligible', 'requested' => 'Requested', 'processing' => 'Processing'];
                @endphp
                @foreach($refunds as $r)
                <tr>
                    <td><a href="{{ route('employment.refunds.show', 1) }}" class="font-mono font-semibold text-indigo-600 hover:underline">{{ $r['id'] }}</a></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="avatar avatar-sm avatar-rose">{{ substr($r['candidate'], 0, 2) }}</div>
                            <div>
                                <a href="{{ route('employment.candidates.show', 1) }}" class="text-sm font-semibold text-slate-800 hover:text-indigo-600">{{ $r['candidate'] }}</a>
                                <p class="text-xs text-slate-400">{{ $r['cid'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-slate-700 max-w-xs">{{ $r['reason'] }}</td>
                    <td><span class="badge badge-lead">{{ $r['stage'] }}</span></td>
                    <td class="font-semibold text-sm text-slate-800">{{ $r['fee'] }}</td>
                    <td class="text-sm text-slate-600">{{ $r['by'] }}</td>
                    <td class="text-sm text-slate-500">{{ $r['date'] }}</td>
                    <td><span class="badge {{ $statusMap[$r['status']] }} badge-dot">{{ $labelMap[$r['status']] }}</span></td>
                    <td>
                        <a href="{{ route('employment.refunds.show', 1) }}" class="btn btn-ghost btn-xs">
                            <i data-lucide="eye" style="width:13px;height:13px"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
