<tr>
    <td> Reservation ID</td>
    <td>{{ isset($reservation->reservation_id) ? $reservation->reservation_id: '' }}</td>
</tr>
<tr>
    <td>Tenant Name</td>
    <td>{{ isset($reservation->tenant_name) ? $reservation->tenant_name: '' }}</td>
</tr>
<tr>
    <td>Facility</td>
    <td>{{ isset($reservation->facility) ? $reservation->facility->name : '' }}</td>
</tr>
<tr>
    <td>Reservation Date</td>
    <td>{{ isset($reservation->reservation_date) ? \Carbon\Carbon::parse($reservation->reservation_date)->toFormattedDateString() : '' }}</td>
    
</tr>
<tr>
    <td>Start Time</td>
    <td>{{ isset($reservation->start_time) ? \Carbon\Carbon::parse($reservation->start_time)->format('g:i A'): '' }}</td>
</tr>
<tr>
    <td>End Time</td>
    <td>{{ isset($reservation->end_time) ? \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') : '' }}</td>
</tr>
<tr>
    <td>Amount</td>
    <td>{{ isset($reservation->amount) ? (int)$reservation->amount: '' }} BD</td>
</tr>
