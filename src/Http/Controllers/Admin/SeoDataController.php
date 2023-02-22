<?php

namespace Dcodegroup\SeoSettings\Http\Controllers\Admin;


use Dcodegroup\SeoSettings\Http\Requests\SeoDataRequest;
use Dcodegroup\SeoSettings\Models\SeoData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeoDataController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        return response()->json([
            'model' => SeoData::query()
                ->where('seoable_type', $request->query('modelClass'))
                ->where('seoable_id', $request->query('modelId'))
                ->first()
        ]);
    }

    public function save(SeoDataRequest $request, string $modelClass, int $modelId): JsonResponse
    {
        SeoData::query()->firstOrCreate([
            'seoable_type' => $modelClass,
            'seoable_id' => $modelId,
        ], $request->validated());

        return response()->json();
    }
}