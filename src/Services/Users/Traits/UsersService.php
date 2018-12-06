<?php

namespace Osnova\Services\Users\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Users\User;
use Osnova\Services\Users\Users;

trait UsersService
{
    /** @var Users|null */
    private $users;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the users service instance.
     *
     * @param bool $reload = false Reload instance flag.
     *
     * @return Users
     */
    public function getUsersService(bool $reload = false)
    {
        if (is_null($this->users) || $reload) {
            return $this->users = new Users($this->getApiProvider());
        }

        return $this->users;
    }

    /**
     * Get user by the given ID.
     * This is a proxy method for Users::getUser().
     *
     * @param integer $id User ID.
     *
     * @see Users::getUser()
     *
     * @return User|null
     */
    public function getUser($id)
    {
        return $this->getUsersService()->getUser($id, $this);
    }
}
