<?php

namespace App\Queries\Api\V1\Post;

use App\Models\PlaceholderPost;

/**
 * Class Index
 *
 * @package App\Queries\Api\V1\Post
 */
class Index
{
    /**
     * @return array|array[]
     */
    public function getData(): array
    {
        return [
            'posts' => $this->getPosts(),
        ];
    }

    /**
     * @return array
     */
    protected function getPosts(): array
    {
        return PlaceholderPost::get()->toArray();
    }
}
