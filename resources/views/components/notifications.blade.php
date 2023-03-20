@if($hasMessage)
<article class="message is-{{ $messages[$message]['type'] }} is-light">
    <div class="message-body has-text-centered">
        {{ $messages[$message]['text'] }}
    </div>
</article>
@endif