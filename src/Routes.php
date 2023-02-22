<?php

namespace Dcodegroup\SeoSettings;

class Routes
{
    public static function admin(string $action): string
    {
        return config('seo-settings.routing.admin.name_prefix').$action;
    }
}
