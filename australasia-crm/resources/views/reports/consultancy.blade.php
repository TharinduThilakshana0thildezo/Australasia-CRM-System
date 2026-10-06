<x-layouts.app title="Consultancy Reports">
<x-page-header title="Consultancy Reports" subtitle="Consultancy analytics and trends" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('reports.index'), 'label' => 'Reports'], ['url' => '#', 'label' => 'Consultancy Reports']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Consultancy Reports</h3><p class="empty-state-text">Consultancy analytics and trends</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
