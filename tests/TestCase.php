<?php

namespace Riverskies\Laravel\MobileDetect\Tests;

use Closure;
use Detection\MobileDetect;
use Illuminate\Support\Facades\Blade;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Mockery;
use Orchestra\Testbench\TestCase as Orchestra;
use Riverskies\Laravel\MobileDetect\MobileDetectServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * Register the package's service provider in the test app.
     */
    protected function getPackageProviders($app): array
    {
        return [MobileDetectServiceProvider::class];
    }

    /**
     * Bind a loosely-stubbed detector into the container as 'mobile-detect'.
     * Using allows() so unreferenced methods (short-circuited away) don't fail.
     */
    protected function mockDetector(Closure $expectations): void
    {
        $mock = Mockery::mock(MobileDetect::class);
        $expectations($mock);
        $this->app->instance('mobile-detect', $mock);
    }

    /**
     * Bind a loosely-stubbed crawler detector into the container as
     * 'crawler-detect'.
     */
    protected function mockCrawler(Closure $expectations): void
    {
        $mock = Mockery::mock(CrawlerDetect::class);
        $expectations($mock);
        $this->app->instance('crawler-detect', $mock);
    }

    /**
     * Render an inline Blade template. Directives are already registered by
     * the package service provider booted by Testbench.
     */
    protected function render(string $template): string
    {
        return trim(Blade::render($template));
    }
}
