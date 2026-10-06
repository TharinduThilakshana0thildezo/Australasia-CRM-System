<x-layouts.app title="Staff Profile">
<x-page-header title="Staff Profile" subtitle="Staff member details and activity" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('staff.index'), 'label' => 'Staff'], ['url' => '#', 'label' => 'Staff Profile']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Staff Profile</h3><p class="empty-state-text">Staff member details and activity</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
