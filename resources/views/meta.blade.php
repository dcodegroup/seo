@foreach($settings as $setting)
    @if ($setting->tag !== 'script')
    <{{ $setting->tag }} @foreach($setting->attributes as $attribute) {{ data_get($attribute, 'key') }}="{{ data_get($attribute, 'value') }}" @endforeach />
    @else
    <script @foreach($setting->attributes as $attribute) {{ data_get($attribute, 'key') }}="{{ data_get($attribute, 'value') }}" @endforeach>
    {!! $setting->value !!}
    </script>
    @endif
@endforeach