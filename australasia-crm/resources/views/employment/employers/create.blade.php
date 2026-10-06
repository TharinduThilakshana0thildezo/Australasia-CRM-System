<x-layouts.app title="New Employer">
<x-page-header title="New Employer" subtitle="Register a new employer partner" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.employers.index'), 'label' => 'Employers'], ['url' => '#', 'label' => 'New Employer']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Employer</h3><p class="empty-state-text">Register a new employer partner</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
