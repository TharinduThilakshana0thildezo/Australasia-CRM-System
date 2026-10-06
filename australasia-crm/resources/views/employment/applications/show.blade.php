<x-layouts.app title="Application Details">
<x-page-header title="Application Details" subtitle="Application status and employer decision" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.applications.index'), 'label' => 'Applications'], ['url' => '#', 'label' => 'Application Details']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Application Details</h3><p class="empty-state-text">Application status and employer decision</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
