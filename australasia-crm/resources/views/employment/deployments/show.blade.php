<x-layouts.app title="Deployment Details">
<x-page-header title="Deployment Details" subtitle="Flight, briefing and dispatch details" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.deployments.index'), 'label' => 'Deployments'], ['url' => '#', 'label' => 'Deployment Details']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Deployment Details</h3><p class="empty-state-text">Flight, briefing and dispatch details</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
