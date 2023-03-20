<div class="checkbox">
    <input
        {!! $attributes->merge(['class' => 'checkbox' . ($hasError($name) ? ' is-danger' : '')]) !!}

        type="checkbox"

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

    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" class="checkbox" />

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" />
    @endif
</div>
