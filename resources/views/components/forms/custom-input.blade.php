<div class="field mt-2">
    @if($label)
        <label class="label">{{ $label }}</label>
    @endif
    <div class="control @if($icon) has-icons-left @endif">
        <x-form-input name="{{ $name }}" type="{{ $type }}" placeholder="{{ $placeholder }}"/>
        @if($icon)
            <span class="icon is-left">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
    </div>
</div>
