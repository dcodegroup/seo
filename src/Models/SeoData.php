<?php

namespace Dcodegroup\SeoSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoData extends Model
{
    use SoftDeletes;

    protected $table = 'seo_settings';

    protected $guarded = ['id'];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
