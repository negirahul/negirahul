@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif --}}
<img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="Claimstack" width="100%">
</a>
</td>
</tr>
