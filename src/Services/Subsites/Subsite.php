<?php

namespace Osnova\Services\Subsites;

use Osnova\Services\ServiceEntity;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;

class Subsite extends ServiceEntity implements TimelineOwnerInterface
{
    /**
     * Get subsite ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * Get subsite URL.
     *
     * @return string|null
     */
    public function getUrl()
    {
        return $this->getData('url');
    }

    /**
     * Get subsite type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->getData('type');
    }

    /**
     * Get subsite name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * Get subsite description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData('description');
    }

    /**
     * Get subsite avatar URL.
     *
     * @return string|null
     */
    public function getAvatarUrl()
    {
        return $this->getData('avatar_url');
    }

    /**
     * Get subsite head cover.
     *
     * @return mixed
     */
    public function getHeadCover()
    {
        return $this->getData('head_cover');
    }

    /**
     * Get subsite karma.
     *
     * @return int|null
     */
    public function getKarma()
    {
        return $this->getData('karma');
    }

    /**
     * Get subsite subscribers count.
     *
     * @return int
     */
    public function getSubscribersCount()
    {
        return intval($this->getData('subscribers_count'));
    }

    /**
     * Get subsite comments count.
     *
     * @return int
     */
    public function getCommentsCount()
    {
        return intval($this->getData('comments_count'));
    }

    /**
     * Get subsite entries count.
     *
     * @return int
     */
    public function getEntriesCount()
    {
        return intval($this->getData('entries_count'));
    }

    /**
     * Get subsite vacancies count.
     *
     * @return int
     */
    public function getVacanciesCount()
    {
        return intval($this->getData('vacancies_count'));
    }

    /**
     * Determines whether the subsite is muted.
     *
     * @return bool
     */
    public function isMuted()
    {
        return $this->getData('is_muted') === true;
    }

    /**
     * Determines whether the user is subscribed to the subsite.
     *
     * @return bool
     */
    public function isSubscribed()
    {
        return $this->getData('is_subscribed') === true;
    }

    /**
     * Determines whether the user can unsubscribe from the current subsite.
     *
     * @return bool
     */
    public function canUnsubscribe()
    {
        return $this->getData('is_unsubscribable') === true;
    }

    /**
     * Determines whether the subsite is verified.
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->getData('is_verified') === true;
    }

    /**
     * Determines whether users can write posts in current subsite.
     *
     * @return bool
     */
    public function isWritingEnabled()
    {
        return $this->getData('is_enable_writing') === true;
    }

    /**
     * Get the timeline URL prefix.
     *
     * @return string
     */
    public function getTimelineUrlPrefix()
    {
        return 'subsite/'.$this->getId().'/timeline';
    }
}
