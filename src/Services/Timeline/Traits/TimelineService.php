<?php

namespace Osnova\Services\Timeline\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Entries\Entry;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\Services\Timeline\Timeline;

trait TimelineService
{
    /** @var Timeline|null */
    private $timeline;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the timeline service instance.
     *
     * @return Timeline
     */
    public function getTimelineService()
    {
        if (is_null($this->timeline)) {
            return $this->timeline = new Timeline($this->getApiProvider());
        }

        return $this->timeline;
    }

    /**
     * Get timeline entries list.
     * This is a proxy method for Timeline::getTimeline().
     *
     * @param TimelineOwnerInterface $owner   Timeline owner.
     * @param TimelineRequest        $request = null Timeline request parameters.
     *
     * @see Timeline::getTimeline()
     *
     * @return array|Entry[]
     */
    public function getTimelineEntries(TimelineOwnerInterface $owner, TimelineRequest $request = null)
    {
        return $this->getTimelineService()->getTimeline(
            $owner,
            $request ?? new TimelineRequest(),
            $this
        );
    }

    /**
     * Get news timeline.
     * This is a proxy method for Timeline::getNewsTimeline().
     *
     * @param TimelineRequest $request = null Timeline request parameters.
     *
     * @see Timeline::getNewsTimeline()
     *
     * @return array|Entry[]
     */
    public function getNewsTimeline(TimelineRequest $request = null)
    {
        return $this->getTimelineService()->getNewsTimeline($request, $this);
    }

    /**
     * Get timeline search results.
     * This is a proxy method for Timeline::getTimelineSearchResults().
     *
     * @param string $query   Query string.
     * @param string $orderBy Ordering method (`relevant` or `date`).
     * @param int    $page    = 1 Results page.
     *
     * @see Timeline::getTimelineSearchResults()
     *
     * @return array|Entry[]
     */
    public function getTimelineSearchResults(string $query, string $orderBy = 'relevant', int $page = 1)
    {
        return $this->getTimelineService()->getTimelineSearchResults($query, $orderBy, $page, $this);
    }

    /**
     * Get timeline entry by ID.
     * This is a proxy method for Timeline::getTimelineEntry().
     *
     * @param int $id Entry ID.
     *
     * @see Timeline::getTimeline()
     *
     * @return Entry|null
     */
    public function getTimelineEntry($id)
    {
        return $this->getTimelineService()->getTimelineEntry($id, $this);
    }

    /**
     * Get pinned timeline entry.
     * This is a proxy method for Timeline::getPinnedEntry().
     *
     * @see Timeline::getPinnedEntry()
     *
     * @return Entry|null
     */
    public function getPinnedEntry()
    {
        return $this->getTimelineService()->getPinnedEntry($this);
    }

    /**
     * Get the popular entries list for the given entry.
     * This is a proxy method for Timeline::getPopularEntries().
     *
     * @param Entry $entry
     *
     * @see Timeline::getPopularEntries()
     *
     * @return array|Entry[]
     */
    public function getPopularEntries(Entry $entry)
    {
        return $this->getTimelineService()->getPopularEntries($entry, $this);
    }
}
