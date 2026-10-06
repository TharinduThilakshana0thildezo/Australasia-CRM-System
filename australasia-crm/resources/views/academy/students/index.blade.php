<x-layouts.app title="Students">
<x-page-header title="Students" subtitle="All academy students and enrollments" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.dashboard'), 'label' => 'Academy'], ['url' => '#', 'label' => 'Students']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Students</h3><p class="empty-state-text">All academy students and enrollments</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
