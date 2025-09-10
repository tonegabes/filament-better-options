@props([
    'isSelected',
    'isIndicatorPartiallyHidden',
    'idleIndicator',
    'selectedIndicator',
    'class' => 'fi-fo-option-indicator',
])

<template x-if="isSelected">
    <x-icon
        :name="$selectedIndicator"
        @class([
            $class,
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
<template x-if="! isSelected">
    <x-icon
        :name="$idleIndicator"
        @class([
            $class,
            'is-indicator-partially-hidden' => $isIndicatorPartiallyHidden(),
        ])
    />
</template>
