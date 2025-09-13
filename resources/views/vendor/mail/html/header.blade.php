@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ url('images/Mitsubishi_logoCrop.png') }}" class="logo" alt="Mitsubishi Logo">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>

