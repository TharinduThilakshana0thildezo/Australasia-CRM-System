<x-layouts.app title="Initiate Refund">
<x-page-header title="Initiate Refund" subtitle="Create a new refund case" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('employment.refunds.index'), 'label' => 'Refunds'], ['url' => '#', 'label' => 'Initiate Refund']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Initiate Refund</h3><p class="empty-state-text">Create a new refund case</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
