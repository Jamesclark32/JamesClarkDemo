<?php

namespace App\Queries\Api\V1\User;

use App\Models\PlaceholderUser;

/**
 * Class Index
 *
 * @package App\Queries\Api\V1\User
 */
class Index
{
    /**
     * @return array|array[]
     */
    public function getData(): array
    {
        return [
            'users' => $this->getUsers(),
        ];
    }

    /**
     * @return array
     */
    protected function getUsers(): array
    {
        return PlaceholderUser::get()->toArray();
    }
}
