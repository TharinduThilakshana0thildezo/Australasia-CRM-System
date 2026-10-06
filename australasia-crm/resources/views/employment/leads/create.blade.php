<x-layouts.app title="New Lead">
<x-page-header title="New Lead" subtitle="Register a new Employment lead" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.leads.index'), 'label' => 'Leads'], ['url' => '#', 'label' => 'New Lead']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Lead</h3><p class="empty-state-text">Register a new Employment lead</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
