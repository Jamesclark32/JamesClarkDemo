<?php

namespace App\Importers;

use App\Repositories\Api\Placeholder\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PlaceholderPost
 *
 * @package App\Importers
 */
class PlaceholderPost extends Base
{
    /**
     * @var Collection $placeholderUsers
     */
    protected $placeholderUsers;

    /**
     * PlaceholderPost constructor.
     *
     * @param Post $repository
     */
    public function __construct(Post $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function import(): void
    {
        $this->setUp();
        $this->placeholderUsers = $this->loadPlaceholderUsers();
        $remoteData = $this->repository->index();
        $this->processRemoteData($remoteData);
    }

    /**
     * @param array $remotePost
     */
    protected function processRemoteDatum(array $remotePost): void
    {
        \App\Models\PlaceholderPost::updateOrCreate(
            [
                'remote_post_id' => Arr::get($remotePost, 'id'),
            ],
            [
                'placeholder_user_id' => $this->getUserId($remotePost),
                'remote_user_id' => Arr::get($remotePost, 'userId'),
                'title' => Arr::get($remotePost, 'title'),
                'body' => Arr::get($remotePost, 'body'),
                'fetched_at' => $this->now,
            ]
        );
    }

    /**
     * @param $remotePost
     *
     * @return int
     */
    protected function getUserId($remotePost): int
    {
        return $this->placeholderUsers->get(Arr::get($remotePost, 'userId'));
    }

    /**
     * @return Collection
     */
    protected function loadPlaceholderUsers(): Collection
    {
        return DB::table('placeholder_users')
            ->select([
                'id',
                'remote_user_id',
            ])
            ->whereNull('deleted_at')
            ->pluck('id', 'remote_user_id');
    }
}
