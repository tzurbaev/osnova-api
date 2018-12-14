<?php

namespace Osnova\Tests\Unit\Services;

use Mockery\MockInterface;
use Osnova\Services\Comments\Enums\CommentsSorting;
use Osnova\Services\Comments\Requests\CommentsRequest;
use Osnova\Services\Entries\Author;
use Osnova\Services\Entries\Entry;
use Osnova\Services\Entries\EntryContent;
use Osnova\Services\Subsites\Subsite;
use Osnova\Services\Comments\Comment;
use Osnova\Tests\Fakes\FakeResponse;
use Osnova\Tests\TestCase;
use Osnova\TJournal;

class EntriesTest extends TestCase
{
    public function createEntry()
    {
        $filePath = realpath(__DIR__.'/../../Fixtures/entry-example.json');

        return new Entry(
            json_decode(file_get_contents($filePath), true)['result']
        );
    }

    /**
     * @param string $getter
     * @param $expectedValue
     * @dataProvider basicGettersDataProvider
     */
    public function testItShouldProvideBasicGetters(string $getter, $expectedValue)
    {
        $entry = $this->createEntry();

        $actualValue = call_user_func([$entry, $getter]);
        $this->assertSame($expectedValue, $actualValue);
    }

    /**
     * @param string $getter
     * @param string $expectedClass
     * @param array $methods
     * @dataProvider entityGettersDataProvider
     */
    public function testItShouldProvideEntityGetters(string $getter, string $expectedClass, array $methods)
    {
        $entry = $this->createEntry();

        $entity = call_user_func([$entry, $getter]);
        $this->assertInstanceOf($expectedClass, $entity);

        foreach ($methods as $method => $expectedValue) {
            $this->assertSame($expectedValue, call_user_func([$entity, $method]));
        }
    }

    public function testItShouldLoadPopularEntriesFromApi()
    {
        $mock = $this->apiProviderMock(function (MockInterface $mock) {
            $httpMock = $this->httpMock(function (MockInterface $http) {
                $entries = file_get_contents(
                    realpath(__DIR__.'/../../Fixtures/entry-popular-entries-example.json')
                );

                $http->shouldReceive('request')->with('GET', 'entries/81129/popular')->andReturn(
                    FakeResponse::makeJson($entries)
                );
            });

            $mock->shouldReceive('getClient')->andReturn($httpMock);
        });

        $tjournal = new TJournal($mock);
        $entry = $this->createEntry();

        $entries = $tjournal->getPopularEntries($entry);
        $this->assertInternalType('array', $entries);
        $this->assertSame(12, count($entries));

        foreach ($entries as $popularEntry) {
            $this->assertInstanceOf(Entry::class, $popularEntry);
        }
    }

    public function testItShouldLoadCommentsFromApi()
    {
        $mock = $this->apiProviderMock(function (MockInterface $mock) {
            $httpMock = $this->httpMock(function (MockInterface $http) {
                $comments = file_get_contents(
                    realpath(__DIR__.'/../../Fixtures/entry-comments-example.json')
                );

                $args = [
                    'GET',
                    'entries/81129/comments/popular',
                    ['query' => ['count' => 20, 'offset' => 0]],
                ];

                $http->shouldReceive('request')->with(...$args)->andReturn(
                    FakeResponse::makeJson($comments)
                );
            });

            $mock->shouldReceive('getClient')->andReturn($httpMock);
        });

        $tjournal = new TJournal($mock);
        $entry = $this->createEntry();

        $comments = $tjournal->getComments($entry, new CommentsRequest(CommentsSorting::POPULAR));
        $this->assertInternalType('array', $comments);
        $this->assertSame(30, count($comments));

        foreach ($comments as $comment) {
            $this->assertInstanceOf(Comment::class, $comment);
        }
    }

    public function basicGettersDataProvider()
    {
        return [
            [
                'getter' => 'getId',
                'expectedValue' => 81129,
            ],
            [
                'getter' => 'getCommentsCount',
                'expectedValue' => 30,
            ],
            [
                'getter' => 'getFavoritesCount',
                'expectedValue' => 3,
            ],
            [
                'getter' => 'getCover',
                'expectedValue' => null,
            ],
            [
                'getter' => 'getHitsCount',
                'expectedValue' => 4638,
            ],
            [
                'getter' => 'getIntro',
                'expectedValue' => 'Когда закон только внесли в Госдуму, Татьяна Москалькова поддержала его и назвала «правильным».',
            ],
            [
                'getter' => 'commentsEnabled',
                'expectedValue' => true,
            ],
            [
                'getter' => 'likesEnabled',
                'expectedValue' => true,
            ],
            [
                'getter' => 'isFavorited',
                'expectedValue' => false,
            ],
            [
                'getter' => 'getLikesCount',
                'expectedValue' => 51,
            ],
            [
                'getter' => 'getLikesSum',
                'expectedValue' => 51,
            ],
            [
                'getter' => 'getTitle',
                'expectedValue' => 'Уполномоченный по правам человека назвала ошибкой декриминализацию побоев',
            ],
            [
                'getter' => 'isEditorial',
                'expectedValue' => true,
            ],
            [
                'getter' => 'isPinned',
                'expectedValue' => false,
            ],
            [
                'getter' => 'getAudioUrl',
                'expectedValue' => 'https://leonardo.osnova.io/audio/c2533dde-8a62-d66d-24ad-35e50b7e6e99/bdc66fbe1186e6cb5be955237a92b7fc.mp3',
            ]
        ];
    }

    public function entityGettersDataProvider()
    {
        return [
            [
                'getter' => 'getAuthor',
                'class' => Author::class,
                'methods' => [
                    'getId' => 127966,
                    'getName' => 'Mayya Gavasheli',
                    'getAvatarUrl' => 'https://leonardo.osnova.io/6a64f864-fd02-854f-9dc9-05259b0cce1c/',
                ],
            ],
            [
                'getter' => 'getSubsite',
                'class' => Subsite::class,
                'methods' => [
                    'getId' => 214352,
                    'getUrl' => 'https://tjournal.ru/law',
                    'getType' => 2,
                    'getName' => 'Право',
                    'getDescription' => 'Законопроекты, судебные заседания, новые правила и нормы, правозащита. Всё, что не связано с политикой.',
                    'getAvatarUrl' => 'https://leonardo.osnova.io/104cded3-1652-64be-bf52-9b781bae9baa/',
                    'getHeadCover' => null,
                ],
            ],
            [
                'getter' => 'getContent',
                'class' => EntryContent::class,
                'methods' => [
                    'getVersion' => '1680761577.99',
                ],
            ],
            [
                'getter' => 'getDate',
                'expectedClass' => \DateTimeImmutable::class,
                'methods' => [
                    'getTimestamp' => 1543833902,
                ],
            ],
        ];
    }
}
