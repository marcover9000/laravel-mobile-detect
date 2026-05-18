<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class TabletBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_tablet(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isTablet' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@tablet<h1>Test</h1>@endtablet')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_tablet(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isTablet' => false]);
        });

        $this->assertSame(
            '',
            $this->render('@tablet<h1>Test</h1>@endtablet')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_tablet(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isTablet' => false]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@tablet<h1>Test</h1>@elsetablet<h1>Else</h1>@endtablet')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_tablet_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isTablet' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@tablet<h1>Test</h1>@elsetablet<h1>Else</h1>@endtablet')
        );
    }
}
