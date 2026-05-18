<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class MobileBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_mobile(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true, 'isTablet' => false]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@mobile<h1>Test</h1>@endmobile')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_mobile(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '',
            $this->render('@mobile<h1>Test</h1>@endmobile')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_mobile(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@mobile<h1>Test</h1>@elsemobile<h1>Else</h1>@endmobile')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_mobile_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true, 'isTablet' => false]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@mobile<h1>Test</h1>@elsemobile<h1>Else</h1>@endmobile')
        );
    }
}
