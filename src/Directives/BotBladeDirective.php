<?php

namespace Riverskies\Laravel\MobileDetect\Directives;

use Riverskies\Laravel\MobileDetect\Contracts\BladeDirectiveInterface;

class BotBladeDirective implements BladeDirectiveInterface
{
    public function openingTag()
    {
        return 'bot';
    }

    public function openingHandler($expression)
    {
        return "<?php if (app('crawler-detect')->isCrawler()) : ?>";
    }

    public function closingTag()
    {
        return 'endbot';
    }

    public function closingHandler($expression)
    {
        return "<?php endif; ?>";
    }

    public function alternatingTag()
    {
        return 'elsebot';
    }

    public function alternatingHandler($expression)
    {
        return "<?php else: ?>";
    }
}
