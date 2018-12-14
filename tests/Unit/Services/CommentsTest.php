<?php

namespace Osnova\Tests\Unit\Services;

use Osnova\Services\Comments\Comment;
use Osnova\Services\Entries\Author;
use Osnova\Tests\TestCase;

class CommentsTest extends TestCase
{
    public function createComment()
    {
        $filePath = realpath(__DIR__.'/../../Fixtures/comment-example.json');

        return new Comment(
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
        $comment = $this->createComment();

        $actualValue = call_user_func([$comment, $getter]);
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
        $comment = $this->createComment();

        $entity = call_user_func([$comment, $getter]);
        $this->assertInstanceOf($expectedClass, $entity);

        foreach ($methods as $method => $expectedValue) {
            $this->assertSame($expectedValue, call_user_func([$entity, $method]));
        }
    }

    public function basicGettersDataProvider()
    {
        return [
            [
                'getter' => 'getId',
                'expectedValue' => 1999887,
            ],
            [
                'getter' => 'getText',
                'expectedValue' => 'Прилетело?',
            ],
            [
                'getter' => 'getSourceId',
                'expectedValue' => 0,
            ],
            [
                'getter' => 'getLevel',
                'expectedValue' => 1,
            ],
            [
                'getter' => 'getParentCommentId',
                'expectedValue' => 2,
            ],
            [
                'getter' => 'isPinned',
                'expectedValue' => true,
            ],
            [
                'getter' => 'isFavorited',
                'expectedValue' => false,
            ],
            [
                'getter' => 'isEdited',
                'expectedValue' => true,
            ],
            [
                'getter' => 'isLiked',
                'expectedValue' => false,
            ],
            [
                'getter' => 'getLikesCount',
                'expectedValue' => 41,
            ],
            [
                'getter' => 'getLikesSum',
                'expectedValue' => 41,
            ],
        ];
    }

    public function entityGettersDataProvider()
    {
        return [
            [
                'getter' => 'getAuthor',
                'expectedClass' => Author::class,
                'methods' => [
                    'getId' => 127880,
                    'getName' => 'Жиденький',
                    'getAvatarUrl' => 'https://leonardo.osnova.io/9edc0a87-d94a-e8b6-1362-59c7a98f6c45/',
                ],
            ],
            [
                'getter' => 'getDate',
                'expectedClass' => \DateTimeImmutable::class,
                'methods' => [
                    'getTimestamp' => 1543834160,
                ],
            ],
        ];
    }
}
