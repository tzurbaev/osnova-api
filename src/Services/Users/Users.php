<?php

namespace Osnova\Services\Users;

use GuzzleHttp\Exception\RequestException;
use Osnova\OsnovaResource;
use Osnova\Services\AbstractService;

class Users extends AbstractService
{
    /**
     * Get user by the given ID.
     *
     * @param integer        $id       User ID.
     * @param OsnovaResource $resource = null Osnova resource that will be bound to entry.
     *
     * @return User|null
     */
    public function getUser($id, OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'users/'.$id);

            return $this->getEntitiesBuilder(User::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $resource)
                ->item();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
