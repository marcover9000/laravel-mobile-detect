<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class DeviceClassDirectiveTest extends TestCase
{
    #[Test]
    public function it_outputs_desktop_by_default(): void
    {
        $this->assertSame(
            '<x class="desktop"></x>',
            $this->render('<x class="@deviceclass"></x>')
        );
    }

    #[Test]
    public function it_outputs_mobile_when_faked_mobile(): void
    {
        MobileDetect::fake('mobile');

        $this->assertSame(
            '<x class="mobile"></x>',
            $this->render('<x class="@deviceclass"></x>')
        );
    }

    #[Test]
    public function it_outputs_tablet_when_faked_tablet(): void
    {
        MobileDetect::fake('tablet');

        $this->assertSame(
            '<x class="tablet"></x>',
            $this->render('<x class="@deviceclass"></x>')
        );
    }
}
