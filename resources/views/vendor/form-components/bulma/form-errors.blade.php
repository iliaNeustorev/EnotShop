@error($name, $bag)
    <div {!! $attributes->merge(['class' => 'help is-danger']) !!}>
        {{ $message }}
    </div>
@enderror