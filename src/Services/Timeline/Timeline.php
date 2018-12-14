<?php

namespace Osnova\Services\Timeline;

use GuzzleHttp\Exception\RequestException;
use Osnova\Api\OsnovaResource;
use Osnova\Services\AbstractService;
use Osnova\Services\Entries\Entry;
use Osnova\Services\Timeline\Enums\TimelineSearchOrder;
use Osnova\Services\Timeline\Interfaces\ModifiesTimelineRequestInterface;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Owners\NewsTimeline;
use Osnova\Services\Timeline\Owners\TimelineSearch;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\Services\Timeline\Requests\TimelineSearchRequest;

class Timeline extends AbstractService
{
    /**
     * Get timeline entries list.
     *
     * @param TimelineOwnerInterface $owner    Timeline owner.
     * @param TimelineRequest        $request  Timeline request parameters.
     * @param OsnovaResource         $resource = null Osnova resource instance that will be bound to entries.
     *
     * @return array|Entry[]
     */
    public function getTimeline(TimelineOwnerInterface $owner, TimelineRequest $request, OsnovaResource $resource = null)
    {
        try {
            $resolvedRequest = $this->resolveRequest($owner, $request);
            $response = $this->getApiProvider()->getClient()->request(
                'GET',
                $this->getTimelineUrl($owner, $resolvedRequest),
                ['query' => $resolvedRequest->getParams()]
            );

            return $this->getEntitiesBuilder(Entry::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $resource)
                ->collection();
        } catch (RequestException $e) {
            //
        }

        return [];
    }

    /**
     * Get news timeline.
     *
     * @param TimelineRequest $request  Timeline request parameters.
     * @param OsnovaResource  $resource = null Osnova resource instance that will be bound to entries.
     *
     * @return array|Entry[]
     */
    public function getNewsTimeline(TimelineRequest $request, OsnovaResource $resource = null)
    {
        return $this->getTimeline(new NewsTimeline(), $request, $resource);
    }

    /**
     * Get timeline search results.
     *
     * @param string         $query    Query string.
     * @param string         $orderBy  Ordering method (`relevant` or `date`).
     * @param int            $page     = 1 Results page.
     * @param OsnovaResource $resource = null Osnova resource instance that will be bound to entries.
     *
     * @return array|Entry[]
     */
    public function getTimelineSearchResults(
        string $query,
        string $orderBy = TimelineSearchOrder::RELEVANT,
        int $page = 1,
        OsnovaResource $resource = null
    ) {
        return $this->getTimeline(
            new TimelineSearch($query),
            new TimelineSearchRequest($orderBy, $page),
            $resource
        );
    }

    /**
     * Get timeline entry by ID.
     *
     * @param int            $id       Entry ID.
     * @param OsnovaResource $resource = null Osnova resource that will be bound to entry.
     *
     * @return Entry|null
     */
    public function getTimelineEntry($id, OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'entries/'.$id);

            return $this->getEntitiesBuilder(Entry::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $resource)
                ->item();
        } catch (RequestException $e) {
            //
        }

        return null;
    }

    /**
     * Get pinned timeline entry.
     *
     * @param OsnovaResource $resource = null Osnova resource that will be bound to entry.
     *
     * @return Entry|null
     */
    public function getPinnedEntry(OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', 'getflashholdedentry');

            return $this->getEntitiesBuilder(Entry::class)
                ->fromResponse($response)
                ->with($this->getApiProvider(), $resource)
                ->item();
        } catch (RequestException $e) {
            //
        }

        return null;
    }

    /**
     * Get the popular entries list for the given entry.
     *
     * @param Entry          $entry
     * @param OsnovaResource $resource = null
     *
     * @return array|Entry[]
     */
    public function getPopularEntries(Entry $entry, OsnovaResource $resource = null)
    {
        try {
            $response = $this->getApiProvider()->getClient()->request('GET', $entry->getPopularEntriesUrl());

            return $this->getEntitiesBuilder(Entry::class)
                ->fromResponse($response)
                ->with($this->apiProvider, $resource)
                ->collection();
        } catch (RequestException $e) {
            //
        }
    }

    /**
     * Resolve correct timeline request to be used in API request.
     *
     * @param TimelineOwnerInterface|ModifiesTimelineRequestInterface $owner
     * @param TimelineRequest                                         $request
     *
     * @return TimelineRequest
     */
    protected function resolveRequest(TimelineOwnerInterface $owner, TimelineRequest $request)
    {
        if (!($owner instanceof ModifiesTimelineRequestInterface)) {
            return $request;
        }

        $modified = $owner->modifyTimelineRequest($request);

        return $modified instanceof TimelineRequest ? $modified : $request;
    }

    /**
     * Build timeline URL for the given owner & request.
     *
     * @param TimelineOwnerInterface $owner   Timeline owner.
     * @param TimelineRequest        $request Timeline request parameters.
     *
     * @return string
     */
    public function getTimelineUrl(TimelineOwnerInterface $owner, TimelineRequest $request)
    {
        $prefix = trim($owner->getTimelineUrlPrefix(), '/');

        if (!$request->hasSorting()) {
            return $prefix;
        }

        return $prefix.'/'.trim($request->getSorting(), '/');
    }
}
