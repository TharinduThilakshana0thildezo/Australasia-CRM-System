<x-layouts.app title="New Staff Member">
<x-page-header title="New Staff Member" subtitle="Add a new staff account" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('staff.index'), 'label' => 'Staff'], ['url' => '#', 'label' => 'New Staff Member']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Staff Member</h3><p class="empty-state-text">Add a new staff account</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
