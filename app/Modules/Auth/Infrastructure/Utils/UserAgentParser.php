<?php

namespace App\Modules\Auth\Infrastructure\Utils;

final class UserAgentParser
{
    public static function parse(string $userAgent): string
    {
        $platform = self::detectPlatform($userAgent);
        $device = self::detectDevice($userAgent);
        $browser = self::detectBrowser($userAgent);

        return trim("{$device} / {$platform} / {$browser}");
    }

    private static function detectPlatform(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Windows') => 'Windows',
            str_contains($userAgent, 'Macintosh') => 'macOS',
            str_contains($userAgent, 'iPhone') => 'iOS',
            str_contains($userAgent, 'iPad') => 'iPadOS',
            str_contains($userAgent, 'Android') => 'Android',
            str_contains($userAgent, 'Linux') => 'Linux',
            default => 'Unknown OS',
        };
    }

    private static function detectDevice(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'Mobile') && str_contains($userAgent, 'iPhone') => 'iPhone',
            str_contains($userAgent, 'Mobile') && str_contains($userAgent, 'Android') => 'Android Phone',
            str_contains($userAgent, 'iPad') => 'iPad',
            str_contains($userAgent, 'Tablet') => 'Tablet',
            str_contains($userAgent, 'Mobile') => 'Mobile Device',
            default => 'Desktop',
        };
    }

    private static function detectBrowser(string $userAgent): string
    {
        return match (true) {
            str_contains($userAgent, 'YaBrowser') => 'Yandex Browser',
            str_contains($userAgent, 'SamsungBrowser') => 'Samsung Internet',
            str_contains($userAgent, 'Edg') => 'Edge',
            str_contains($userAgent, 'OPR') || str_contains($userAgent, 'Opera') => 'Opera',
            str_contains($userAgent, 'Vivaldi') => 'Vivaldi',
            str_contains($userAgent, 'Brave') => 'Brave',
            str_contains($userAgent, 'Chrome') && !str_contains($userAgent, 'Chromium') => 'Chrome',
            str_contains($userAgent, 'Safari') && !str_contains($userAgent, 'Chrome') => 'Safari',
            str_contains($userAgent, 'Firefox') => 'Firefox',
            str_contains($userAgent, 'MSIE') || str_contains($userAgent, 'Trident') => 'Internet Explorer',
            str_contains($userAgent, 'UC Browser') => 'UC Browser',
            default => 'Unknown Browser',
        };
    }
}
