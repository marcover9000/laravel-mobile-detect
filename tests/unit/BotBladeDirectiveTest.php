<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class BotBladeDirectiveTest extends TestCase
{
    #[Test]
    public function it_renders_when_crawler(): void
    {
        $this->mockCrawler(function ($cd) {
            $cd->allows(['isCrawler' => true]);
        });

        $this->assertSame(
            '<h1>Test</h1>',
            $this->render('@bot<h1>Test</h1>@endbot')
        );
    }

    #[Test]
    public function it_does_not_render_when_not_crawler(): void
    {
        $this->mockCrawler(function ($cd) {
            $cd->allows(['isCrawler' => false]);
        });

        $this->assertSame(
            '',
            $this->render('@bot<h1>Test</h1>@endbot')
        );
    }

    #[Test]
    public function it_renders_the_else_branch_when_not_crawler(): void
    {
        $this->mockCrawler(function ($cd) {
            $cd->allows(['isCrawler' => false]);
        });

        $this->assertSame(
            '<h1>Else</h1>',
            $this->render('@bot<h1>Test</h1>@elsebot<h1>Else</h1>@endbot')
        );
    }
}
