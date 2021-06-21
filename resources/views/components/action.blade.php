@props([
    'icon',
    'title',
    'route' => null,
    'url' => null,
    'href' => null,
    'click' => null,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'btn btn-link px-1 py-0',
    ])->merge([
        'type' => $click ? 'button' : null,
        'title' => $title,
        'href' => $href,
        'wire:click' => $click,
    ]);
@endphp

<{{ $href ? 'a' : 'button' }} {{ $attributes }}>
    <x-ui::icon :name="$icon"/>
</{{ $href ? 'a' : 'button' }}>
