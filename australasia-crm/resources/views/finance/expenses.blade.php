<x-layouts.app title="Expenses">
<x-page-header title="Expenses" subtitle="Operational expense tracking" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('finance.dashboard'), 'label' => 'Finance'], ['url' => '#', 'label' => 'Expenses']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Expenses</h3><p class="empty-state-text">Operational expense tracking</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
