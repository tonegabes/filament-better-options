@props([
    'searchPrompt' => 'Search options...',
    'searchDebounce' => '500ms'
])

<x-filament::input.wrapper
    inline-prefix
    :prefix-icon="ToneGabes\Filament\Icons\Enums\Phosphor::MagnifyingGlass"
    :prefix-icon-alias="Filament\Forms\View\FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD"
    class="fi-fo-checkbox-list-search-input-wrp"
>
    <input
        placeholder="{{ $searchPrompt }}"
        type="search"
        x-model.debounce.{{ $searchDebounce }}="search"
        class="fi-input fi-input-has-inline-prefix"
    />
</x-filament::input.wrapper>
