@if($type === 'hidden') <div class="is-hidden"> @endif
@if($floating) <div class="form-floating"> @endif

    @if(!$floating)
        <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />
    @endif

    <input
        {!! $attributes->merge(['class' => 'input' . ($type === 'color' ? ' is-color' : '') . ($hasError($name) ? ' is-danger' : '')]) !!}

        type="{{ $type }}"

        @if($isWired())
            wire:model{!! $wireModifier() !!}="{{ $name }}"
        @else
            value="{{ $value ?? ($type === 'color' ? '#000000' : '') }}"
        @endif

        name="{{ $name }}"

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif

        {{--  Placeholder is required as of writing  --}}
        @if($floating && !$attributes->get('placeholder'))
            placeholder="&nbsp;"
        @endif
    />

    @if($floating)
        <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />
    @endif

@if($floating) </div> @endif

{!! $help ?? null !!}

@if($hasErrorAndShow($name))
    <x-form-errors :name="$name" />
@endif

@if($type === 'hidden') </div> @endif
