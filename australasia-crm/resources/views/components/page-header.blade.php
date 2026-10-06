@props([
    'title' => '',
    'subtitle' => null,
    'breadcrumbs' => [],
])
<div class="page-header flex flex-col md:flex-row md:items-start md:justify-between gap-3">
    <div>
        @if(count($breadcrumbs) > 0)
        <nav class="breadcrumb mb-1">
            @foreach($breadcrumbs as $crumb)
                @if(!$loop->last)
                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                    <span class="breadcrumb-sep">/</span>
                @else
                    <span class="text-slate-500">{{ $crumb['label'] }}</span>
                @endif
            @endforeach
        </nav>
        @endif
        <h1 class="page-title">{{ $title }}</h1>
        @if($subtitle)
            <p class="page-subtitle">{{ $subtitle }}</p>
        @endif
    </div>

    @if(isset($actions))
    <div class="flex items-center gap-2 flex-shrink-0">
        {{ $actions }}
    </div>
    @endif
</div>
