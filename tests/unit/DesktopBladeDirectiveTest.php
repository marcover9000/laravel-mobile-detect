<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class DesktopBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_desktop(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@desktop<h1>Test</h1>@enddesktop')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_desktop(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true]);
        });

        $this->assertSame(
            '',
            $this->render('@desktop<h1>Test</h1>@enddesktop')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_desktop(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@desktop<h1>Test</h1>@elsedesktop<h1>Else</h1>@enddesktop')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_desktop_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@desktop<h1>Test</h1>@elsedesktop<h1>Else</h1>@enddesktop')
        );
    }
}
