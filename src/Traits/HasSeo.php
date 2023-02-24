<?php

namespace Dcodegroup\SeoSettings\Traits;

use Dcodegroup\SeoSettings\Models\SeoData;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public function seoData(): MorphOne
    {
        return $this->morphOne(SeoData::class, 'seoable');
    }
}