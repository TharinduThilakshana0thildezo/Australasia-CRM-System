<x-layouts.app title="Transactions">
<x-page-header title="Transactions" subtitle="All financial transactions" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('finance.dashboard'), 'label' => 'Finance'], ['url' => '#', 'label' => 'Transactions']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Transactions</h3><p class="empty-state-text">All financial transactions</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
