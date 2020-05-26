<?php

namespace App\Queries\Api\V1\Comment;

use App\Models\PlaceholderComment;

/**
 * Class Index
 *
 * @package App\Queries\Api\V1\Comment
 */
class Index
{
    /**
     * @return array|array[]
     */
    public function getData(): array
    {
        return [
            'comments' => $this->getComments(),
        ];
    }

    /**
     * @return array
     */
    protected function getComments(): array
    {
        return PlaceholderComment::get()->toArray();
    }
}
