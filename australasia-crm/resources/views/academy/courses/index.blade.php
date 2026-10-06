<x-layouts.app title="Courses">
<x-page-header title="Courses" subtitle="Manage academy course catalogue" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.dashboard'), 'label' => 'Academy'], ['url' => '#', 'label' => 'Courses']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Courses</h3><p class="empty-state-text">Manage academy course catalogue</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
