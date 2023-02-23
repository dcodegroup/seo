<?php

namespace Dcodegroup\SeoSettings;

use Dcodegroup\SeoSettings\Models\SeoData;
use Dcodegroup\SeoSettings\Models\SeoSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Seo
{
    public function getGlobalMeta(string $group = null): Collection
    {
        return Cache::remember(config('seo-settings.cache.key'), config('seo-settings.cache.duration'), function () use ($group) {
            return SeoSetting::query()
                ->when($group, fn(Builder $builder) => $builder->where('group', $group))
                ->get();
        });
    }

    public function getGlobalMetaView(string $group = null): View
    {
        return view('seo-settings::meta')
            ->with('settings', $this->getGlobalMeta($group));

    }

    public function getModelMeta(Model $model): Collection
    {
        return SeoData::query()
            ->where('seoable_id', $model->id)
            ->where('seoable_type', get_class($model))
            ->get();
    }

    public function getModelMetaView(Model $model): View
    {
        return view('seo-settings::model_meta')
            ->with('settings', $this->getModelMeta($model));
    }
}