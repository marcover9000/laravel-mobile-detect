<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class PackageDiscoveryTest extends TestCase
{
    #[Test]
    public function composer_json_declares_the_provider_and_alias_for_auto_discovery(): void
    {
        $composer = json_decode(
            file_get_contents(__DIR__.'/../../composer.json'),
            true
        );

        $this->assertContains(
            'Riverskies\\Laravel\\MobileDetect\\MobileDetectServiceProvider',
            $composer['extra']['laravel']['providers'] ?? [],
            'The service provider must be declared under extra.laravel.providers for Laravel auto-discovery.'
        );

        $this->assertSame(
            'Riverskies\\Laravel\\MobileDetect\\Facades\\MobileDetect',
            $composer['extra']['laravel']['aliases']['MobileDetect'] ?? null,
            'The MobileDetect alias must be declared under extra.laravel.aliases for Laravel auto-discovery.'
        );
    }
}
