<?php

declare(strict_types=1);

namespace ToneGabes\BetterOptions\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use ToneGabes\BetterOptions\Contracts\HasExtraText;
use UnitEnum;

trait HasExtraTexts
{
    /**
     * @var array<string | Htmlable> | Arrayable<array-key, string | Htmlable> | string | Closure | null
     */
    protected array|Arrayable|string|Closure|null $extraTexts = null;

    protected bool|Closure $isExtraTextVisible = true;

    public function hiddenExtraText(bool|Closure $condition = true): static
    {
        $this->isExtraTextVisible = ! $condition;

        return $this;
    }

    public function isExtraTextVisible(): bool
    {
        return (bool) $this->evaluate($this->isExtraTextVisible);
    }

    /**
     * @param  array<string | Htmlable> | Arrayable<array-key, string | Htmlable> | string | Closure | null  $extraTexts
     */
    public function extraTexts(array|Arrayable|string|Closure|null $extraTexts): static
    {
        $this->extraTexts = $extraTexts;

        if (is_string($extraTexts) && enum_exists($extraTexts)) {
            $this->enum($extraTexts);
        }

        return $this;
    }

    /**
     * @param  array-key  $value
     */
    public function hasExtraText($value): bool
    {
        return array_key_exists($value, $this->getExtraTexts());
    }

    /**
     * @param  array-key  $value
     */
    public function getExtraText($value): string|Htmlable|null
    {
        return $this->getExtraTexts()[$value] ?? null;
    }

    /**
     * @return array<string | Htmlable>
     */
    public function getExtraTexts(): array
    {
        $extraTexts = $this->evaluate($this->extraTexts);

        if ($extraTexts instanceof Arrayable) {
            $extraTexts = $extraTexts->toArray();
        }

        if (
            blank($extraTexts) &&
            filled($enum = $this->getEnum()) &&
            is_a($enum, HasExtraText::class, allow_string: true)
        ) {
            /** @var class-string<HasExtraText&UnitEnum> $enum */
            $extraTexts = array_reduce($enum::cases(), function (array $carry, HasExtraText&UnitEnum $case): array {
                if (filled($extraText = $case->getExtraText())) {
                    $carry[$case->value ?? $case->name] = $extraText;
                }

                return $carry;
            }, []);
        }

        return $extraTexts;
    }
}
