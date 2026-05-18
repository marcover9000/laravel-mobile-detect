<?php

if (! function_exists('device_type')) {
    function device_type(): string
    {
        $detector = app('mobile-detect');

        if ($detector->isTablet()) {
            return 'tablet';
        }

        return $detector->isMobile() ? 'mobile' : 'desktop';
    }
}
