<?php

namespace Riverskies\Laravel\MobileDetect\Testing;

use Detection\MobileDetect;

class FakeMobileDetect extends MobileDetect
{
    public bool $fakeMobile = false;

    public bool $fakeTablet = false;

    public ?string $fakeRule = null;

    public function isMobile(?string $userAgent = null, ?array $httpHeaders = null): bool
    {
        return $this->fakeMobile;
    }

    public function isTablet(?string $userAgent = null, ?array $httpHeaders = null): bool
    {
        return $this->fakeTablet;
    }

    public function is(string $key, ?string $userAgent = null, ?array $httpHeaders = null): bool
    {
        return $this->fakeRule !== null && strcasecmp($key, $this->fakeRule) === 0;
    }
}
