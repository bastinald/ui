@props([
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'dropdown-header',
    ])->merge([
        //
    ]);
@endphp

<li>
    <h6 {{ $attributes }}>
        {{ $label }}
    </h6>
</li>
