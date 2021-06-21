@props([
    'label',
    'route' => null,
    'url' => null,
    'href' => null,
    'click' => null,
])

@php
    if ($route) $href = route($route);
    else if ($url) $href = url($url);

    $attributes = $attributes->class([
        'dropdown-item',
    ])->merge([
        'type' => $click ? 'button' : null,
        'href' => $href,
        'wire:click' => $click,
    ]);
@endphp

<{{ $href ? 'a' : 'button' }} {{ $attributes }}>
    {{ $label }}
</{{ $href ? 'a' : 'button' }}>
