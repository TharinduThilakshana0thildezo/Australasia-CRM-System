<x-layouts.app title="Certificates">
<x-page-header title="Certificates" subtitle="Issued certificates and verification" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('academy.dashboard'), 'label' => 'Academy'], ['url' => '#', 'label' => 'Certificates']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Certificates</h3><p class="empty-state-text">Issued certificates and verification</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
