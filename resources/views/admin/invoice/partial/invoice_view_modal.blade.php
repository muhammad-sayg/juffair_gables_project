<tr>
    <td>Invoice Number</td>
    <td>{{ $invoice->invoice_number }}</td>
</tr>
<tr>
    <td>Invoice Date</td>
    <td>{{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->format('Y-m-d') }}</td>
</tr>
<tr>
    <td>Invoice Amount</td>
    <td>{{ $invoice->invoice_amount  }} BD</td>
</tr>
<tr>
    <td>Tenant Name</td>
    <td>{{ $invoice->tenant->tenant_first_name }} {{ $invoice->tenant->tenant_last_name }}</td>
</tr>
<tr>
    <td>Invoice</td>
    <td><a href="{{ route('invoices.view_invoice', $invoice->id) }}">Click here to view</a></td>
</tr>
  
