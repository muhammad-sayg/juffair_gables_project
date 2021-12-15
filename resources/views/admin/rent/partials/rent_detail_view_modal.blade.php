@php
    $item = $rent;
@endphp
<tr>
    <td>Tenant Name</td>
    <td>{{ isset($item->tenant) ? $item->tenant->tenant_first_name.' '.$item->tenant->tenant_last_name : ''}}</td>
</tr>
<tr>
    <td>Apartment No</td>
    <td>{{ isset($item->tenant->unit) ? $item->tenant->unit->unit_number : '' }}</td>
</tr>
<tr>
    <td>Amount</td>
    <td>{{ isset($item->rent_amount) ? round($item->rent_amount,0) : '' }} BD</td>
</tr>
@if($item->rent_paid_status_code == 1)
<tr>
    <td>Received Amount</td>
    <td>{{ isset($item->received_amount) ? round($item->received_amount,0). ' BD' : '' }}</td>
</tr>
<tr>
    <td>Received Date</td>
    <td>{{ isset($item->received_date) ? \Carbon\Carbon::parse($item->received_date)->toFormattedDateString() : '' }}</td>
</tr>
<tr>
    <td>Uploaded Document</td>
    <td><a href="{{ url('public/admin/assets/img/rent/receipt') }}/{{ isset($item->rent_receipt)? $item->rent_receipt : '' }}" target="blank">view</a></td>
</tr>
@endif
<tr>
    <td>Rent Month</td>
    <td>
        @php
            if($item->rent_month != null)
            {
            $dateMonthArray = explode('-', $item->rent_month);
            $month = $dateMonthArray[0];
            $year = $dateMonthArray[1];
            $date = \Carbon\Carbon::createFromDate($year, $month, 1);
            }
            else 
            {
            $dateMonthArray = explode('-', $item->rent_start_month);
            $month = $dateMonthArray[0];
            $year = $dateMonthArray[1];
            $date1 = \Carbon\Carbon::createFromDate($year, $month, 1);

            $dateMonthArray = explode('-', $item->rent_end_month);
            $month = $dateMonthArray[0];
            $year = $dateMonthArray[1];
            $date2 = \Carbon\Carbon::createFromDate($year, $month, 1);
            }
        @endphp
        @if($item->rent_month != null)
        {{ $date->format('M Y') }}
        @else
        {{ $date1->format('M Y') }} -  {{ $date2->format('M Y') }}
        @endif
    </td>
</tr>
<tr>
    <td>Rent Status</td>
    <td>
        @php
        $class = '';
        switch ($item->rent_paid_status_code) {
        case 1:
            $class = 'badge-success';
            break;
        default:
            $class = 'badge-warning';
            break;
        }
    @endphp
    <span class="badge {{ $class }}">{{ $item->rent_status ? $item->rent_status->rent_paid_status_name : ''}}</span>
    </td>
</tr>


    
