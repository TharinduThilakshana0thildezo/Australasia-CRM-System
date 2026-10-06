<x-layouts.app title="Payments">
<x-page-header title="Payments" subtitle="Payment records and receipts" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('finance.dashboard'), 'label' => 'Finance'], ['url' => '#', 'label' => 'Payments']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Payments</h3><p class="empty-state-text">Payment records and receipts</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
