<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_returns_default_when_key_missing(): void
    {
        $this->assertSame('', SiteSetting::get('missing_key'));
        $this->assertSame('default', SiteSetting::get('missing_key', 'default'));
    }

    public function test_set_and_get(): void
    {
        SiteSetting::set('test_key', 'test_value');

        $this->assertSame('test_value', SiteSetting::get('test_key'));
    }

    public function test_get_many_returns_all_keys_with_defaults(): void
    {
        SiteSetting::set('a', '1');
        SiteSetting::set('c', '3');

        $result = SiteSetting::getMany(['a', 'b', 'c']);

        $this->assertSame(['a' => '1', 'b' => '', 'c' => '3'], $result);
    }
}
