<x-layouts.app title="Academy Reports">
<x-page-header title="Academy Reports" subtitle="Academy performance analytics" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('reports.index'), 'label' => 'Reports'], ['url' => '#', 'label' => 'Academy Reports']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Academy Reports</h3><p class="empty-state-text">Academy performance analytics</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
