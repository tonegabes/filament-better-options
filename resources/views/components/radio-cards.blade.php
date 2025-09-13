@php
    use Filament\Support\Enums\GridDirection;

    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $fieldWrapperView = $getFieldWrapperView();
    $gridDirection = $getGridDirection() ?? GridDirection::Row;
    $id = $getId();
    $isDisabled = $isDisabled();
    $livewireKey = $getLivewireKey();
    $statePath = $getStatePath();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component
    :component="$fieldWrapperView"
    :field="$field"
    class="fi-fo-radio-cards-wrapper"
>
    <div
        {{
            $getExtraAttributeBag()
                ->grid($getColumns(), $gridDirection)
                ->class(['fi-fo-radio-cards'])
        }}
    >
        @foreach ($getOptions() as $value => $label)
            @php
                $itemId = "$id-$value";
                $inputAttributes = $extraInputAttributeBag
                    ->merge([
                        'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                        'id' => $itemId,
                        'name' => $id,
                        'value' => $value,
                        'wire:loading.attr' => 'disabled',
                        $wireModelAttribute => $statePath,
                    ], escape: false);
            @endphp

            <label
                @class([
                    'fi-fo-radio-card group/radio-card',
                    'fi-invalid' => $errors->has($statePath),
                    'is-centered' => $isItemsCenter(),
                ])
                x-data="{ isSelected: false }"
                x-init="$watch(
                    '$wire.{{ $statePath }}',
                    value => isSelected = (value ?? '') === '{{ $value }}'
                )"
                :class="{ 'is-selected': isSelected }"
                role="radio"
                :aria-checked="isSelected"
                :aria-selected="isSelected"
                for="{{ $itemId }}"
                :aria-disabled="{{ $isDisabled ? 'true' : 'false' }}"
                tabindex="0"
            >
                @if ($isIndicatorBefore() && $isIndicatorVisible())
                    <x-better-options::option-indicator
                        ::is-selected="isSelected"
                        :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                        :idle-indicator="$getIdleIndicator()"
                        :selected-indicator="$getSelectedIndicator()"
                        class="fi-fo-radio-card__indicator"
                    />
                @endif

                @if ($hasIcon($value) && $isIconBefore())
                    @svg($getIcon($value), ['class' => 'fi-fo-radio-card__icon'])
                @endif

                <div class="fi-fo-radio-card__content">
                    <div class="fi-fo-radio-card__header">
                        <p class="fi-fo-radio-card__label">{{ $label }}</p>

                        @if ($hasDescription($value) && $isDescriptionVisible())
                            <p class="fi-fo-radio-card__description">
                                {{ $getDescription($value) }}
                            </p>
                        @endif
                    </div>

                    @if ($hasExtraText($value) && $isExtraTextVisible())
                        <p class="fi-fo-radio-card__extra">
                            {{ $getExtraText($value) }}
                        </p>
                    @endif
                </div>

                @if ($hasIcon($value) && $isIconAfter())
                    @svg($getIcon($value), ['class' => 'fi-fo-radio-card__icon'])
                @endif

                @if ($isIndicatorAfter() && $isIndicatorVisible())
                    <x-better-options::option-indicator
                        ::is-selected="isSelected"
                        :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                        :idle-indicator="$getIdleIndicator()"
                        :selected-indicator="$getSelectedIndicator()"
                        class="fi-fo-radio-card__indicator"
                    />
                @endif

                <input
                    type="radio"
                    {{ $inputAttributes->class(['hidden']) }}
                />
            </label>
        @endforeach
    </div>
</x-dynamic-component>
