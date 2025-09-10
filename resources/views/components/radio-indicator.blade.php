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
            'fi-fo-radio__indicator',
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
<template x-if="! isSelected">
    <x-icon
        :name="$defaultIndicator"
        @class([
            'fi-fo-radio__indicator',
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
