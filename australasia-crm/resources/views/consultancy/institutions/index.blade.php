<x-layouts.app title="Institutions">
<x-page-header title="Institutions" subtitle="Partner universities and colleges" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.dashboard'), 'label' => 'Consultancy'], ['url' => '#', 'label' => 'Institutions']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Institutions</h3><p class="empty-state-text">Partner universities and colleges</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
