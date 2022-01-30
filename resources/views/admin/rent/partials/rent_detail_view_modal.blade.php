@php
    $item = $rent;
    $invoice = \App\Models\Invoice::where('invoice_number', $item->invoice_no)->first();

@endphp
<tr>
    <td>Receipt No #</td>
    <td>{{ isset($item->receipt_no) ? $item->receipt_no : ''}}</td>
</tr>
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
    <td>Receipt</td>
    <td><a href="{{ route('rent.receipt',$item->id) }}">Click here to view</a></td>
</tr>
<tr>
    <td>Invoice</td>
    <td><a href="{{ route('invoices.view_invoice', $invoice->id) }}">Click here to view</a></td>
</tr>
@endif
<tr>
    <td>Rent Month</td>
    <td>
        {{ \Carbon\Carbon::parse($item->invoice_issue_date)->formatLocalized('%d %b %Y') }}
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


    
