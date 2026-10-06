<x-layouts.app title="Students">
<x-page-header title="Students" subtitle="All consultancy students" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.dashboard'), 'label' => 'Consultancy'], ['url' => '#', 'label' => 'Students']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Students</h3><p class="empty-state-text">All consultancy students</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
