<div class="radio">
    <input
        {!! $attributes->merge(['class' => 'radio' . ($hasError($name) ? ' is-danger' : '')]) !!}

        type="radio"

        value="{{ $value }}"

        @if($isWired())
            wire:model{!! $wireModifier() !!}="{{ $name }}"
        @endif

        name="{{ $name }}"

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif

        @if($checked)
            checked="checked"
        @endif
    />

    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" class="radio" />

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
