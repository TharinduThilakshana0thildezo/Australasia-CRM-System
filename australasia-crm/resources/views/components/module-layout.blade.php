@php
// This helper generates consistent stub views for modules not yet deeply implemented
@endphp
<x-layouts.app title="{{ $moduleTitle ?? 'Module' }}">
<x-page-header :title="$moduleTitle ?? 'Module'" :subtitle="$moduleSubtitle ?? ''" :breadcrumbs="$breadcrumbs ?? []">
    @isset($actions)
    <x-slot:actions>{{ $actions }}</x-slot:actions>
    @endisset
</x-page-header>
{{ $slot }}
<script>document.addEventListener('DOMContentLoaded', () => lucide.createIcons());</script>
</x-layouts.app>
