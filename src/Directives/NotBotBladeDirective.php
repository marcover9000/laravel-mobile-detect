<?php

namespace Riverskies\Laravel\MobileDetect\Directives;

use Riverskies\Laravel\MobileDetect\Contracts\BladeDirectiveInterface;

class NotBotBladeDirective implements BladeDirectiveInterface
{
    public function openingTag()
    {
        return 'notbot';
    }

    public function openingHandler($expression)
    {
        return "<?php if (! app('crawler-detect')->isCrawler()) : ?>";
    }

    public function closingTag()
    {
        return 'endnotbot';
    }

    public function closingHandler($expression)
    {
        return "<?php endif; ?>";
    }

    public function alternatingTag()
    {
        return 'elsenotbot';
    }

    public function alternatingHandler($expression)
    {
        return "<?php else: ?>";
    }
}
