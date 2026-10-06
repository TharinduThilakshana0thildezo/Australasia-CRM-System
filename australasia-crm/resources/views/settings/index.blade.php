<x-layouts.app title="Settings">
<x-page-header title="Settings" subtitle="System configuration and preferences" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Settings']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Settings</h3><p class="empty-state-text">System configuration and preferences</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
