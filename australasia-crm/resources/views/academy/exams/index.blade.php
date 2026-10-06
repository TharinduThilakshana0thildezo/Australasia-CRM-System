<x-layouts.app title="Exams">
<x-page-header title="Exams" subtitle="Exam scheduling and results" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.dashboard'), 'label' => 'Academy'], ['url' => '#', 'label' => 'Exams']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Exams</h3><p class="empty-state-text">Exam scheduling and results</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
