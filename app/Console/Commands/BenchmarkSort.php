<?php

namespace App\Console\Commands;

use App\Utilities\Sort\CountingSort;
use Illuminate\Console\Command;

/**
 * Class BenchmarkSort
 *
 * @package App\Console\Commands
 */
class BenchmarkSort extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark-sort';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Estimate run time of sort() method based on sample run';

    /**
     * @var CountingSort $countingSortUtility
     */
    protected $countingSortUtility;

    /**
     * BenchmarkSort constructor.
     *
     * @param CountingSort $countingSortUtility
     */
    public function __construct(CountingSort $countingSortUtility)
    {
        $this->countingSortUtility = $countingSortUtility;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = 100000;
        $arrays = $this->generateRandomArrays($count);

        $this->output->text(trans('console/commands/benchmark_sort.preparing_run', [
            'count' => number_format($count),
        ]));

        $startTime = microtime(true);

        $arrays = $this->sortArrays($arrays);

        $endTime = microtime(true);
        $runTime = $endTime - $startTime;

        $perUnitAverage = ($endTime - $startTime) / $count;

        $this->output->text(trans('console/commands/benchmark_sort.run_completed', [
            'runSeconds' => $runTime,
        ]));

        $this->output->text(trans('console/commands/benchmark_sort.table_title', [
            'count' => number_format($count),
        ]));

        $tableHeaders = $this->fetchOutputTableHeaders();
        $tableData = $this->fetchOutputTableData($perUnitAverage);

        $this->table($tableHeaders, $tableData);
    }

    /**
     * @param array $arrays
     *
     * @return array
     */
    protected function sortArrays(array $arrays): array
    {
        foreach ($arrays as $array) {

            //sort($array);
            $this->countingSortUtility->sort($array, 99);
        }
        return $arrays;
    }

    /**
     * @return array
     */
    protected function fetchOutputTableHeaders(): array
    {
        return [
            trans('console/commands/benchmark_sort.table_columns.count'),
            trans('console/commands/benchmark_sort.table_columns.seconds'),
            trans('console/commands/benchmark_sort.table_columns.minutes'),
            trans('console/commands/benchmark_sort.table_columns.hours'),
        ];
    }

    /**
     * @param float $perUnitAverage
     *
     * @return array
     */
    protected function fetchOutputTableData(float $perUnitAverage): array
    {
        $data = [];

        foreach ($this->getTableDisplayIncrements() as $increment) {
            $data[] = [
                number_format($increment),
                $perUnitAverage * $increment,
                $perUnitAverage * $increment / 60,
                $perUnitAverage * $increment / 60 / 60,
            ];
        }

        return $data;
    }

    /**
     * @param int $count
     *
     * @return array
     */
    protected function generateRandomArrays(int $count): array
    {
        $arrays = [];

        for ($i = 0; $i < $count; $i++) {
            $arrays[] = $this->generateRandomArray();
        }

        return $arrays;
    }

    /**
     * @return array
     */
    protected function generateRandomArray(): array
    {
        $numbers = [];

        for ($i = 0; $i < 11; $i++) {
            $numbers[] = rand(1, 99);
        }

        return $numbers;
    }

    /**
     * @return array
     */
    protected function getTableDisplayIncrements(): array
    {
        return [
            1,
            10,
            100,
            1000,
            10000,
            100000,
            1000000,
            10000000,
            100000000,
            1000000000,
            10000000000,
        ];
    }
}
