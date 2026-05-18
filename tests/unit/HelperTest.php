<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class HelperTest extends TestCase
{
    #[Test]
    public function it_returns_desktop_by_default(): void
    {
        $this->assertSame('desktop', device_type());
    }

    #[Test]
    public function it_returns_mobile_when_faked_mobile(): void
    {
        MobileDetect::fake('mobile');

        $this->assertSame('mobile', device_type());
    }

    #[Test]
    public function it_returns_tablet_when_faked_tablet(): void
    {
        MobileDetect::fake('tablet');

        $this->assertSame('tablet', device_type());
    }
}
