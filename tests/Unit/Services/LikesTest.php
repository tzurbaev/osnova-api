<?php

namespace Osnova\Tests\Unit\Services;

use Mockery\MockInterface;
use Osnova\Services\Comments\Comment;
use Osnova\Services\Likes\Liker;
use Osnova\Tests\Fakes\FakeResponse;
use Osnova\Tests\TestCase;
use Osnova\TJournal;

class LikesTest extends TestCase
{
    public function testItShouldLoadLikersList()
    {
        $comment = new Comment(['id' => 12345]);

        $args = ['GET', 'comment/likers/'.$comment->getId()];
        $mock = $this->apiProviderMock(function (MockInterface $mock) use ($args) {
            $httpMock = $this->httpMock(function (MockInterface $http) use ($args) {
                $http->shouldReceive('request')->with(...$args)->andReturn(
                    FakeResponse::makeJson(
                        file_get_contents(realpath(__DIR__.'/../../Fixtures/comment-likers-example.json'))
                    )
                );
            });

            $mock->shouldReceive('getClient')->andReturn($httpMock);
        });

        $tjournal = new TJournal($mock);
        $likers = $tjournal->getLikersList($comment);
        $this->assertInternalType('array', $likers);
        $this->assertSame(41, count($likers));

        foreach ($likers as $liker) {
            $this->assertInstanceOf(Liker::class, $liker);
        }
    }

    /**
     * @param string $getter
     * @param $expectedValue
     * @dataProvider likerBasicGettersDataProvider
     */
    public function testLikerShouldProvideBasicGetters(string $getter, $expectedValue)
    {
        $likers = json_decode(
            file_get_contents(realpath(__DIR__.'/../../Fixtures/comment-likers-example.json')),
            true
        );

        $liker = new Liker($likers['result'][array_keys($likers['result'])[0]]);

        $actualValue = call_user_func([$liker, $getter]);
        $this->assertSame($expectedValue, $actualValue);
    }

    public function likerBasicGettersDataProvider()
    {
        return [
            [
                'getter' => 'getName',
                'expectedValue' => 'Александр Евсюков',
            ],
            [
                'getter' => 'getAvatarUrl',
                'expectedValue' => 'https://leonardo.osnova.io/b3e47ef5-eb7d-a8d2-6b80-3db31600bf59/',
            ],
            [
                'getter' => 'getSign',
                'expectedValue' => 1,
            ],
            [
                'getter' => 'isLiked',
                'expectedValue' => true,
            ],
            [
                'getter' => 'isDisliked',
                'expectedValue' => false,
            ],
        ];
    }
}
