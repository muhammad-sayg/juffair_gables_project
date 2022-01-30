
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css') }}/components.css">
    <style>
        .main-navbar
        {
            background-color: #fff !important;
            box-shadow: 0 0 10px 1px rgb(68 102 242 / 5%);
        }
        .navbar .nav-link .feather {
            color: #555556 !important;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: unset !important;
        }
    </style>
</head>
<body>
    <section class="section">
        <div class="section-body">
          <div class="invoice" id="invoice">
            <div class="invoice-print">
              <div class="row">
                <div class="col-lg-12">
                    <div>
                        <img src="{{ asset('public/assets/img/logo.png') }}" width="160px" height="90px" alt="">
                    </div>
                    <div style="display: flex">
    
                        <table class="table table-striped table-hover table-md" style="width:50%;margin-top:20px">
                            <tr>
                                <th colspan="2"><h1>INVOICE</h1></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td style="width: 20%"></td>
                                <td>{{ $invoice->tenant->tenant_first_name }} {{ $invoice->tenant->tenant_last_name }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Apartment {{ $invoice->tenant->unit->unit_number }}, Building - 1092, Road - 4022, Block 340, Al Juffair<br> Manama<br> Kingdom of Bahrain</td>
                            </tr>
                        </table>
                        <div style="margin-top: 50px;">
                            <p style="margin-bottom: 0px;font-weight:700">Invoice Date</p>
                            <p style="margin-bottom: 0px">{{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->formatLocalized('%d %b %Y') }}</p>
                            <p style="margin-bottom: 0px;font-weight:700">Invoice Number</p>
                            <p style="margin-bottom: 0px">{{ $invoice->invoice_number }}</p>
                            <p style="margin-bottom: 0px;font-weight:700">Reference</p>
                            <p>Rent for {{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->formatLocalized('%b. %Y') }}</p>
                        </div>
                        <div style="margin-top: 50px;margin-left:40px">
                            <p style="margin-bottom: 0px">JUFFAIR GABLES<br>BUILDING #1092, ROAD #4022, BLOCK #340, AL JUFFAIR, MANAMA,<br>
                                KINGDOM OF BAHRAIN.</p>
                            <p style="margin-bottom: 0px">Tel: +97317255577</p>
                            <p style="margin-bottom: 0px">Email:</p>
                            <p>juffairgables@gmail.com</p>
                        </div>
                    </div>
                </div>
              </div>
              <div class="row" style="margin-top: 100px;">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-md">
                      <tr style="border-bottom: 1px solid;">
                        <th style="width:60%;text-align: left">Description</th>
                        <th class="text-center" style="text-align: center;">Quantity</th>
                        <th class="text-center" style="text-align: center;">Unit Price</th>
                        <th class="text-center" style="text-align: center;">Amount BHD</th>
                        
                      </tr>
                      <tr style="border-bottom:2px solid #d6bebe">
                        <td>Rent of Apartment {{ $invoice->tenant->unit->unit_number }}, Bldg 1092, AL JUFFAIR, Manama for the period {{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->formatLocalized('%d %b. %Y') }} to {{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->addDays(30)->formatLocalized('%d %b. %Y') }}</td>
                        <td class="text-center" style="text-align: center;">1.0</td>
                        <td class="text-center" style="text-align: center;">{{ $invoice->invoice_amount }}</td>
                        <td class="text-center" style="text-align: center;">{{ $invoice->invoice_amount }}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <td class="text-center"  style="border-bottom: 2px solid;text-align: center;">Sub Total</td>
                          <td class="text-center"  style="border-bottom: 2px solid;text-align: center;">{{ $invoice->invoice_amount }}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center" style="font-weight:900;text-align: center;">TOTAL BHD</td>
                        <td class="text-center" style="font-weight:900;text-align: center;">{{ $invoice->invoice_amount }}</td>
                      </tr>
                    </table>
                  </div>
                  <div class="row" style="margin-top: 100px;">
                    <div class="col-lg-8">
                      <div class="section-title">Due Date: {{ \Carbon\Carbon::parse($invoice->invoice_issue_date)->addDays(5)->formatLocalized('%d %b %Y') }}</div>
                      <p class="section-lead">Bank Transfer Details:</p>
                      <p class="section-lead" style="margin-bottom: 0px">Account Name: SH NAWAF EBRAHIM HAMAD ALKHALIFA</p>
                      <p class="section-lead" style="margin-bottom: 0px">Bank: AHLI UNITED BANK</p>
                      <p class="section-lead" style="margin-bottom: 0px">Account Number: 0016-249409-001</p>
                      <p class="section-lead" style="margin-bottom: 0px">IBAN: BH53 AUBBO 0016 2494 09001</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <center style="margin-top: 120px;">
                <p style="font-weight: 700">Building - 1092, Road - 4022, Block 340, Al Juffair, Manama, Kingdom of Bahrain, Tel. +973-17255577, juffairgables@gmail.com</p>
            </center>
          </div>
        </div>
      </section>
</body>
</html>

