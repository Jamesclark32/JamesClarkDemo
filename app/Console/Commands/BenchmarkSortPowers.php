<?php

namespace App\Console\Commands;

use App\Utilities\Sort\QuickSort;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

/**
 * Class BenchmarkSortPowers
 *
 * @package App\Console\Commands
 */
class BenchmarkSortPowers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark-sort-powers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Estimate run time of powers sorting';

    /**
     * @var QuickSort $quickSortUtility
     */
    protected $quickSortUtility;

    /**
     * BenchmarkSortPowers constructor.
     *
     * @param QuickSort $quickSortUtility
     */
    public function __construct(QuickSort $quickSortUtility)
    {
        $this->quickSortUtility = $quickSortUtility;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $numbers = $this->getNumbers();

        $startTime = microtime(true);

        $numbers = $this->resolveNumbers($numbers);
        $numbers = $this->quickSortUtility->sort($numbers, 'float');

        $endTime = microtime(true);
        $runTime = $endTime - $startTime;

        $this->output->text(trans('console/commands/benchmark_sort_powers.run_completed', [
            'runSeconds' => $runTime,
        ]));
    }

    /**
     * @return array
     */
    protected function getNumbers(): array
    {
        $numbers = [];

        $count = 10000;

        for ($i = 0; $i < $count; $i++) {
            $numbers[] = [
                'number' => rand(100, 10000),
                'power' => rand(100, 10000),
            ];
        }

        return $numbers;
    }

    /**
     * @param array $numbers
     *
     * @return array
     */
    protected function resolveNumbers(array $numbers): array
    {
        $transformedNumbers = [];

        foreach ($numbers as $number) {
            $transformedNumbers[] = [
                'number' => Arr::get($number, 'number', 1),
                'power' => Arr::get($number, 'power', 1),
                'float' => $this->resolveNumber($number),
            ];
        }

        return $transformedNumbers;
    }

    /**
     * @param array $number
     *
     * @return float
     */
    protected function resolveNumber(array $number): float
    {
        return (Arr::get($number, 'number', 1)) ** log10((Arr::get($number, 'power', 1)));
    }
}
