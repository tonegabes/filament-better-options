@php
    use Filament\Support\Facades\FilamentAsset;
    use Filament\Forms\View\FormsIconAlias;
    use ToneGabes\Filament\Icons\Enums\Phosphor;

    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $fieldWrapperView = $getFieldWrapperView();
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
        {{ $getExtraAlpineAttributeBag()->class(['fi-fo-checkbox-list']) }}
    >
        @if (! $isDisabled)
            @if ($isSearchable)
                <x-filament::input.wrapper
                    inline-prefix
                    :prefix-icon="Phosphor::MagnifyingGlass"
                    :prefix-icon-alias="FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD"
                    class="fi-fo-checkbox-list-search-input-wrp"
                >
                    <input
                        placeholder="{{ $getSearchPrompt() }}"
                        type="search"
                        x-model.debounce.{{ $getSearchDebounce() }}="search"
                        class="fi-input fi-input-has-inline-prefix"
                    />
                </x-filament::input.wrapper>
            @endif

            @if ($isBulkToggleable && count($options))
                <div
                    x-cloak
                    class="fi-fo-checkbox-actions"
                    wire:key="{{ $livewireKey }}.actions"
                >
                    <span
                        x-show="! areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.select-all"
                    >
                        {{ $getAction('selectAll') }}
                    </span>

                    <span
                        x-show="areAllCheckboxesChecked"
                        x-on:click="toggleAllCheckboxes()"
                        wire:key="{{ $livewireKey }}.actions.deselect-all"
                    >
                        {{ $getAction('deselectAll') }}
                    </span>
                </div>
            @endif
        @endif

        <div
            {{
                $getExtraAttributeBag()
                    ->merge([
                        'x-show' => $isSearchable ? 'visibleCheckboxListOptions.length' : null,
                    ], escape: false)
                    ->class(['fi-fo-checkbox-options'])
            }}
        >
            @forelse ($options as $value => $label)
                <label
                    wire:key="{{ $livewireKey }}.options.{{ $value }}"

                    @if ($isSearchable)
                        x-show="isFoundInSearch($el)"
                    @endif

                    x-data="{ isSelected: false }"
                    x-init="$watch(
                        '$wire.{{ $statePath }}',
                        value => isSelected = value.includes('{{ $value }}')
                    )"
                    @class([
                        'fi-fo-checkbox-option',
                        'fi-invalid' => $errors->has($statePath),
                    ])
                    :class="{ 'is-selected': isSelected }"
                    :aria-checked="isSelected"
                    :aria-selected="isSelected"
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
                                ], escape: false)
                        }}
                    />

                    @if ($isIndicatorBefore() && $isIndicatorVisible())
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden"
                            :idle-indicator="$getIdleIndicator()"
                            :selected-indicator="$getSelectedIndicator()"
                            class="fi-fo-checkbox-option__indicator"
                        />
                    @endif

                    @if ($hasIconBefore() && $isIconVisible())
                        @svg($getOptionIcon($value), ['class' => 'fi-fo-checkbox-option__icon'])
                    @endif

                    <div class="fi-fo-checkbox-option__content">
                        <div class="fi-fo-checkbox-option__header">
                            <span class="fi-fo-checkbox-option__label">
                                @if ($isHtmlAllowed)
                                    {!! $label !!}
                                @else
                                    {{ $label }}
                                @endif
                            </span>

                            @if ($hasDescription($value))
                                <p class="fi-fo-checkbox-option__description">
                                    {{ $getDescription($value) }}
                                </p>
                            @endif
                        </div>

                        @if ($hasExtraText($value) && $isExtraTextVisible())
                            <p class="fi-fo-checkbox-option__extra">
                            {{ $getExtraText($value) }}
                            </p>
                        @endif
                    </div>

                    @if ($hasIconAfter() && $isIconVisible())
                        @svg($getOptionIcon($value), ['class' => 'fi-fo-checkbox-option__icon'])
                    @endif

                    @if ($isIndicatorAfter() && $isIndicatorVisible())
                        <x-better-options::option-indicator
                            ::is-selected="isSelected"
                            :is-indicator-partially-hidden="$isIndicatorPartiallyHidden"
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
