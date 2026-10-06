<x-layouts.app title="Applications">
<x-page-header title="Applications" subtitle="Institution application tracking" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('consultancy.dashboard'), 'label' => 'Consultancy'], ['url' => '#', 'label' => 'Applications']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Applications</h3><p class="empty-state-text">Institution application tracking</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
