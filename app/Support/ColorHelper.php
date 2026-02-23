<?php

namespace App\Support;

class ColorHelper
{
    /**
     * Generate Tailwind-style shade hex values from a base hex color.
     * Returns array keyed by 50, 100, 200, ... 950.
     *
     * @return array<int, string>
     */
    public static function shadesFromHex(string $hex): array
    {
        $hex = ltrim($hex, '#');
        if ($hex === '' || ! ctype_xdigit($hex)) {
            $hex = '0d9488';
        }
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        [$r, $g, $b] = array_map('hexdec', str_split($hex, 2));
        $hsl = static::rgbToHsl($r / 255, $g / 255, $b / 255);
        $h = $hsl[0];
        $s = $hsl[1];
        $lightnesses = [
            50 => 0.97,
            100 => 0.92,
            200 => 0.85,
            300 => 0.75,
            400 => 0.60,
            500 => 0.45,
            600 => 0.38,
            700 => 0.30,
            800 => 0.24,
            900 => 0.18,
            950 => 0.12,
        ];
        $out = [];
        foreach ($lightnesses as $key => $l) {
            $out[$key] = '#' . static::hslToHex($h, $s, $l);
        }
        return $out;
    }

    /**
     * @return array{0: float, 1: float, 2: float} [h, s, l]
     */
    private static function rgbToHsl(float $r, float $g, float $b): array
    {
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;
        if ($max === $min) {
            $h = $s = 0;
            return [$h, $s, $l];
        }
        $d = $max - $min;
        $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
        switch ($max) {
            case $r: $h = (($g - $b) / $d) + ($g < $b ? 6 : 0); break;
            case $g: $h = (($b - $r) / $d) + 2; break;
            default: $h = (($r - $g) / $d) + 4; break;
        }
        $h /= 6;
        return [$h, $s, $l];
    }

    private static function hslToHex(float $h, float $s, float $l): string
    {
        if ($s === 0.0) {
            $r = $g = $b = round($l * 255);
        } else {
            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;
            $r = static::hueToRgb($p, $q, $h + 1/3);
            $g = static::hueToRgb($p, $q, $h);
            $b = static::hueToRgb($p, $q, $h - 1/3);
        }
        return sprintf('%02x%02x%02x', round($r * 255), round($g * 255), round($b * 255));
    }

    private static function hueToRgb(float $p, float $q, float $t): float
    {
        if ($t < 0) $t += 1;
        if ($t > 1) $t -= 1;
        if ($t < 1/6) return $p + ($q - $p) * 6 * $t;
        if ($t < 1/2) return $q;
        if ($t < 2/3) return $p + ($q - $p) * (2/3 - $t) * 6;
        return $p;
    }
}
