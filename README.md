# Laravel Mobile Detect

[![Latest Stable Version](https://img.shields.io/packagist/v/marcover9000/laravel-mobile-detect.svg)](https://packagist.org/packages/marcover9000/laravel-mobile-detect)
[![Total Downloads](https://img.shields.io/packagist/dt/marcover9000/laravel-mobile-detect.svg)](https://packagist.org/packages/marcover9000/laravel-mobile-detect)
[![PHP Version](https://img.shields.io/packagist/php-v/marcover9000/laravel-mobile-detect.svg)](https://packagist.org/packages/marcover9000/laravel-mobile-detect)
[![License](https://img.shields.io/packagist/l/marcover9000/laravel-mobile-detect.svg)](https://packagist.org/packages/marcover9000/laravel-mobile-detect)

A package that enables you to use device detection right in your Blade templates. (Utilises the well-known, constantly updated [PHP mobile detection library](http://mobiledetect.net/).)

> Maintained fork for Laravel 12 by Marc (`marcover9000`). Original package by Barnabas Kecskes ([riverskies](https://github.com/riverskies/laravel-mobile-detect)), MIT licensed.

### When would you use this package?
Responsive CSS may help to make content in the browser look nice on different devices but it won't help you serve responsive content from your backend (at least not the easy way). This can have a really bad knock-on effect on the user experience (have you ever waited for a large image to load while having a bad connection on your mobile?). This package will make it a breeze to serve device-specific content right from your back-end.

### How does this package work?
The package implements various Blade directives that you can use to serve different content from your Blade template for different device types.

### Installation
Install the package through Composer:

```sh
composer require marcover9000/laravel-mobile-detect
```

On Laravel 12 the service provider and the optional `MobileDetect` facade are auto-discovered — no manual registration needed.

> **NOTE** You might have to run `php artisan view:clear` for the Blade directives to take effect.

### Usage
Use the new Blade directives in your template files:

```php
@desktop
    <img src="/path/to/high-definition/image"/>
@elsedesktop
    <img src="/path/to/handheld-optimised/image"/>
@enddesktop
```

> **NOTE** You might have to run `php artisan view:clear` to have the new Blade directives take effect!

### Available directives
`@desktop`, `@elsedesktop`, `@enddesktop` - for destkop devices

`@handheld`, `@elsehandheld`, `@endhandheld` - for non-desktop (mobile and tablet) devices

`@tablet`, `@elsetablet`, `@endtablet` - for tablet devices

`@nottablet`, `@elsenottablet`, `@endnottablet` - for non-tablet (desktop or mobile) devices

`@mobile`, `@elsemobile`, `@endmobile` - for mobile devices

`@notmobile`, `@elsenotmobile`, `@endnotmobile` - for non-mobile (desktop or tablet) devices

`@ios`, `@elseios`, `@endios` - for iOS platforms

`@android`, `@elseandroid`, `@endandroid` - for Android platforms

`@device('Rule')`, `@elsedevice`, `@enddevice` - for any [mobiledetect rule](https://github.com/serbanghita/Mobile-Detect) (e.g. `@device('iPhone')`, `@device('AndroidOS')`, `@device('Chrome')`)

`@bot`, `@elsebot`, `@endbot` - for crawlers/bots

`@notbot`, `@elsenotbot`, `@endnotbot` - for non-bots

The usage of `@else...` directives are optional.

### Testing
In your application's tests you can fake the detected device without
mocking anything:

```php
use Riverskies\Laravel\MobileDetect\Facades\MobileDetect;

MobileDetect::fake('mobile');   // also: 'tablet', 'desktop', 'bot'
MobileDetect::fake('iPhone');   // any mobiledetect rule, drives @device('iPhone')
```

The fake is scoped to the test (a fresh app per test); the presets
`mobile`/`tablet`/`desktop`/`bot` drive the device-type and bot
directives, a rule name drives `@device('Rule')`.

### Development
This package ships a Docker dev environment (PHP 8.3 + Composer):

```sh
docker compose build
docker compose run --rm dev composer install
docker compose run --rm dev vendor/bin/phpunit
```
