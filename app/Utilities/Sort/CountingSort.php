<?php

namespace App\Utilities\Sort;

/**
 * Class CountingSort
 *
 * @package App\Utilities\Sort
 */
class CountingSort
{
    /**
     * @param array $numbers
     * @param int $max
     *
     * @return array
     */
    public function sort(array $numbers, int $max): array
    {
        $counts = array_fill(1, $max, 0);

        foreach ($numbers as $number) {
            $counts[$number] = $counts[$number] + 1;
        }

        $numbers = [];

        foreach ($counts as $key => $value) {
            for ($i = 0; $i < $value; $i++) {
                $numbers[] = $key;
            }
        }
        return $numbers;
    }
}
