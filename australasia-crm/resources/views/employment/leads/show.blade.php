<x-layouts.app title="Lead Details">
<x-page-header title="Lead Details" subtitle="Lead information and follow-up history" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.leads.index'), 'label' => 'Leads'], ['url' => '#', 'label' => 'Lead Details']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Lead Details</h3><p class="empty-state-text">Lead information and follow-up history</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
