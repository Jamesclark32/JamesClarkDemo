<?php

namespace App\Importers;

use App\Repositories\Api\Placeholder\User;
use Illuminate\Support\Arr;

/**
 * Class PlaceholderUser
 *
 * @package App\Importers
 */
class PlaceholderUser extends Base
{
    /**
     * PlaceholderUser constructor.
     *
     * @param User $repository
     */
    public function __construct(User $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function import(): void
    {
        $this->setUp();
        $remoteData = $this->repository->index();
        $this->processRemoteData($remoteData);
    }

    /**
     * @param array $remoteDatum
     */
    protected function processRemoteDatum(array $remoteDatum): void
    {
        \App\Models\PlaceholderUser::updateOrCreate(
            [
                'remote_user_id' => Arr::get($remoteDatum, 'id'),
            ],
            [
                'name' => Arr::get($remoteDatum, 'name'),
                'username' => Arr::get($remoteDatum, 'username'),
                'email' => Arr::get($remoteDatum, 'email'),
                'phone' => Arr::get($remoteDatum, 'phone'),
                'website' => Arr::get($remoteDatum, 'website'),
                'fetched_at' => $this->now,
            ]
        );
    }
}
