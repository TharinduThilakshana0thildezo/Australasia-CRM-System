@props([
    'value' => 0,
    'label' => '',
    'icon' => 'users',
    'color' => 'indigo',
    'delta' => null,
    'deltaDir' => 'up',
    'href' => null,
    'accentColor' => '#6366f1',
])

@php
$iconBg = match($color) {
    'emerald' => 'bg-emerald-100',
    'amber'   => 'bg-amber-100',
    'rose'    => 'bg-rose-100',
    'cyan'    => 'bg-cyan-100',
    'violet'  => 'bg-violet-100',
    'teal'    => 'bg-teal-100',
    'orange'  => 'bg-orange-100',
    default   => 'bg-indigo-100',
};
$iconColor = match($color) {
    'emerald' => 'text-emerald-600',
    'amber'   => 'text-amber-600',
    'rose'    => 'text-rose-600',
    'cyan'    => 'text-cyan-600',
    'violet'  => 'text-violet-600',
    'teal'    => 'text-teal-600',
    'orange'  => 'text-orange-600',
    default   => 'text-indigo-600',
};
$accent = match($color) {
    'emerald' => '#10b981',
    'amber'   => '#f59e0b',
    'rose'    => '#f43f5e',
    'cyan'    => '#06b6d4',
    'violet'  => '#8b5cf6',
    'teal'    => '#14b8a6',
    'orange'  => '#f97316',
    default   => '#6366f1',
};
@endphp

<div class="stat-card" {{ $href ? 'onclick=window.location.href="'.$href.'"' : '' }}
     style="{{ $href ? 'cursor:pointer;' : '' }}">
    <div class="stat-accent" style="background: {{ $accent }}"></div>
    <div class="flex items-start justify-between">
        <div class="stat-icon {{ $iconBg }}">
            <i data-lucide="{{ $icon }}" class="w-5 h-5 {{ $iconColor }}"></i>
        </div>
        @if($delta !== null)
        <div class="stat-delta {{ $deltaDir === 'up' ? 'up' : 'down' }}">
            @if($deltaDir === 'up')
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="18 15 12 9 6 15"></polyline></svg>
            @else
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="6 9 12 15 18 9"></polyline></svg>
            @endif
            {{ $delta }}
        </div>
        @endif
    </div>
    <div class="stat-value">{{ is_numeric($value) ? number_format($value) : $value }}</div>
    <div class="stat-label">{{ $label }}</div>
    {{ $slot ?? '' }}
</div>
