<x-layouts.app title="Employer Profile">
<x-page-header title="Employer Profile" subtitle="Employer details, vacancies and history" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.employers.index'), 'label' => 'Employers'], ['url' => '#', 'label' => 'Employer Profile']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Employer Profile</h3><p class="empty-state-text">Employer details, vacancies and history</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
