<?php

namespace Osnova\Services\Likes;

use GuzzleHttp\Exception\RequestException;
use Osnova\Services\AbstractService;
use Osnova\Services\Likes\Interfaces\ProvidesLikersListInterface;

class Likes extends AbstractService
{
    /**
     * Get likers list for the given entity.
     *
     * @param ProvidesLikersListInterface $entity
     *
     * @return array|Liker[]
     */
    public function getLikers(ProvidesLikersListInterface $entity)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $entity->getLikersListUrl());

            return $this->getEntitiesBuilder(Liker::class)
                ->fromResponse($response)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
