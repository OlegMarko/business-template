<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'string',
    ];

    public static function get(string $key, string $default = ''): string
    {
        $setting = static::query()->where('key', $key)->first();

        return $setting?->value ?? $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::query()->updateOrInsert(
            ['key' => $key],
            ['value' => $value, 'updated_at' => now()]
        );
    }

    public static function getMany(array $keys): array
    {
        $settings = static::query()
            ->whereIn('key', $keys)
            ->pluck('value', 'key')
            ->toArray();

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $settings[$key] ?? '';
        }

        return $result;
    }
}
