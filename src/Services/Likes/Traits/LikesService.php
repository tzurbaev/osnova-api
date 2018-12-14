<?php

namespace Osnova\Services\Likes\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Likes\Interfaces\ProvidesLikersListInterface;
use Osnova\Services\Likes\Likes;

trait LikesService
{
    /** @var Likes|null */
    private $likes;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the likes service instance.
     *
     * @return Likes
     */
    public function getLikesService()
    {
        if (is_null($this->likes)) {
            return $this->likes = new Likes($this->getApiProvider());
        }

        return $this->likes;
    }

    /**
     * Get likers list for the given entity.
     * This is a proxy method for Likes::getLikers().
     *
     * @param ProvidesLikersListInterface $entity
     *
     * @see Likes::getLikers()
     *
     * @return array|\Osnova\Services\Likes\Liker[]
     */
    public function getLikersList(ProvidesLikersListInterface $entity)
    {
        return $this->getLikesService()->getLikers($entity);
    }
}
