<?php

namespace App\Http\Controllers\Admin\Concerns;

trait ParsesLineLists
{
    /**
     * Convert a textarea's newline-separated lines into a clean list of strings.
     *
     * @return list<string>
     */
    protected function linesToArray(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value) ?: [])
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Convert a textarea's newline-separated "value|label" lines into a list of
     * ['value' => ..., 'label' => ...] pairs, used for case study results.
     *
     * @return list<array{value: string, label: string}>
     */
    protected function linesToPairs(?string $value): array
    {
        return collect($this->linesToArray($value))
            ->map(function (string $line): array {
                [$pairValue, $pairLabel] = array_pad(explode('|', $line, 2), 2, '');

                return [
                    'value' => trim($pairValue),
                    'label' => trim($pairLabel),
                ];
            })
            ->all();
    }
}
