<?php

namespace Dcodegroup\SeoSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoSetting extends Model
{
    use SoftDeletes;

    protected $table = 'seo_settings';

    protected $guarded = ['id'];

    protected $casts = [
        'attributes' => 'array'
    ];
}
