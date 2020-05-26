<?php

namespace App\Utilities\Sort;

use Illuminate\Support\Arr;

/**
 * Class QuickSort
 *
 * @package App\Utilities\Sort
 */
class QuickSort
{
    /**
     * @param array $array
     * @param string $comparisonElement
     *
     * @return array
     */
    public function sort(array $array, string $comparisonElement): array
    {
        if (count($array) < 2) {
            return $array;
        }

        $lower = [];
        $higher = [];

        $pivot = array_shift($array);

        foreach ($array as $key => $value) {

            if (Arr::get($value, $comparisonElement) < Arr::get($pivot, $comparisonElement)) {
                $lower[$key] = $value;
                continue;
            }

            $higher[$key] = $value;
        }

        return array_merge(
            $this->sort($lower, $comparisonElement),
            [$pivot],
            $this->sort($higher, $comparisonElement)
        );
    }
}
