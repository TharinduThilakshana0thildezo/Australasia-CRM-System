<x-layouts.app title="New Student">
<x-page-header title="New Student" subtitle="Register a new consultancy student" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.students.index'), 'label' => 'Students'], ['url' => '#', 'label' => 'New Student']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Student</h3><p class="empty-state-text">Register a new consultancy student</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
