<?php

namespace Osnova\Tests\Unit\Services;

use Mockery\MockInterface;
use Osnova\Services\Subsites\Subsite;
use Osnova\Services\Timeline\Interfaces\TimelineOwnerInterface;
use Osnova\Services\Timeline\Owners\TimelineCategory;
use Osnova\Services\Timeline\Owners\TimelineHashtag;
use Osnova\Services\Timeline\Requests\TimelineRequest;
use Osnova\Services\Timeline\Timeline;
use Osnova\Tests\Fakes\FakeResponse;
use Osnova\Tests\TestCase;

class TimelineServiceTest extends TestCase
{
    /**
     * @param string $name
     * @param string $sorting
     * @param string $expected
     * @dataProvider timelineUrlForCategoriesDataProvider
     */
    public function testItShouldGenerateTimelineUrlForCategories(string $name, string $sorting, string $expected)
    {
        $timeline = new Timeline($this->apiProviderMock());
        $owner = new TimelineCategory($name);
        $request = new TimelineRequest($sorting);

        $this->assertSame($expected, $timeline->getTimelineUrl($owner, $request));
    }

    /**
     * @param TimelineOwnerInterface $owner
     * @param TimelineRequest $request
     * @param array $args
     * @dataProvider timelineRequestsDataProvider
     */
    public function testItShouldMakeTimelineRequests(TimelineOwnerInterface $owner, TimelineRequest $request, array $args)
    {
        $mock = $this->apiProviderMock(function (MockInterface $mock) use ($args) {
            $httpMock = $this->httpMock(function (MockInterface $http) use ($args) {
                $http->shouldReceive('request')->with(...$args)->andReturn(FakeResponse::make());
            });

            $mock->shouldReceive('getClient')->andReturn($httpMock);
        });

        $timeline = new Timeline($mock);
        $response = $timeline->getTimeline($owner, $request);
        $this->assertInternalType('array', $response);
    }

    public function timelineUrlForCategoriesDataProvider()
    {
        return [
            ['name' => 'example', 'sorting' => 'recent', 'expected' => 'timeline/example/recent'],
            ['name' => 'example', 'sorting' => 'recent/', 'expected' => 'timeline/example/recent'],
            ['name' => 'example/', 'sorting' => 'recent/', 'expected' => 'timeline/example/recent'],
            ['name' => '/example/', 'sorting' => '/recent/', 'expected' => 'timeline/example/recent'],
        ];
    }

    public function timelineRequestsDataProvider()
    {
        return [
            [
                'owner' => new TimelineCategory('bugs'),
                'request' => new TimelineRequest('recent'),
                'args' => ['GET', 'timeline/bugs/recent', ['query' => ['count' => 20, 'offset' => 0]]],
            ],
            [
                'owner' => new TimelineCategory('bugs'),
                'request' => new TimelineRequest('popular'),
                'args' => ['GET', 'timeline/bugs/popular', ['query' => ['count' => 20, 'offset' => 0]]],
            ],
            [
                'owner' => new Subsite(['id' => 1]),
                'request' => new TimelineRequest('new'),
                'args' => ['GET', 'subsite/1/timeline/new', ['query' => ['count' => 20, 'offset' => 0]]],
            ],
            [
                'owner' => new Subsite(['id' => 2]),
                'request' => new TimelineRequest('top/week'),
                'args' => ['GET', 'subsite/2/timeline/top/week', ['query' => ['count' => 20, 'offset' => 0]]],
            ],
            [
                'owner' => new Subsite(['id' => 3]),
                'request' => new TimelineRequest('top/all'),
                'args' => ['GET', 'subsite/3/timeline/top/all', ['query' => ['count' => 20, 'offset' => 0]]],
            ],
            [
                'owner' => new TimelineHashtag('test'),
                'request' => new TimelineRequest(),
                'args' => ['GET', 'timeline/mainpage', ['query' => ['count' => 20, 'offset' => 0, 'hashtag' => 'test']]],
            ],
        ];
    }
}
