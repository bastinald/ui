@props([
    'model' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-control text-muted py-3',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'role' => 'button',
    ]);
@endphp

<div class="row gx-3 mb-3">
    <div class="col-auto">
        @if(($image = $this->getData($model)) && is_string($image))
            <div class="rounded image-preview" style="background-image: url('{{ Storage::url($image) }}');"></div>
        @elseif($this->hasUploadedData($model) && $image->isPreviewable())
            <div class="rounded image-preview" style="background-image: url('{{ $image->temporaryUrl() }}');"></div>
        @else
            <div class="d-flex justify-content-center align-items-center bg-light rounded image-preview">
                <i class="fas fa-fw fa-lg fa-image text-muted"></i>
            </div>
        @endif
    </div>
    <div class="col">
        <label {{ $attributes }}>
            <span wire:target="data.{{ $model }}" wire:loading.class="d-none">
                Select {{ $label }}
            </span>

            <span class="d-none" wire:target="data.{{ $model }}" wire:loading.class.remove="d-none">
                <i class="fas fa-fw fa-spinner fa-spin"></i> Uploading {{ $label }}
            </span>

            <input type="file" class="d-none" wire:model="data.{{ $model }}">
        </label>

        @error($model)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
