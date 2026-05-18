<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class HandheldBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_handheld(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@handheld<h1>Test</h1>@endhandheld')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_handheld(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '',
            $this->render('@handheld<h1>Test</h1>@endhandheld')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_handheld(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => false]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@handheld<h1>Test</h1>@elsehandheld<h1>Else</h1>@endhandheld')
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_handheld_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows(['isMobile' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@handheld<h1>Test</h1>@elsehandheld<h1>Else</h1>@endhandheld')
        );
    }
}
