<div {!! $attributes->merge(['class' => ($hasError($name) ? 'is-danger' : '')]) !!}>
    <x-form-label :label="$label" />

    <div class="@if($inline) field is-grouped @endif">
        {!! $slot !!}
    </div>

    {!! $help ?? null !!}

    @if($hasErrorAndShow($name))
        <x-form-errors :name="$name" class="is-block" />
    @endif
</div>
