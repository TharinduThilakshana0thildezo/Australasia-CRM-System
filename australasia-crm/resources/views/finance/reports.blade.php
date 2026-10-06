<x-layouts.app title="Finance Reports">
<x-page-header title="Finance Reports" subtitle="Financial reporting and export" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('finance.dashboard'), 'label' => 'Finance'], ['url' => '#', 'label' => 'Finance Reports']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Finance Reports</h3><p class="empty-state-text">Financial reporting and export</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
