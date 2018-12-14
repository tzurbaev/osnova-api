<?php

namespace Osnova\Services\Entries;

use Osnova\Services\Users\AbstractUser;

class Author extends AbstractUser
{
    /**
     * Get author's first name.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->getData('first_name');
    }

    /**
     * Get author's last name.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->getData('last_name');
    }
}
