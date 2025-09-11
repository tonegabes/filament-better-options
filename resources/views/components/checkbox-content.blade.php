@props([
    'label' => '',
    'description' => '',
    'extraText' => '',
    'showDescription' => false,
    'showExtraText' => false,
    'isHtmlAllowed' => false,
])

<div class="fi-fo-checkbox-option__content">
    <div class="fi-fo-checkbox-option__header">
        <span class="fi-fo-checkbox-option__label">
            @if ($isHtmlAllowed)
                {!! $label !!}
            @else
                {{ $label }}
            @endif
        </span>

        @if ($showDescription)
            <p class="fi-fo-checkbox-option__description">
                {{ $description }}
            </p>
        @endif
    </div>

    @if ($showExtraText)
        <p class="fi-fo-checkbox-option__extra">
            {{ $extraText }}
        </p>
    @endif
</div>
