<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class DeviceBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_the_rule_matches(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iPhone')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render("@device('iPhone')<h1>Test</h1>@enddevice")
        );
    }

    #[Test]
    public function it_does_not_render_when_the_rule_does_not_match(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iPhone')->andReturn(false);
        });

        $this->assertSame(
            '',
            $this->render("@device('iPhone')<h1>Test</h1>@enddevice")
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_the_rule_does_not_match(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iPhone')->andReturn(false);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render("@device('iPhone')<h1>Test</h1>@elsedevice<h1>Else</h1>@enddevice")
        );
    }

    #[Test]
    public function it_renders_the_main_branch_when_matched_and_else_exists(): void
    {
        $this->mockDetector(function ($md) {
            $md->allows('is')->with('iPhone')->andReturn(true);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render("@device('iPhone')<h1>Test</h1>@elsedevice<h1>Else</h1>@enddevice")
        );
    }
}
