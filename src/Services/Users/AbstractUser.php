<?php

namespace Osnova\Services\Users;

use Osnova\Services\ServiceEntity;
use Osnova\Support\DateTimeHelper;

abstract class AbstractUser extends ServiceEntity
{
    /**
     * Get user ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get user name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * Get user URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('url');
    }

    /**
     * Get avatar URL.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->getData('avatar_url');
    }

    /**
     * Get karma value.
     *
     * @return int|null
     */
    public function getKarma()
    {
        return $this->getData('karma');
    }

    /**
     * Get registration date.
     *
     * @return \DateTimeImmutable|null
     */
    public function getCreatedAtDate()
    {
        return DateTimeHelper::createFromTimestamp($this->getData('created'));
    }

    /**
     * Get user's social accounts list.
     *
     * @return array
     */
    public function getSocialAccounts()
    {
        return [];
    }
}
