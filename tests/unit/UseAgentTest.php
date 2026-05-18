<?php

namespace Riverskies\Laravel\MobileDetect\Tests\unit;

use PHPUnit\Framework\Attributes\Test;
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;
use Riverskies\Laravel\MobileDetect\Tests\TestCase;

class UseAgentTest extends TestCase
{
    #[Test]
    public function an_iphone_user_agent_drives_mobile_detection(): void
    {
        MobileDetect::useAgent('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)');

        $this->assertSame('mobile', device_type());
        $this->assertSame(
            '<i>Y</i>',
            $this->render('@mobile<i>Y</i>@endmobile')
        );
    }

    #[Test]
    public function a_googlebot_user_agent_drives_bot_detection(): void
    {
        MobileDetect::useAgent('Googlebot/2.1 (+http://www.google.com/bot.html)');

        $this->assertSame(
            '<i>Y</i>',
            $this->render('@bot<i>Y</i>@endbot')
        );
    }
}
