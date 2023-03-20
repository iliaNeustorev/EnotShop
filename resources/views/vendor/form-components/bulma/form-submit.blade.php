<button
    {!! $attributes->merge([
        'class' => 'button is-success',
        'type' => 'submit'
    ]) !!}
>
    {!! trim($slot) ?: __('Submit') !!}
</button>
