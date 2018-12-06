<?php

namespace Osnova\Services\Tweets;

use Osnova\Services\Media\TweetMedia;
use Osnova\Services\ServiceEntity;

class Tweet extends ServiceEntity
{
    /**
     * Get tweet ID.
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get tweet author.
     *
     * @return TweetUser|null
     */
    public function getAuthor()
    {
        return $this->makeEntity(TweetUser::class, 'user');
    }

    /**
     * Get publication date.
     *
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return new \DateTimeImmutable($this->getData('created'), 'Europe/Moscow');
    }

    /**
     * Determines whether the tweet has media list.
     *
     * @return bool
     */
    public function hasMedia()
    {
        return $this->getData('has_media') === true;
    }

    /**
     * Get media list.
     *
     * @return array|TweetMedia[]
     */
    public function getMedia()
    {
        $media = $this->getData('media', []);

        if (!is_array($media) || empty($media)) {
            return [];
        }

        return array_map(function (array $item) {
            return $this->makeEntityFrom(TweetMedia::class, $item);
        }, $media);
    }

    /**
     * Get tweet text.
     *
     * @return string|null
     */
    public function getText()
    {
        return $this->getData('text') ?? '';
    }

    /**
     * Get retweets count.
     *
     * @return int
     */
    public function getRetweetsCount()
    {
        return intval($this->getData('retweet_count'));
    }

    /**
     * Get favorites count.
     *
     * @return int
     */
    public function getFavoritesCount()
    {
        return intval($this->getData('favorite_count'));
    }
}
