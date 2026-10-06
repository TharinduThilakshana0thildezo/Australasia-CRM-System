<x-layouts.app title="Vacancy Details">
<x-page-header title="Vacancy Details" subtitle="Vacancy requirements and candidate matches" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.vacancies.index'), 'label' => 'Vacancies'], ['url' => '#', 'label' => 'Vacancy Details']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Vacancy Details</h3><p class="empty-state-text">Vacancy requirements and candidate matches</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
