<x-layouts.app title="Batches">
<x-page-header title="Batches" subtitle="Manage course batches and schedules" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.dashboard'), 'label' => 'Academy'], ['url' => '#', 'label' => 'Batches']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Batches</h3><p class="empty-state-text">Manage course batches and schedules</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
