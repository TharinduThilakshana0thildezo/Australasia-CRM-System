<x-layouts.app title="Document">
<x-page-header title="Document" subtitle="Document details and version history" :breadcrumbs="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => route('documents.index'), 'label' => 'Documents'], ['url' => '#', 'label' => 'Document']]">
</x-page-header>
<div class="card"><div class="card-body"><div class="empty-state"><div class="empty-state-icon"><i data-lucide="layout" style="width:28px;height:28px"></i></div><h3 class="empty-state-title">Document</h3><p class="empty-state-text">Document details and version history</p></div></div></div>
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
