<?php

namespace Riverskies\Laravel\MobileDetect\Directives;

use Riverskies\Laravel\MobileDetect\Contracts\BladeDirectiveInterface;

class DeviceBladeDirective implements BladeDirectiveInterface
{
    /**
     * @return string
     */
    public function openingTag()
    {
        return 'device';
    }

    /**
     * Usage: @device('iPhone'). $expression carries the user's quoted
     * rule name, passed straight to mobiledetect's is().
     *
     * @param $expression
     * @return mixed
     */
    public function openingHandler($expression)
    {
        return "<?php if (app('mobile-detect')->is({$expression})) : ?>";
    }

    /**
     * @return mixed
     */
    public function closingTag()
    {
        return 'enddevice';
    }

    /**
     * @param $expression
     * @return mixed
     */
    public function closingHandler($expression)
    {
        return "<?php endif; ?>";
    }

    /**
     * @return mixed
     */
    public function alternatingTag()
    {
        return 'elsedevice';
    }

    /**
     * @param $expression
     * @return mixed
     */
    public function alternatingHandler($expression)
    {
        return "<?php else: ?>";
    }
}
