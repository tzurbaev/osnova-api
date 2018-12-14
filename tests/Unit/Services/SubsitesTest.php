<?php

namespace Osnova\Tests\Unit\Services;

use Mockery\MockInterface;
use Osnova\Services\Subsites\Subsite;
use Osnova\Tests\Fakes\FakeResponse;
use Osnova\Tests\TestCase;
use Osnova\TJournal;

class SubsitesTest extends TestCase
{
    public function createSubsite()
    {
        $filePath = realpath(__DIR__.'/../../Fixtures/subsite-example.json');

        return new Subsite(
            json_decode(file_get_contents($filePath), true)
        );
    }

    /**
     * @param string $getter
     * @param $expectedValue
     * @dataProvider basicGettersDataProvider
     */
    public function testItShouldProvideBasicGetters(string $getter, $expectedValue)
    {
        $subsite = $this->createSubsite();

        $actualValue = call_user_func([$subsite, $getter]);
        $this->assertSame($expectedValue, $actualValue);
    }

    public function testItShouldLoadSubsiteById()
    {
        $mock = $this->apiProviderMock(function (MockInterface $mock) {
            $httpMock = $this->httpMock(function (MockInterface $http) {
                $http->shouldReceive('request')->with('GET', 'subsite/214352')->andReturn(
                    FakeResponse::makeJson([
                        'message' => '',
                        'result' => json_decode(
                            file_get_contents(realpath(__DIR__.'/../../Fixtures/subsite-example.json')),
                            true
                        )
                    ])
                );
            });

            $mock->shouldReceive('getClient')->andReturn($httpMock);
        });

        $tjournal = new TJournal($mock);
        $subsite = $tjournal->getSubsite(214352);
        $this->assertInstanceOf(Subsite::class, $subsite);
        $this->assertSame(214352, $subsite->getId());
    }

    public function basicGettersDataProvider()
    {
        return [
            [
                'getter' => 'getId',
                'expectedValue' => 214352,
            ],
            [
                'getter' => 'getUrl',
                'expectedValue' => 'https://tjournal.ru/law',
            ],
            [
                'getter' => 'getType',
                'expectedValue' => 2,
            ],
            [
                'getter' => 'getName',
                'expectedValue' => 'Право',
            ],
            [
                'getter' => 'getDescription',
                'expectedValue' => 'Законопроекты, судебные заседания, новые правила и нормы, правозащита. Всё, что не связано с политикой.',
            ],
            [
                'getter' => 'getAvatarUrl',
                'expectedValue' => 'https://leonardo.osnova.io/104cded3-1652-64be-bf52-9b781bae9baa/',
            ],
            [
                'getter' => 'getKarma',
                'expectedValue' => 0,
            ],
            [
                'getter' => 'getSubscribersCount',
                'expectedValue' => 217371,
            ],
            [
                'getter' => 'getCommentsCount',
                'expectedValue' => 0,
            ],
            [
                'getter' => 'getEntriesCount',
                'expectedValue' => 449,
            ],
            [
                'getter' => 'getVacanciesCount',
                'expectedValue' => 0,
            ],
            [
                'getter' => 'isMuted',
                'expectedValue' => false,
            ],
            [
                'getter' => 'isSubscribed',
                'expectedValue' => false,
            ],
            [
                'getter' => 'isVerified',
                'expectedValue' => false,
            ],
            [
                'getter' => 'isWritingEnabled',
                'expectedValue' => false,
            ],
            [
                'getter' => 'canUnsubscribe',
                'expectedValue' => true,
            ],
        ];
    }
}
