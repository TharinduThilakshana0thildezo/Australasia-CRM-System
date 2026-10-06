<x-layouts.app title="Invoices">
<x-page-header title="Invoices" subtitle="Invoice management" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('finance.dashboard'), 'label' => 'Finance'], ['url' => '#', 'label' => 'Invoices']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Invoices</h3><p class="empty-state-text">Invoice management</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
