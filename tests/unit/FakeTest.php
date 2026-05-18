<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class FakeTest extends TestCase
{
    #[Test]
    public function fake_mobile_drives_the_mobile_directive(): void
    {
        MobileDetect::fake('mobile');

        $this->assertSame('<i>Y</i>', $this->render('@mobile<i>Y</i>@endmobile'));
        $this->assertSame('', $this->render('@desktop<i>Y</i>@enddesktop'));
    }

    #[Test]
    public function fake_tablet_drives_the_tablet_directive(): void
    {
        MobileDetect::fake('tablet');

        $this->assertSame('<i>Y</i>', $this->render('@tablet<i>Y</i>@endtablet'));
        $this->assertSame('', $this->render('@desktop<i>Y</i>@enddesktop'));
    }

    #[Test]
    public function fake_desktop_drives_the_desktop_directive(): void
    {
        MobileDetect::fake('desktop');

        $this->assertSame('<i>Y</i>', $this->render('@desktop<i>Y</i>@enddesktop'));
        $this->assertSame('', $this->render('@mobile<i>Y</i>@endmobile'));
    }

    #[Test]
    public function fake_bot_drives_the_bot_directives(): void
    {
        MobileDetect::fake('bot');

        $this->assertSame('<i>Y</i>', $this->render('@bot<i>Y</i>@endbot'));
        $this->assertSame('', $this->render('@notbot<i>Y</i>@endnotbot'));
    }

    #[Test]
    public function fake_rule_name_drives_the_device_directive(): void
    {
        MobileDetect::fake('iPhone');

        $this->assertSame(
            '<i>Y</i>',
            $this->render("@device('iPhone')<i>Y</i>@elsedevice<i>n</i>@enddevice")
        );
    }

    #[Test]
    public function it_auto_resets_when_fake_is_not_called(): void
    {
        // Fresh Testbench app, real bindings, no User-Agent in CLI:
        // real MobileDetect -> not mobile (desktop true), not a crawler.
        $this->assertSame('<i>D</i>', $this->render('@desktop<i>D</i>@enddesktop'));
        $this->assertSame('', $this->render('@bot<i>B</i>@endbot'));
    }
}
