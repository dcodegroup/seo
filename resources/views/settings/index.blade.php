<x-page-builder::layouts.admin>
    <a href="{{ route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.create')) }}" class="btn btn-primary">
        Add
    </a>
    <a href="{{ route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.clear-cache')) }}" class="btn btn-primary">
        Clear Cache
    </a>
    @foreach($settings as $key => $group)
        <h2>
            {{ \Illuminate\Support\Str::ucfirst($key) }} tags:
        </h2>
        @foreach($group as $setting)
            <div class="mb-8">
                <seo-setting-element
                        :default-setting="{{ $setting->exists ? \Illuminate\Support\Js::from($setting) : \Illuminate\Support\Js::from([]) }}"
                        :inline-edit="{{ \Illuminate\Support\Js::from(true) }}"
                        update-endpoint="{{ route(\Dcodegroup\SeoSettings\Routes::admin('seo-settings.update'), $setting->id) }}"
                ></seo-setting-element>
            </div>
        @endforeach
    @endforeach
</x-page-builder::layouts.admin>