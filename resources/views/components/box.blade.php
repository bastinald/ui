@props([
    'col' => null,
])

@php
    $attributes = $attributes->class([
        'bg-white rounded shadow-sm p-3',
    ])->merge([
        //
    ]);
@endphp

<div class="@if($col) d-grid col-md-{{ $col }} mx-auto @endif">
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
</div>
