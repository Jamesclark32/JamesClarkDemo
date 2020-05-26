<?php

namespace App\Importers;

use App\Repositories\Api\Placeholder\Comment;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PlaceholderComment
 *
 * @package App\Importers
 */
class PlaceholderComment extends Base
{
    /**
     * @var Collection $placeholderPosts
     */
    protected $placeholderPosts;

    /**
     * PlaceholderComment constructor.
     *
     * @param Comment $repository
     */
    public function __construct(Comment $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function import(): void
    {
        $this->setUp();
        $this->placeholderPosts = $this->loadPlaceholderPosts();
        $remoteData = $this->repository->index();
        $this->processRemoteData($remoteData);
    }

    /**
     * @param array $remoteDatum
     */
    protected function processRemoteDatum(array $remoteDatum): void
    {
        \App\Models\PlaceholderComment::updateOrCreate(
            [
                'remote_comment_id' => Arr::get($remoteDatum, 'id'),
            ],
            [
                'placeholder_post_id' => $this->getPostId($remoteDatum),
                'name' => Arr::get($remoteDatum, 'name'),
                'email' => Arr::get($remoteDatum, 'email'),
                'body' => Arr::get($remoteDatum, 'body'),
                'remote_post_id' => Arr::get($remoteDatum, 'postId'),
                'fetched_at' => $this->now,
            ]
        );
    }

    /**
     * @param $remotePost
     *
     * @return int
     */
    protected function getPostId($remotePost): int
    {
        return $this->placeholderPosts->get(Arr::get($remotePost, 'postId'));
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
