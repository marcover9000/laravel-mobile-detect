<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class iOSBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_ios(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iOS')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@ios<h1>Test</h1>@endios')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_ios(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iOS')->andReturn(false);
        });

        $this->assertSame(
            '',
            $this->render('@ios<h1>Test</h1>@endios')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_ios(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iOS')->andReturn(false);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@ios<h1>Test</h1>@elseios<h1>Else</h1>@endios')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_ios_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iOS')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@ios<h1>Test</h1>@elseios<h1>Else</h1>@endios')
        );
    }
}
