<x-layouts.app title="Counselling Sessions">
<x-page-header title="Counselling Sessions" subtitle="Schedule and track student counselling" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.dashboard'), 'label' => 'Consultancy'], ['url' => '#', 'label' => 'Counselling Sessions']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Counselling Sessions</h3><p class="empty-state-text">Schedule and track student counselling</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
