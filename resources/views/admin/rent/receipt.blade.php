@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
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
    /* .table-striped tbody tr:nth-of-type(odd) {
        background-color: unset !important;
    } */
    /* .table-striped tbody tr:nth-of-type(odd) {
        background-color: unset !important;
    } */
    .invoice hr {
        border-top-color: #000000 !important;
        border-top: 6px solid black;
        margin-top: 0 !important;
    }
    p {
    margin-top: 0;
    margin-bottom: 0!important;
    }
    
    /* .table:not(.table-sm) thead th {
    background-color: #0c0c0c!important;
    color: #fff!important;
    } */
    /* .receipt-header {
    background-color: black;
    color: white;   
    } */
    body {
      -webkit-print-color-adjust: exact !important;
    }
    @media print {
      table tr.highlighted > th {
        background-color: rgba(0, 0, 0, 0.8) !important;
       }

    }

    * {
        color-adjust: exact!important;  
        -webkit-print-color-adjust: exact!important; 
         print-color-adjust: exact!important;
      }
   
</style>
@stop
@section('content')
<section class="section" >
    <div class="section-body">
      <div class="invoice" id="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
                <div style="margin-top:40px;">
                    <img src="{{ asset('public/assets/img/logo.png') }}" width="160px" height="90px" alt="" style="float:right;position: relative;bottom: 54px;">
                    <h3 style="color:black;">PAYMENT RECEIPT</h3>
                    <hr>
                </div>
                <div style="display: flex;justify-content: space-between;" style="margin-top: 60px;">
                    <div>
                        To,
                        <p ><b>Mr./Ms {{ $rent->tenant->tenant_first_name }} {{ $rent->tenant->tenant_last_name }}</b></p>
                        <h6>(Apartment #{{ $rent->tenant->unit->unit_number }})</h6>
                        <p>Building #1092, Road #4022, Block #340, </p>
                        <p>Al Juffair, Manama, Kingdom of Bahrain</p>
                        <p>Tel.+973 17255577</p>
                    </div>
                    <div>
                      <p style="border-bottom: 2px  solid; margin-bottom:20px!important;"><b>{{ \Carbon\Carbon::parse($rent->rent_month)->format('F j, Y') }}</b></p>
                      <p style="border-bottom: 2px  solid ;"><b>Receipt No. {{ $rent->receipt_no }}</b></p>
                    </div>
                </div>
            </div>
          </div>
          <div class="row" style="margin-top: 100px;">
            <div class="col-md-12">
              <div>
                <table class="table table-striped table-hover table-md">
                  <tr class="receipt-headers highlighted" style="border:2px solid;color:#fff">
                    <th colspan="3" class="receipt-header" style="border: 2px solid;background: black !important;">Description</th>
                    <th  class="receipt-header text-center" style="width:15%;border: 2px solid;background: black !important;">Amount(BHD)</th>
                    
                  </tr>
                  <tr style="border-bottom:2px solid #d6bebe;">
                    <td colspan="3" style="border: 2px solid;" class="">Rent of Apartment {{ $rent->tenant->unit->unit_number }}, Bldg 1092, AL JUFFAIR, Manama for the period {{ \Carbon\Carbon::parse($rent->rent_month)->formatLocalized('%d %b. %Y') }} to {{ \Carbon\Carbon::parse($rent->rent_month)->addDays(30)->formatLocalized('%d %b. %Y') }}</td>
                    <td class="text-right" style="border: 2px solid;">
                       {{ number_format($rent->received_amount + $rent->due_amount,2) }}
                    </td>
                  </tr>
                  <tr style="border-bottom:2px solid #d6bebe">
                    <td colspan="3" style="border: 2px solid;" class=""></td>
                    <td class="" style="border: 2px solid;"></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right"><b>Sub Total</b></td>
                    <td class="text-right" style="border-bottom: 2px solid;">{{ number_format($rent->received_amount + $rent->due_amount,2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right"><b>Paid</b></td>
                    <td class="text-right" style="border-bottom: 2px solid;">{{ number_format($rent->received_amount,2) }}</td>
                  </tr>
                  <tr>
                  <td colspan="3" class="text-right"><b>Balance Due</b></td>
                    <td class="text-right" style="border-bottom: 2px solid;">{{ number_format($rent->due_amount,2) }}</td>
                  </tr>
                </table>
              </div>
              <div class="row mb-3" style="margin-top: 100px;">
                <div class="col-lg-8">
                  <p class="section-lead"><b>Payment recieved as:</b></p>
                  <div class="pretty p-default">
                      <input type="checkbox" /> Cash
                    </div>
                 <div class="pretty p-default">
                      <input type="checkbox" /> Cheque No.____, Bank:____, Dated:_____
                    </div>
                    <div class="pretty p-default">
                      <input type="checkbox" /> Credit / Debit Card
                    </div>
                    <div class="pretty p-default">
                      <input type="checkbox" /> Electronic Transfer
                    </div>
                </div>
                <br><br><br><br><br>
              <div class="mt-3 col-lg-5">
              <br><br><br>
                  <div >
                  <p style="border-top: 2px solid;width: 170px;"><b>Account Department</b></p>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <center style="margin-top: 120px;">
            <p style="font-weight: 700">Building - 1092, Road - 4022, Block 340, Al Juffair, Manama, Kingdom of Bahrain, Tel. +973-17255577, juffairgables@gmail.com</p>
        </center>
        
        <div style="display: flex;justify-content:flex-start">
          <button class="btn btn-warning no-print btn-icon icon-left" id="print"><i class="fas fa-print" ></i> Print</button>
          <a href="{{ url()->previous() }}" class="btn ml-3 btn-primary no-print btn-icon icon-left">Cancel</a>
        </div>
      </div>
    </div>
  </section>
@stop
@section('footer_scripts')
<script src="{{ asset("public/assets") }}/js/jquery.js"></script>
  <script src="{{ asset("public/assets") }}/js/jQuery.print.min.js"></script>
  
  <script>
      $('#print').click(function(){
          $("#invoice").print({
              globalStyles: true,
              mediaPrint: true,
              stylesheet: null,
              noPrintSelector: ".no-print",
              iframe: true,
              append: null,
              prepend: null,
              manuallyCopyFormValues: true,
              deferred: $.Deferred(),
              timeout: 750,
              title: null,
              doctype: '<!doctype html>'
          });
      });
  </script>
@stop