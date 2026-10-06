<x-layouts.app title="Course Details">
<x-page-header title="Course Details" subtitle="Course batches and syllabus" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.courses.index'), 'label' => 'Courses'], ['url' => '#', 'label' => 'Course Details']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Course Details</h3><p class="empty-state-text">Course batches and syllabus</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
