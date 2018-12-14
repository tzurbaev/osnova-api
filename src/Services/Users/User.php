<?php

namespace Osnova\Services\Users;

use Osnova\Services\Comments\Interfaces\HasCommentsListInterface;
use Osnova\Services\ServiceRequest;
use Osnova\Services\Timeline\Interfaces\ModifiesTimelineRequestInterface;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Requests\TimelineRequest;

class User extends AbstractUser implements TimelineOwnerInterface, ModifiesTimelineRequestInterface, HasCommentsListInterface
{
    /**
     * Get user hash
     *
     * @return string|null
     */
    public function getHash()
    {
        return $this->getData('user_hash');
    }

    /**
     * Get entries count.
     *
     * @return int
     */
    public function getEntriesCount()
    {
        return intval($this->getData('counters.entries'));
    }

    /**
     * Get comments count.
     *
     * @return int
     */
    public function getCommentsCount()
    {
        return intval($this->getData('counters.comments'));
    }

    /**
     * Get favorites count.
     *
     * @return int
     */
    public function getFavoritesCount()
    {
        return intval($this->getData('counters.favorites'));
    }

    /**
     * Get internal API URL.
     *
     * @param string $path = ''
     *
     * @return string
     */
    protected function apiUrl(string $path = '')
    {
        return 'users/'.$this->getId().($path ? '/'.ltrim($path) : '');
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return $this->apiUrl('entries');
    }

    /**
     * Modify given timeline request.
     *
     * @param TimelineRequest $request
     *
     * @return TimelineRequest
     */
    public function modifyTimelineRequest($request)
    {
        return $request->withoutSorting();
    }

    /**
     * Get the comments URL prefix.
     *
     * @param ServiceRequest $request
     *
     * @return string
     */
    public function getCommentsUrl($request)
    {
        return $this->apiUrl('comments');
    }
}
