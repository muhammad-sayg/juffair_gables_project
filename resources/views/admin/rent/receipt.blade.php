<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
          background: rgb(204,204,204); 
        }
        page[size="A4"] {
          background: white;
          width: 21cm;
          height: 29.7cm;
          display: block;
          margin: 0 auto;
          margin-bottom: 0.5cm;
          box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }

        #print
        {
            padding: 5px 30px;
        }

        @page {
          size: A4;
          margin: 0;
        }

        @media print {
              body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
              }
            /* .page-break {page-break-before: always;} */
            .no-print { display: none; }
            #box
            {
              margin-top: 20%;
            }

        }
        table
        {
          border: solid 2px black !important;
          width: 80%;
          margin-top:50px;
          padding:20px;
        }
        td {
          border-collapse: collapse;
        }

        .bold~tr td {
          border: solid 1px lightgray;
        }

        td {
          padding: 0.5em;
        }

        [colspan="4"][rowspan="2"] {
          height: 6em;
        }
        hr {
        clear: both;
        }
    </style>
</head>
<body>
    <div class="container">
    <!--   each receipt -->
    <!--   header -->
      <div class="box" id="box" >
        <center><img src="{{ asset('public/assets/img/logo.png') }}"
          width="160px" height="90px" alt=""></center>
        <center>
          <table>
            <tr>
              <td colspan="4" rowspan="3" style="font-size: 18px;font-weight:bold;">Rent Receipt</td>
              <td style="width:10%">Receipt No#</td>
              <td style="border-bottom: thin solid black;border-right:solid 2px black !important;width:40%">
                {{ $rent_details->receipt_no }}
              </td>
            </tr>
  
            <tr>
              <td style="width:10%">Date.</td>
              <td style="border-bottom: thin solid black;border-right:solid 2px black !important;width:40%">
                {{ \Carbon\Carbon::parse($rent_details->received_date)->format('m-d-Y') }}
              </td>
            </tr>
            <tr>
              <td style="width:10%">Month.</td>
              <td style="border-bottom: thin solid black;border-right:solid 2px black !important;width:40%">
                @php
                  if($rent_details->rent_month != null)
                  {
                    $dateMonthArray = explode('-', $rent_details->rent_month);
                    $month = $dateMonthArray[0];
                    $year = $dateMonthArray[1];
                    $date = \Carbon\Carbon::createFromDate($year, $month, 1);
                  }
                  else 
                  {
                    $dateMonthArray = explode('-', $rent_details->rent_start_month);
                    $month = $dateMonthArray[0];
                    $year = $dateMonthArray[1];
                    $date1 = \Carbon\Carbon::createFromDate($year, $month, 1);
  
                    $dateMonthArray = explode('-', $rent_details->rent_end_month);
                    $month = $dateMonthArray[0];
                    $year = $dateMonthArray[1];
                    $date2 = \Carbon\Carbon::createFromDate($year, $month, 1);
                  }
                @endphp
                @if($rent_details->rent_month != null)
                {{ $date->format('M Y') }}
                @else
                {{ $date1->format('M Y') }} -  {{ $date2->format('M Y') }}
                @endif
              </td>
            </tr>
            <tr>
              <td colspan="12" style="padding-top: 20px;border-bottom:1px solid rgba(0,0,0,.1)">
              </td>
            </tr>
            <tr>
              <td colspan="3">Received from :</td>
              <td style="border-bottom: thin solid black;">
                {{ isset($rent_details->tenant) ? $rent_details->tenant->tenant_first_name.' '.$rent_details->tenant->tenant_last_name : ''}}
              </td>
              <td colspan="8" style="border-right:thin solid black;"></td>
            </tr>
            <tr>
              <td colspan="3">Rental Address :</td>
              <td style="border-bottom: thin solid black;" colspan="9">
                Apartment No# {{ isset($rent_details->tenant->unit) ? $rent_details->tenant->unit->unit_number : '' }}, Building 1092, Road 4022, Block 340, Juffair gables building, kingdom Of Bahrain.
              </td>
            </tr>
            <tr>
              <td colspan="3">Payment Amount :</td>
              <td style="border-bottom: thin solid black;" colspan="9">
                BHD {{ isset($rent_details->received_amount) ? round($rent_details->received_amount,0) : '' }}
              </td>
            </tr>
            <tr>
              <td colspan="3">Received by :</td>
              <td style="border-bottom: thin solid black;" colspan="9">
                Muhammad Azeem Khan
              </td>
            </tr>
            <tr>
              <td colspan="12" style="padding-top: 20px;border-bottom:1px solid rgba(0,0,0,.1)">
              </td>
            </tr>
            <tr>
              <td colspan="3" style="padding:1.9em 0 1.9em 0.5em">Signature :</td>
              <td style="padding:1.9em 0 1.9em 0.5emborder-bottom: thin solid black;border-right: thin solid black;margin-bottom:30px;" colspan="9">
              </td>
            </tr>
            
          </table>
        </center>
      </div>
      <div class="mt-3 print-button">
          <div class="text-center">
              <button class="btn btn-block no-print btn-primary text-center"  id="print">Print</button>
          </div>
      </div>
    </div>

    
    <script>
        window.onload = function () {
            document.getElementById("print").click();
        }
    </script>
    
    <script src="{{ asset("public/assets") }}/js/jquery.js"></script>
    <script src="{{ asset("public/assets") }}/js/jQuery.print.min.js"></script>
    
    <script>
    
        $('#print').click(function(){
            $("#box").print({
                // globalStyles: true,
                // mediaPrint: true,
                // stylesheet: null,
                // noPrintSelector: ".no-print",
                // iframe: true,
                // append: null,
                // prepend: null,
                // manuallyCopyFormValues: true,
                // deferred: $.Deferred(),
                // timeout: 750,
                // title: null,
                // doctype: '<!doctype html>'
            });
        });
    </script>
  </body>
</html>