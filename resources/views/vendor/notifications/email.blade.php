<x-mail::message>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
# Dear User,
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<x-mail::button :url="$actionUrl" color="success">
{{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Thank you,<br>
The Bloom Team
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
If you're having trouble clicking the "{{ $actionText }}" button, copy and paste this URL into your web browser: 
<span class="break-all">{{ $actionUrl }}</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
