<?php

namespace Tests\Unit;

use App\Support\ColorHelper;
use PHPUnit\Framework\TestCase;

class ColorHelperTest extends TestCase
{
    public function test_shades_from_hex_returns_all_tailwind_shade_keys(): void
    {
        $shades = ColorHelper::shadesFromHex('#0d9488');

        $expected = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950];
        foreach ($expected as $key) {
            $this->assertArrayHasKey($key, $shades);
            $this->assertMatchesRegularExpression('/^#[0-9a-f]{6}$/i', $shades[$key]);
        }
    }

    public function test_shades_from_hex_handles_short_hex(): void
    {
        $shades = ColorHelper::shadesFromHex('#f00');
        $this->assertCount(11, $shades);
        $this->assertArrayHasKey(500, $shades);
    }

    public function test_shades_from_hex_handles_invalid_hex(): void
    {
        $shades = ColorHelper::shadesFromHex('');
        $this->assertCount(11, $shades);
        $this->assertArrayHasKey(500, $shades);
    }
}
