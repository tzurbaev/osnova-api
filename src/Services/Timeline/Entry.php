<?php

namespace Osnova\Services\Timeline;

use GuzzleHttp\Exception\RequestException;
use Osnova\Services\Media\CoverImage;
use Osnova\Services\ServiceEntity;
use Osnova\Services\Subsites\Subsite;
use Osnova\Services\Timeline\Traits\HasLikes;

class Entry extends ServiceEntity
{
    use HasLikes;

    /**
     * Get entry ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get entry author.
     *
     * @return Author|null
     */
    public function getAuthor()
    {
        return $this->makeEntity(Author::class, 'author');
    }

    /**
     * Get entry subsite.
     *
     * @return Subsite|null
     */
    public function getSubsite()
    {
        return $this->makeEntity(Subsite::class, 'subsite');
    }

    /**
     * Get entry title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData('title') ?? '';
    }

    /**
     * Get entry intro text.
     *
     * @return string|null
     */
    public function getIntro()
    {
        return $this->getData('intro') ?? '';
    }

    /**
     * Get "introInFeed" attribute value.
     *
     * @return string|null
     */
    public function getIntroInFeed()
    {
        return $this->getData('introInFeed') ?? '';
    }

    /**
     * Get entry's cover image.
     *
     * @return CoverImage|null
     */
    public function getCover()
    {
        return $this->makeEntity(CoverImage::class, 'cover');
    }

    /**
     * Get entry content.
     *
     * @return EntryContent|null
     */
    public function getContent()
    {
        return $this->makeEntity(EntryContent::class, 'entryContent');
    }

    /**
     * Get hits count.
     *
     * @return int
     */
    public function getHitsCount()
    {
        return intval($this->getData('hitsCount'));
    }

    /**
     * Get comments count.
     *
     * @return int
     */
    public function getCommentsCount()
    {
        return intval($this->getData('commentsCount'));
    }

    /**
     * Get favorites count.
     *
     * @return int
     */
    public function getFavoritesCount()
    {
        return intval($this->getData('favoritesCount'));
    }

    /**
     * Get badges list.
     *
     * @return array|mixed|string
     */
    public function getBadges()
    {
        return $this->getData('badges', []);
    }

    /**
     * Get publication date.
     *
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return new \DateTimeImmutable($this->getData('date', 0), 'Europe/Moscow');
    }

    /**
     * Get entry's last modification date.
     *
     * @return \DateTimeImmutable
     */
    public function getLastModificationDate()
    {
        return new \DateTimeImmutable($this->getData('last_modification_date', 0), 'Europe/Moscow');
    }

    /**
     * Determines whether the comments are enabled to current entry.
     *
     * @return bool
     */
    public function commentsEnabled()
    {
        return $this->getData('isEnabledComments', true) === true;
    }

    /**
     * Determines whether the likes are enabled to current entry.
     *
     * @return bool
     */
    public function likesEnabled()
    {
        return $this->getData('isEnabledLikes', true) === true;
    }

    /**
     * Determines whether the entry was favorited by the current user.
     *
     * @return bool
     */
    public function isFavorited()
    {
        return $this->getData('isFavorited', false) === true;
    }

    /**
     * Determines whether the entry is pinned.
     *
     * @return bool
     */
    public function isPinned()
    {
        return $this->getData('isPinned', false) === true;
    }

    /**
     * Determines whether the entry was published by resource staff.
     *
     * @return bool
     */
    public function isEditorial()
    {
        return $this->getData('isEditorial', false) === true;
    }

    /**
     * Get commentators avatars list.
     *
     * @return array|string[]
     */
    public function getCommentatorsAvatars()
    {
        return $this->getData('commentatorsAvatars', []);
    }

    /**
     * Get entry URL.
     *
     * @return string
     */
    public function getUrl()
    {
        if (!is_null($subsite = $this->getSubsite())) {
            return $subsite->getUrl().'/'.$this->getId();
        }

        return '';
    }

    /**
     * Get WebView URL.
     *
     * @return string
     */
    public function getWebviewUrl()
    {
        return $this->getData('webviewUrl') ?? '';
    }

    /**
     * Get entry's audio version URL.
     *
     * @return string
     */
    public function getAudioUrl()
    {
        return $this->getData('audioUrl') ?? '';
    }

    /**
     * Get the internal API URL.
     *
     * @param string $path = ''
     *
     * @return string
     */
    protected function apiUrl(string $path = '')
    {
        return 'entries/'.$this->getId().($path ? '/'.ltrim($path) : '');
    }

    /**
     * Get list of popular entries for the current entry.
     *
     * @return array|Entry[]
     */
    public function getPopularEntries()
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $this->apiUrl('popular'));

            return $this->getEntitiesBuilder(static::class)
                ->fromResponse($response)
                ->with($this->apiProvider, $this->resource)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }

    /**
     * Get comments list for the current entry.
     *
     * @param string $sorting
     *
     * @return array|Comment[]
     */
    public function getComments(string $sorting)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $this->apiUrl('comments/'.$sorting));

            return $this->getEntitiesBuilder(Comment::class)
                ->fromResponse($response)
                ->with($this->apiProvider, $this->resource)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
