@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
<h1>{{ __('emails.reset_password') }}</h1>
<p>{{ __('emails.greeting') }},</p>
<p>{{ __('emails.intro_line') }}</p>
<p>{{ __('emails.outro_line') }}</p>
<p> Este link expirara en 60 segundos.</p>
{{ $slot }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('auth.all_rights_reserved')
@endcomponent
@endslot
@endcomponent
