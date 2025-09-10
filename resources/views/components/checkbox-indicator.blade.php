@props([
    'isSelected',
    'isIndicatorPartiallyHidden',
    'defaultIndicator',
    'selectedIndicator',
])

<template x-if="isSelected">
    <x-icon
        :name="$selectedIndicator"
        @class([
            'fi-fo-checkbox-option__indicator',
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
<template x-if="! isSelected">
    <x-icon
        :name="$defaultIndicator"
        @class([
            'fi-fo-checkbox-option__indicator',
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
