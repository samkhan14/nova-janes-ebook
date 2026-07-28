<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSection extends Model
{
    protected $fillable = [
        'page',
        'section_key',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public static function getContent(string $page, string $sectionKey, array $default = []): array
    {
        $section = static::query()
            ->where('page', $page)
            ->where('section_key', $sectionKey)
            ->first();

        return $section?->content ?? $default;
    }

    public static function putContent(string $page, string $sectionKey, array $content): self
    {
        return static::query()->updateOrCreate(
            ['page' => $page, 'section_key' => $sectionKey],
            ['content' => $content],
        );
    }
}
