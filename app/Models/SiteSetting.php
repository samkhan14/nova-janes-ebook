<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
    ];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        $settings = static::cached();

        return $settings[$key] ?? $default;
    }

    public static function setValue(string $key, ?string $value, string $type = 'text', string $group = 'general', ?string $label = null): self
    {
        $setting = static::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'label' => $label,
            ],
        );

        Cache::forget('site_settings');

        return $setting;
    }

    /**
     * @return array<string, string|null>
     */
    public static function cached(): array
    {
        return Cache::rememberForever('site_settings', function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function flushCache(): void
    {
        Cache::forget('site_settings');
    }
}
