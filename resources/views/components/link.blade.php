@props([
    'action' => null,
    'icon' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        //
    ])->merge([
        'href' => '#',
        'wire:click.prevent' => $action,
    ]);
@endphp

<a {{ $attributes }}>
    @if($icon)
        <i class="fas fa-fw fa-{{ $icon }}"
            wire:target="{{ $action }}"
            wire:loading.class="d-none"></i>
    @endif

    @if($action)
        <i class="fas fa-fw fa-spinner fa-spin d-none"
            wire:target="{{ $action }}"
            wire:loading.class.remove="d-none"></i>
    @endif

    @if($label)
        <span
            wire:target="{{ $action }}"
            wire:loading.class="{{ !$icon ? 'd-none' : '' }}">
            {{ $label }}
        </span>
    @endif
</a>
