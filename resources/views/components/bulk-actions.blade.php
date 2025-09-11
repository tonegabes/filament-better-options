@props([
    'livewireKey' => '',
    'selectAllAction' => null,
    'deselectAllAction' => null
])

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
        {{ $selectAllAction }}
    </span>

    <span
        x-show="areAllCheckboxesChecked"
        x-on:click="toggleAllCheckboxes()"
        wire:key="{{ $livewireKey }}.actions.deselect-all"
    >
        {{ $deselectAllAction }}
    </span>
</div>
