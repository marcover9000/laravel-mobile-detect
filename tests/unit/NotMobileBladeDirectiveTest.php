<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class NotMobileBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_desktop(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@notmobile<h1>Test</h1>@endnotmobile')
        );
    }

    #[Test]
    public function it_renders_when_tablet(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true, 'isTablet' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@notmobile<h1>Test</h1>@endnotmobile')
        );
    }

    #[Test]
    public function it_does_not_render_when_pure_mobile(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true, 'isTablet' => false]);
        });

        $this->assertSame(
            '',
            $this->render('@notmobile<h1>Test</h1>@endnotmobile')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_pure_mobile(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true, 'isTablet' => false]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@notmobile<h1>Test</h1>@elsenotmobile<h1>Else</h1>@endnotmobile')
        );
    }
}
