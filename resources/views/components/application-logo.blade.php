@php
    $setting = DB::table('salon_settings')->first();
@endphp

<img src="{{ asset('logo/' . $setting->logo) }}" {{ $attributes }}/>
