@php
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $fieldWrapperView = $getFieldWrapperView();
    $id = $getId();
    $isDisabled = $isDisabled();
    $livewireKey = $getLivewireKey();
    $statePath = $getStatePath();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component
    :component="$fieldWrapperView"
    :field="$field"
    class="fi-fo-radio-table-wrapper"
>
    <div
        {{ $getExtraAttributeBag()->class(['fi-fo-radio-table']) }}
        role="table"
    >
        @foreach ($getOptions() as $value => $label)
            @php
                $itemId = "$id-$value";
                $optionColor = $getOptionColor($value);
                $optionStyles = $getOptionColorStyles($optionColor);
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
                    'fi-fo-radio-item fi-fo-radio-table-row group/radio-item',
                    'fi-invalid' => $errors->has($statePath),
                ])
                x-data="{
                    isSelected: @js(($getState() ?? $getDefaultState() ?? '') === $value),
                    init() {
                        this.$watch('$wire.{{ $statePath }}', (newValue) => {
                            this.isSelected = (newValue ?? '') === '{{ $value }}';
                        });
                    }
                }"
                :class="{ 'is-selected': isSelected }"
                role="row"
                :aria-checked="isSelected"
                :aria-selected="isSelected"
                for="{{ $itemId }}"
                :aria-disabled="{{ $isDisabled ? 'true' : 'false' }}"
                style="{{ $optionStyles }}"
                tabindex="0"
            >
                @if ($isIndicatorBefore() && $isIndicatorVisible())
                    <div class="fi-fo-radio-table-cell fi-fo-radio-table-cell--indicator" role="cell">
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                            :idle-indicator="$getIdleIndicator()"
                            :selected-indicator="$getSelectedIndicator()"
                            class="fi-fo-radio-item__indicator"
                        />
                    </div>
                @endif

                @if ($hasIcon($value) && $isIconBefore())
                    <div class="fi-fo-radio-table-cell fi-fo-radio-table-cell--icon" role="cell">
                        @svg($getIcon($value), ['class' => 'fi-fo-radio-item__icon'])
                    </div>
                @endif

                <div class="fi-fo-radio-table-cell fi-fo-radio-table-cell--content" role="cell">
                    <div class="fi-fo-radio-item__header">
                        <p class="fi-fo-radio-item__label">{{ $label }}</p>

                        @if ($hasDescription($value) && $isDescriptionVisible())
                            <p class="fi-fo-radio-item__description">
                                {{ $getDescription($value) }}
                            </p>
                        @endif
                    </div>

                    @if ($hasExtraText($value) && $isExtraTextVisible())
                        <p class="fi-fo-radio-item__extra">
                            {{ $getExtraText($value) }}
                        </p>
                    @endif
                </div>

                @if ($hasIcon($value) && $isIconAfter())
                    <div class="fi-fo-radio-table-cell fi-fo-radio-table-cell--icon" role="cell">
                        @svg($getIcon($value), ['class' => 'fi-fo-radio-item__icon'])
                    </div>
                @endif

                @if ($isIndicatorAfter() && $isIndicatorVisible())
                    <div class="fi-fo-radio-table-cell fi-fo-radio-table-cell--indicator" role="cell">
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                            :idle-indicator="$getIdleIndicator()"
                            :selected-indicator="$getSelectedIndicator()"
                            class="fi-fo-radio-item__indicator"
                        />
                    </div>
                @endif

                <input
                    type="radio"
                    {{ $inputAttributes->class(['hidden']) }}
                />
            </label>
        @endforeach
    </div>
</x-dynamic-component>
