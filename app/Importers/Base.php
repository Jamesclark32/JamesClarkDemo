<?php

namespace App\Importers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class Base
 *
 * @package App\Importers
 */
class Base
{
    /**
     * @var Carbon $now
     */
    protected $now;

    /**
     * @var \App\Repositories\Api\Placeholder\Base $repository
     */
    protected $repository;

    /**
     *
     */
    public function setUp(): void
    {
        $this->now = Carbon::now();
    }

    /**
     * @param Collection $remoteData
     */
    protected function processRemoteData(Collection $remoteData): void
    {
        foreach ($remoteData as $remoteDatum) {
            $this->processRemoteDatum($remoteDatum);
        }
    }

    /**
     * @param array $remoteDatum
     *
     * @return void
     */
    protected function processRemoteDatum(array $remoteDatum): void
    {
        //
    }

    /**
     * @return Collection
     */
    protected function loadPlaceholderPosts(): Collection
    {
        return DB::table('placeholder_posts')
            ->select([
                'id',
                'remote_post_id',
            ])
            ->whereNull('deleted_at')
            ->pluck('id', 'remote_post_id');
    }
}
