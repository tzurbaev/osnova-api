<?php

namespace Osnova\Services\Users;

use GuzzleHttp\Exception\RequestException;
use Osnova\Services\ServiceEntity;
use Osnova\Services\ServiceRequest;
use Osnova\Services\Timeline\Comment;
use Osnova\Services\Timeline\Entry;

class User extends ServiceEntity
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
     * Get user hash
     *
     * @return string|null
     */
    public function getHash()
    {
        return $this->getData('user_hash');
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
     * Get avatar URL.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->getData('avatar_url');
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
     * Get karma value.
     *
     * @return int|null
     */
    public function getKarma()
    {
        return $this->getData('karma');
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
     * Get registration date.
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAtDate()
    {
        return new \DateTimeImmutable($this->getData('created'), 'Europe/Moscow');
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
     * Get user's entries list.
     *
     * @param ServiceRequest $request
     *
     * @return array|Entry[]
     */
    public function getEntries(ServiceRequest $request)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $this->apiUrl('entries'), [
                'query' => $request->getParams(),
            ]);

            return $this->getEntitiesBuilder(Entry::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $this->getOsnovaResource())
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }

    /**
     * Get user's comments list.
     *
     * @param ServiceRequest $request
     *
     * @return array|Comment[]
     */
    public function getComments(ServiceRequest $request)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $this->apiUrl('comments'), [
                'query' => $request->getParams(),
            ]);

            return $this->getEntitiesBuilder(Comment::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $this->getOsnovaResource())
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
