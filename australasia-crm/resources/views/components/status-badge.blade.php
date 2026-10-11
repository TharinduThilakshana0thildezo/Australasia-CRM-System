@props(['status' => '', 'size' => 'md'])

@php
$map = [
    // Employment statuses
    'lead'              => ['class' => 'badge-lead',       'label' => 'Lead'],
    'registration_pending' => ['class' => 'badge-documents', 'label' => 'Reg. Pending'],
    'registered'        => ['class' => 'badge-registered', 'label' => 'Registered'],
    'fee_pending'       => ['class' => 'badge-pending',    'label' => 'Fee Pending'],
    'documents_pending' => ['class' => 'badge-documents',  'label' => 'Docs Pending'],
    'under_screening'   => ['class' => 'badge-screening',  'label' => 'Screening'],
    'correction_required' => ['class' => 'badge-correction', 'label' => 'Correction Req.'],
    'ready'             => ['class' => 'badge-ready',      'label' => 'Ready'],
    'training'          => ['class' => 'badge-training',   'label' => 'Training'],
    'talent_pool'       => ['class' => 'badge-pool',       'label' => 'Talent Pool'],
    'matched'           => ['class' => 'badge-employer',   'label' => 'Matched'],
    'employer_review'   => ['class' => 'badge-employer',   'label' => 'Employer Review'],
    'selected'          => ['class' => 'badge-selected',   'label' => 'Selected'],
    'checklist'         => ['class' => 'badge-checklist',  'label' => 'Checklist'],
    'visa_processing'   => ['class' => 'badge-visa',       'label' => 'Visa Processing'],
    'visa_approved'     => ['class' => 'badge-approved',   'label' => 'Visa Approved'],
    'deployment'        => ['class' => 'badge-deployment', 'label' => 'Deployment'],
    'deployed'          => ['class' => 'badge-deployed',   'label' => 'Deployed'],
    'refund'            => ['class' => 'badge-refund',     'label' => 'Refund'],
    'refund_eligible'   => ['class' => 'badge-refund',     'label' => 'Refund Eligible'],
    'refunded'          => ['class' => 'badge-refund',     'label' => 'Refunded'],
    'closed'            => ['class' => 'badge-closed',     'label' => 'Closed'],
    'withdrawn'         => ['class' => 'badge-withdrawn',  'label' => 'Withdrawn'],

    // Document statuses
    'missing'           => ['class' => 'badge-missing',    'label' => 'Missing'],
    'uploaded'          => ['class' => 'badge-uploaded',   'label' => 'Uploaded'],
    'under_review'      => ['class' => 'badge-review',     'label' => 'Under Review'],
    'approved'          => ['class' => 'badge-approved',   'label' => 'Approved'],
    'correction_req'    => ['class' => 'badge-correction', 'label' => 'Correction Req.'],
    'rejected'          => ['class' => 'badge-rejected',   'label' => 'Rejected'],
    'expired'           => ['class' => 'badge-overdue',    'label' => 'Expired'],

    // Vacancy statuses
    'draft'             => ['class' => 'badge-draft',      'label' => 'Draft'],
    'open'              => ['class' => 'badge-open',       'label' => 'Open'],
    'matching'          => ['class' => 'badge-employer',   'label' => 'Matching'],
    'filled'            => ['class' => 'badge-filled',     'label' => 'Filled'],
    'cancelled'         => ['class' => 'badge-cancelled',  'label' => 'Cancelled'],

    // Payment statuses
    'pending'           => ['class' => 'badge-pending',    'label' => 'Pending'],
    'paid'              => ['class' => 'badge-paid',       'label' => 'Paid'],
    'partially_refunded'=> ['class' => 'badge-warning',   'label' => 'Partial Refund'],

    // Application statuses
    'submitted'         => ['class' => 'badge-registered', 'label' => 'Submitted'],
    'interview'         => ['class' => 'badge-employer',   'label' => 'Interview'],
    'not_selected'      => ['class' => 'badge-closed',     'label' => 'Not Selected'],
    'offer_received'    => ['class' => 'badge-approved',   'label' => 'Offer Received'],
    'conditional_offer' => ['class' => 'badge-pending',    'label' => 'Conditional Offer'],
    'applied'           => ['class' => 'badge-processing', 'label' => 'Applied'],
    'enrolled'          => ['class' => 'badge-approved',   'label' => 'Enrolled'],
    'correction_required' => ['class' => 'badge-correction', 'label' => 'Correction Req.'],

    // Task statuses
    'in_progress'       => ['class' => 'badge-processing', 'label' => 'In Progress'],
    'waiting'           => ['class' => 'badge-pending',    'label' => 'Waiting'],
    'completed'         => ['class' => 'badge-approved',   'label' => 'Completed'],
    'overdue'           => ['class' => 'badge-overdue',    'label' => 'Overdue'],

    // General
    'active'            => ['class' => 'badge-active',     'label' => 'Active'],
    'inactive'          => ['class' => 'badge-inactive',   'label' => 'Inactive'],
    'processing'        => ['class' => 'badge-processing', 'label' => 'Processing'],

    // ── Academy module statuses ──────────────────────────────────────────────
    // Course statuses
    'paused'            => ['class' => 'badge-warning',    'label' => 'Paused'],
    'archived'          => ['class' => 'badge-inactive',   'label' => 'Archived'],

    // Batch statuses
    'scheduled'         => ['class' => 'badge-registered', 'label' => 'Scheduled'],
    'running'           => ['class' => 'badge-active',     'label' => 'Running'],

    // Enrollment statuses
    'waitlisted'        => ['class' => 'badge-pending',    'label' => 'Waitlisted'],
    'enquiry'           => ['class' => 'badge-lead',       'label' => 'Enquiry'],

    // Exam/result statuses
    'marks_pending'     => ['class' => 'badge-pending',    'label' => 'Marks Pending'],
    'published'         => ['class' => 'badge-approved',   'label' => 'Published'],
    'pass'              => ['class' => 'badge-approved',   'label' => 'Pass'],
    'fail'              => ['class' => 'badge-rejected',   'label' => 'Fail'],
    'resit'             => ['class' => 'badge-correction', 'label' => 'Re-sit'],

    // Certificate statuses
    'issued'            => ['class' => 'badge-approved',   'label' => 'Issued'],
    'voided'            => ['class' => 'badge-rejected',   'label' => 'Voided'],
    'reissued'          => ['class' => 'badge-processing', 'label' => 'Reissued'],

    // Registration link statuses
    'expired'           => ['class' => 'badge-overdue',    'label' => 'Expired'],
    'deactivated'       => ['class' => 'badge-inactive',   'label' => 'Deactivated'],
];

$statusKey = strtolower($status);
$info = $map[$statusKey] ?? ['class' => 'badge-draft', 'label' => ucwords(str_replace('_', ' ', $status))];
@endphp

<span class="badge badge-dot {{ $info['class'] }}">{{ $info['label'] }}</span>
