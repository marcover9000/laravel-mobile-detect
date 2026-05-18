<?php

namespace Riverskies\Laravel\MobileDetect\Facades;

use Illuminate\Support\Facades\Facade;
use Riverskies\Laravel\MobileDetect\Testing\FakeCrawlerDetect;
use Riverskies\Laravel\MobileDetect\Testing\FakeMobileDetect;

class MobileDetect extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'mobile-detect';
    }

    /**
     * Swap the detector bindings for fakes (test helper).
     *
     * Accepts 'mobile', 'tablet', 'desktop', 'bot', or any mobiledetect
     * rule name (e.g. 'iPhone', 'AndroidOS', 'Chrome'). A rule name only
     * guarantees @device('Rule') renders; the four presets drive the
     * device-type / bot directives.
     */
    public static function fake(string $what): void
    {
        $mobileDetect = new FakeMobileDetect;
        $crawlerDetect = new FakeCrawlerDetect;

        switch ($what) {
            case 'mobile':
                $mobileDetect->fakeMobile = true;
                break;
            case 'tablet':
                $mobileDetect->fakeMobile = true;
                $mobileDetect->fakeTablet = true;
                break;
            case 'desktop':
                break;
            case 'bot':
                $crawlerDetect->fakeCrawler = true;
                break;
            default:
                $mobileDetect->fakeRule = $what;
                break;
        }

        app()->instance('mobile-detect', $mobileDetect);
        app()->instance('crawler-detect', $crawlerDetect);
    }

    /**
     * Set an explicit User-Agent on both detectors for the current
     * context (e.g. inside a queued job that has no HTTP request).
     * Every directive, device_type() and @deviceclass then honour it.
     */
    public static function useAgent(string $userAgent): void
    {
        app('mobile-detect')->setUserAgent($userAgent);
        app('crawler-detect')->setUserAgent($userAgent);
    }
}
