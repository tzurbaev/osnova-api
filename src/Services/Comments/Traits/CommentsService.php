<?php

namespace Osnova\Services\Comments\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Comments\Comments;
use Osnova\Services\Comments\Interfaces\HasCommentsListInterface;
use Osnova\Services\ServiceRequest;

trait CommentsService
{
    /** @var Comments|null */
    private $comments;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the comments service instance.
     *
     * @return Comments
     */
    public function getCommentsService()
    {
        if (is_null($this->comments)) {
            return $this->comments = new Comments($this->getApiProvider());
        }

        return $this->comments;
    }

    /**
     * Get comments list for the given commentable entity.
     * This is a proxy method for the Comments::getComments().
     *
     * @param HasCommentsListInterface $entity
     * @param ServiceRequest           $request = null
     *
     * @see Comments::getComments()
     *
     * @return array|\Osnova\Services\Comments\Comment[]
     */
    public function getComments(HasCommentsListInterface $entity, ServiceRequest $request = null)
    {
        return $this->getCommentsService()->getComments(
            $entity,
            $request ?? new ServiceRequest(),
            $this
        );
    }
}
