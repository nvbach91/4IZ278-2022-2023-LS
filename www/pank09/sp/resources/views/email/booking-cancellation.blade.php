@component('mail::message', ['content_colspan' => '1'])
    <h1 style="font-size: 20px; line-height: 1.4; font-weight: 500;margin:0">{{ __('Booking Cancellation') }}</h1>
    @component('mail::table')
    <tr valign="top">
        <td width="50%" style="padding: 0 32px 15px 32px;">
            <p style="font-size:12px;margin:0;">{{ __('Concert') }}</p>
            <p style="font-size:14px;color:#000000;margin:0;font-weight:500;">{{ $booking->ticket->event->title }}</p>
        </td>
    </tr>
    <tr valign="top">
        <td width="50%" style="padding: 0 32px 15px 32px;">
            <p style="font-size:12px;margin:0;">{{ __('Ticket') }}</p>
            <p style="font-size:14px;color:#000000;margin:0;font-weight:500;">{{ $booking->ticket->type }}</p>
            <p style="font-size:14px;color:#000000;margin:0;font-weight:500;">{{ $booking->amount }} x {{ $booking->ticket->price }}</p>
        </td>
    </tr>
    @endcomponent
@endcomponent
