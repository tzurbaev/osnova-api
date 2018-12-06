<?php

namespace Osnova\Tests;

use GuzzleHttp\Client;
use Mockery\MockInterface;
use Osnova\Api\ApiProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function tearDown()
    {
        parent::tearDown();

        if ($container = \Mockery::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }
    }

    public function apiProviderMock(callable $callback = null)
    {
        return $this->applyMockCallbackIfRequired(\Mockery::mock(ApiProvider::class), $callback);
    }

    public function httpMock(callable $callback = null)
    {
        return $this->applyMockCallbackIfRequired(\Mockery::mock(Client::class), $callback);
    }

    public function applyMockCallbackIfRequired($mock, callable $callback = null)
    {
        if (is_callable($callback)) {
            call_user_func($callback, $mock);
        }

        return $mock;
    }
}
