@php
    use Filament\Support\Enums\GridDirection;
    use Filament\Support\Facades\FilamentAsset;

    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $fieldWrapperView = $getFieldWrapperView();
    $gridDirection = $getGridDirection() ?? GridDirection::Row;
    $isBulkToggleable = $isBulkToggleable();
    $isDisabled = $isDisabled();
    $isHtmlAllowed = $isHtmlAllowed();
    $isSearchable = $isSearchable();
    $jsComponentSrc = FilamentAsset::getAlpineComponentSrc(
        'better-checkbox',
        'tonegabes/better-options'
    );
    $livewireKey = $getLivewireKey();
    $options = $getOptions();
    $statePath = $getStatePath();
    $wireModelAttribute = $applyStateBindingModifiers('wire:model');
@endphp

<x-dynamic-component :component="$fieldWrapperView" :field="$field">
    <div
        x-load
        x-load-src="{{ $jsComponentSrc }}"
        x-data="checkboxListFormComponent({
            livewireId: @js($this->getId()),
        })"
        {{ $getExtraAlpineAttributeBag()->class(['fi-fo-checkbox-card']) }}
    >

        @if ($isSearchable && ! $isDisabled)
            <x-better-options::search-input
                :search-prompt="$getSearchPrompt()"
                :search-debounce="$getSearchDebounce()"
            />
        @endif

        @if (! $isDisabled && $isBulkToggleable && count($options))
            <x-better-options::bulk-actions
                :livewire-key="$livewireKey"
                :select-all-action="$getAction('selectAll')"
                :deselect-all-action="$getAction('deselectAll')"
            />
        @endif

        <div
            {{
                $getExtraAttributeBag()
                    ->grid($getColumns(), $gridDirection)
                    ->merge([
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ], escape: false)
                    ->class(['fi-fo-checkbox-options'])
            }}
        >
            @forelse ($options as $value => $label)
                @php
                    $itemId = $getId()."-".$value;
                @endphp

                <label
                    wire:key="{{ $livewireKey }}.options.{{ $value }}"

                    @if ($isSearchable)
                        x-show="isFoundInSearch($el)"
                    @endif

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
                            const value = Array.isArray(currentValue) ? currentValue : [];
                            this.isSelected = value.includes('{{ $value }}');
                        }
                    }"
                    @class([
                        'fi-fo-checkbox-option',
                        'is-centered' => $isItemsCenter(),
                        'fi-invalid' => $errors->has($statePath),
                    ])
                    :class="{ 'is-selected': isSelected }"
                    role="checkbox"
                    :aria-checked="isSelected"
                    :aria-selected="isSelected"
                    :aria-disabled="{{ $isDisabled ? 'true' : 'false' }}"
                    for="{{ $itemId }}"
                    tabindex="0"
                >
                    <input
                        type="checkbox"
                        {{
                            $extraInputAttributeBag
                                ->class(['hidden'])
                                ->merge([
                                    'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                    'value' => $value,
                                    'wire:loading.attr' => 'disabled',
                                    $wireModelAttribute => $statePath,
                                    'x-on:change' => $isBulkToggleable ? 'checkIfAllCheckboxesAreChecked()' : null,
                                    'id' => $itemId,
                                ], escape: false)
                        }}
                    />

                    @if ($isIndicatorBefore() && $isIndicatorVisible())
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                            :idle-indicator="$getIdleIndicator()"
                            :selected-indicator="$getSelectedIndicator()"
                            class="fi-fo-checkbox-option__indicator"
                        />
                    @endif

                    @if ($hasIcon($value) && $isIconBefore())
                        @svg($getIcon($value), ['class' => 'fi-fo-checkbox-option__icon'])
                    @endif

                    <x-better-options::checkbox-content
                        :label="$label"
                        :description="$getDescription($value)"
                        :extra-text="$getExtraText($value)"
                        :is-html-allowed="$isHtmlAllowed"
                        :show-description="$hasDescription($value) && $isDescriptionVisible()"
                        :show-extra-text="$hasExtraText($value) && $isExtraTextVisible()"
                    />

                    @if ($hasIcon($value) && $isIconAfter())
                        @svg($getIcon($value), ['class' => 'fi-fo-checkbox-option__icon'])
                    @endif

                    @if ($isIndicatorAfter() && $isIndicatorVisible())
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden()"
                            :idle-indicator="$getIdleIndicator()"
                            :selected-indicator="$getSelectedIndicator()"
                            class="fi-fo-checkbox-option__indicator"
                        />
                    @endif
                </label>
            @empty
                <div wire:key="{{ $livewireKey }}.empty"></div>
            @endforelse
        </div>

        @if ($isSearchable)
            <div
                x-cloak
                x-show="search && ! visibleCheckboxListOptions.length"
                class="fi-fo-checkbox-list-no-search-results-message"
            >
                {{ $getNoSearchResultsMessage() }}
            </div>
        @endif
    </div>
</x-dynamic-component>
