@php
$action = $setting->exists ? route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.update')) : route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.store'));
@endphp
<x-page-builder::layouts.admin>
    <div class="my-8">
        <a href="{{ route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.index')) }}" class="btn btn-primary">
            Back
        </a>
    </div>
    <form action="{{ $action }}" method="post">
        @csrf
        @if($setting->exists)
            @method('put')
        @endif
        <seo-setting-element
                :default-setting="{{ $setting->exists ? \Illuminate\Support\Js::from($setting) : \Illuminate\Support\Js::from([]) }}"
        ></seo-setting-element>
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
</x-page-builder::layouts.admin>