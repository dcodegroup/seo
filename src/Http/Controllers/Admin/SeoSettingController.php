<?php

namespace Dcodegroup\SeoSettings\Http\Controllers\Admin;

use Dcodegroup\SeoSettings\Http\Requests\SeoSettingRequest;
use Dcodegroup\SeoSettings\Models\SeoSetting;
use Dcodegroup\SeoSettings\Routes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class SeoSettingController extends Controller
{
    public function index(): View
    {
        return view('seo-settings::settings.index')
            ->with('settings', SeoSetting::all()->groupBy('tag'));
    }

    public function create(): View
    {
        return view('seo-settings::settings.edit')
            ->with('setting', new SeoSetting());
    }

    public function store(SeoSettingRequest $request): RedirectResponse
    {
        SeoSetting::query()->create($request->validated());

        return redirect()->route(Routes::admin('seo-settings.index'));
    }

    public function update(SeoSettingRequest $request, SeoSetting $seoSetting): JsonResponse
    {
        $seoSetting->update($request->validated());

        return response()->json();
    }

    public function clearCache(): RedirectResponse
    {
        Cache::delete(config('seo-settings.cache.key'));

        return redirect()->route(Routes::admin('seo-settings.index'));
    }
}