<?php

namespace App\Queries\Api\V1\User;

use App\Models\PlaceholderUser;

/**
 * Class Show
 *
 * @package App\Queries\Api\V1\User
 */
class Show
{
    /**
     * @var PlaceholderUser $placeholderUser
     */
    protected $placeholderUser;

    /**
     * @param PlaceholderUser $placeholderUser
     *
     * @return PlaceholderUser[]|array
     */
    public function getData(PlaceholderUser $placeholderUser): array
    {
        $this->placeholderUser = $placeholderUser;

        return [
            'user' => $this->getUser(),
        ];
    }

    /**
     * @return PlaceholderUser
     */
    protected function getUser(): PlaceholderUser
    {
        return $this->placeholderUser;
    }
}
