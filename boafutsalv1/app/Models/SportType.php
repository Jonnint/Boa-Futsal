<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SportType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'hero_title',
        'hero_subtitle',
        'description',
        'hero_image_path',
        'facilities',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'facilities' => 'array',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class, 'sport_type_id', 'id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(SportTypeGallery::class, 'sport_type_id', 'id')
            ->whereNull('archived_at')
            ->orderBy('order');
    }

    public function archivedGalleries(): HasMany
    {
        return $this->hasMany(SportTypeGallery::class, 'sport_type_id', 'id')
            ->whereNotNull('archived_at');
    }

    public function switchLogs(): HasMany
    {
        return $this->hasMany(SportTypeSwitchLog::class, 'to_sport_type_id', 'id');
    }

    public function pageSections(): HasMany
    {
        return $this->hasMany(SportTypePageSection::class, 'sport_type_id', 'id')->orderBy('order');
    }

    public function getSection(string $pageKey, string $sectionKey): ?SportTypePageSection
    {
        if ($this->relationLoaded('pageSections')) {
            return $this->pageSections->first(function ($section) use ($pageKey, $sectionKey) {
                return $section->page_key === $pageKey && $section->section_key === $sectionKey;
            });
        }

        return $this->pageSections()
            ->where('page_key', $pageKey)
            ->where('section_key', $sectionKey)
            ->first();
    }

    public function getSectionValue(string $pageKey, string $sectionKey, $default = '')
    {
        $section = $this->getSection($pageKey, $sectionKey);
        if (!$section) {
            return $default;
        }

        return $section->parsed_value ?: $default;
    }

    public function getSectionImage(string $pageKey, string $sectionKey, $default = null): ?string
    {
        $section = $this->getSection($pageKey, $sectionKey);
        if (!$section || !$section->image_path) {
            return $default;
        }

        return $section->image_path;
    }
}
