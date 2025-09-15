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
    class="fi-fo-radio-list-wrapper"
>
    <div
        {{ $getExtraAttributeBag()->class(['fi-fo-radio-list'])}}
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
                    'fi-fo-radio-item group/radio-item',
                    'fi-invalid' => $errors->has($statePath),
                ])
                x-data="{
                    isSelected: false,
                    init() {
                        this.updateSelectedState();

                        this.$watch('$wire.{{ $statePath }}', () => {
                            this.updateSelectedState();
                        });
                    },
                    updateSelectedState() {
                        const currentValue = $wire.get('{{ $statePath }}');
                        this.isSelected = (currentValue ?? '') === '{{ $value }}';
                    }
                }"
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
                            class="fi-fo-radio-item__indicator"
                        />
                    @endif

                    @if ($hasIcon($value) && $isIconBefore())
                        @svg($getIcon($value), ['class' => 'fi-fo-radio-item__icon'])
                    @endif

                <div class="fi-fo-radio-item__content">
                    <div class="fi-fo-radio-item__header">
                        <p class="fi-fo-radio-item__label">{{ $label }}</p>

                        @if ($hasDescription($value) && $isDescriptionVisible())
                            <p class="fi-fo-radio-item__description">
                                {{ $getDescription($value) }}
                            </p>
                        @endif
                    </div>
                </div>

                @if ($hasExtraText($value) && $isExtraTextVisible())
                    <p class="fi-fo-radio-item__extra">
                        {{ $getExtraText($value) }}
                    </p>
                @endif

                @if ($hasIcon($value) && $isIconAfter())
                    @svg($getIcon($value), ['class' => 'fi-fo-radio-item__icon'])
                @endif

                @if ($isIndicatorAfter() && $isIndicatorVisible())
                    <x-better-options::option-indicator
                        ::is-selected="isSelected"
                        :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                        :idle-indicator="$getIdleIndicator()"
                        :selected-indicator="$getSelectedIndicator()"
                        class="fi-fo-radio-item__indicator"
                    />
                @endif

                <input
                    type="radio"
                    {{ $inputAttributes->class(['hidden'])}}
                />
            </label>
        @endforeach
    </div>
</x-dynamic-component>
