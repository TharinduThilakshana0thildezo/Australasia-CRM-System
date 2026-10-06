<x-layouts.app title="Student Profile">
<x-page-header title="Student Profile" subtitle="Student journey and application history" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.students.index'), 'label' => 'Students'], ['url' => '#', 'label' => 'Student Profile']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Student Profile</h3><p class="empty-state-text">Student journey and application history</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
