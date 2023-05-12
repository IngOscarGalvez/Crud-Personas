<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ env('APP_URL') }}/img/Logo_Segtics.png" class="logo" alt="Segtics Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
