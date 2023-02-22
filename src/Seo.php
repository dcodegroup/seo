<?php

namespace Dcodegroup\SeoSettings;

use Dcodegroup\SeoSettings\Models\SeoSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class Seo
{
    public function getGlobalMeta(): Collection
    {
        return Cache::remember(config('seo-settings.cache.key'), config('seo-settings.cache.duration'), function () {
            return SeoSetting::all();
        });
    }

    public function getGlobalMetaView(): View
    {
        return view('seo-settings::meta')
            ->with('settings', $this->getGlobalMeta());

    }
}