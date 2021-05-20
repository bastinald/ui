@props([
    'icon' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'nav-link',
        'active' => Request::url() == $attributes->get('href'),
    ])->merge([
        'href' => '#',
        'data-bs-toggle' => 'dropdown',
    ]);
@endphp

<li class="nav-item dropdown">
    <x-ui::link
        icon="{!! $icon !!}"
        label="{!! $label !!}"
        {{ $attributes }}/>
    <ul class="dropdown-menu dropdown-menu-end">
        {{ $slot }}
    </ul>
</li>
