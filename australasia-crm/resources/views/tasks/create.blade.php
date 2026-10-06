<x-layouts.app title="New Task">
<x-page-header title="New Task" subtitle="Create a new task or follow-up" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('tasks.index'), 'label' => 'Tasks'], ['url' => '#', 'label' => 'New Task']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Task</h3><p class="empty-state-text">Create a new task or follow-up</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
