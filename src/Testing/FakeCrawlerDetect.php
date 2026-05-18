<?php

namespace Riverskies\Laravel\MobileDetect\Testing;

use Jaybizzle\CrawlerDetect\CrawlerDetect;

class FakeCrawlerDetect extends CrawlerDetect
{
    public bool $fakeCrawler = false;

    public function isCrawler($userAgent = null)
    {
        return $this->fakeCrawler;
    }
}
