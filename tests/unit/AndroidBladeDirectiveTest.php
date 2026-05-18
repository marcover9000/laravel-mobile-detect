<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class AndroidBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_android(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('Android')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@android<h1>Test</h1>@endandroid')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_android(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('Android')->andReturn(false);
        });

        $this->assertSame(
            '',
            $this->render('@android<h1>Test</h1>@endandroid')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_android(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('Android')->andReturn(false);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@android<h1>Test</h1>@elseandroid<h1>Else</h1>@endandroid')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_android_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('Android')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@android<h1>Test</h1>@elseandroid<h1>Else</h1>@endandroid')
        );
    }
}
