<x-layouts.app title="New Vacancy">
<x-page-header title="New Vacancy" subtitle="Create a new job vacancy listing" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.vacancies.index'), 'label' => 'Vacancies'], ['url' => '#', 'label' => 'New Vacancy']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">New Vacancy</h3><p class="empty-state-text">Create a new job vacancy listing</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
