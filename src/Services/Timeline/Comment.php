<?php

namespace Osnova\Services\Timeline;

use GuzzleHttp\Exception\RequestException;
use Osnova\Enums\MediaType;
use Osnova\Services\Media\Image;
use Osnova\Services\Media\Video;
use Osnova\Services\ServiceEntity;
use Osnova\Services\Timeline\Traits\HasLikes;

class Comment extends ServiceEntity
{
    use HasLikes;

    /**
     * Get comment ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get comment author.
     *
     * @return Author|null
     */
    public function getAuthor()
    {
        return $this->makeEntity(Author::class, 'author');
    }

    /**
     * Get comment's publication date.
     *
     * @return \DateTimeImmutable
     */
    public function getDate()
    {
        return new \DateTimeImmutable($this->getData('date'), 'Europe/Moscow');
    }

    /**
     * Get comment text.
     *
     * @return string|null
     */
    public function getText()
    {
        return $this->getData('text') ?? '';
    }

    /**
     * Get comment media list.
     *
     * @return array
     */
    public function getMedia()
    {
        $media = $this->getData('media', []);

        if (!is_array($media) || empty($media)) {
            return [];
        }

        $entities = array_map(function (array $item) {
            switch ($item['type'] ?? 0) {
                case MediaType::IMAGE:
                    return $this->makeEntityFrom(Image::class, $item);
                case MediaType::VIDEO:
                    return $this->makeEntityFrom(Video::class, $item);
                default:
                    return null;
            }
        }, $media);

        return array_filter($entities);
    }

    /**
     * Get comment source ID.
     *
     * @return int|null
     */
    public function getSourceId()
    {
        return $this->getData('source_id');
    }

    /**
     * Get comment's depth level.
     *
     * @return int|null
     */
    public function getLevel()
    {
        return $this->getData('level');
    }

    /**
     * Get comment's parent comment ID.
     *
     * @return int|null
     */
    public function getParentCommentId()
    {
        return $this->getData('replyTo');
    }

    /**
     * Determines whether the comment is pinned.
     *
     * @return bool
     */
    public function isPinned()
    {
        return $this->getData('isPinned') === true;
    }

    /**
     * Determines whether the comment was favorited by the current user.
     *
     * @return bool
     */
    public function isFavorited()
    {
        return $this->getData('isFavorited') === true;
    }

    /**
     * Determnes whether the comment was edited.
     *
     * @return bool
     */
    public function isEdited()
    {
        return $this->getData('isEdited') === true;
    }

    /**
     * Get comment likers list.
     *
     * @return array|Liker[]
     */
    public function getLikers()
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'comment/likers/'.$this->getId());

            return $this->getEntitiesBuilder(Liker::class)
                ->fromResponse($response)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }
}
