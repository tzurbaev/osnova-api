<?php

namespace Osnova\Services\Tweets\Traits;

use Osnova\Api\ApiProvider;
use Osnova\Services\Tweets\Requests\TweetsRequest;
use Osnova\Services\Tweets\Tweets;

trait TweetsService
{
    /** @var Tweets */
    private $tweets;

    /**
     * Get the resource API Provider instance.
     *
     * @return ApiProvider
     */
    abstract public function getApiProvider();

    /**
     * Get the tweets service instance.
     *
     * @return Tweets
     */
    public function getTweetsService()
    {
        if (is_null($this->tweets)) {
            return $this->tweets = new Tweets($this->getApiProvider());
        }

        return $this->tweets;
    }

    /**
     * Get tweets list.
     *
     * @param TweetsRequest $request
     *
     * @see Tweets::getTweets()
     *
     * @return array|\Osnova\Services\Tweets\Tweet[]
     */
    public function getTweets(TweetsRequest $request)
    {
        return $this->getTweetsService()->getTweets($request);
    }
}
