@extends('layouts.admin.app')
{{-- Page title --}}

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('public/admin/assets/css') }}/components.css">
<style>
    .navbar-bg
    {
        background:#fff;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: unset !important;
    }
</style>
@stop
@section('content')
<section class="section">
    <div class="section-body">
      <div class="invoice" id="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
                <div>
                    <img src="{{ asset('public/assets/img/logo.png') }}" width="160px" height="90px" alt="">
                </div>
                <div style="display: flex" style="margin-top: 60px;">

                    <table class="table table-striped table-hover table-md" style="width:50%;margin-top:50px">
                        <tr>
                            <th colspan="2"><h1>Invoice</h1></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Layla ahmad Khalil AlMaralkhi</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Apartment 52, Building - 1092, Road - 4022, Block 340, Al Juffair<br> Manama<br> Kingdom of Bahrain</td>
                        </tr>
                    </table>
                    <div style="margin-top: 50px;">
                        <p style="margin-bottom: 0px;font-weight:700">Invoice Date</p>
                        <p style="margin-bottom: 0px">01 Dec 2021</p>
                        <p style="margin-bottom: 0px;font-weight:700">Invoice Number</p>
                        <p style="margin-bottom: 0px">INV-0370</p>
                        <p style="margin-bottom: 0px;font-weight:700">Reference</p>
                        <p>Rent for Dec. 2021</p>
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
                    <th style="width:60%">Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Unit Price</th>
                    <th class="text-center">Amount BHD</th>
                    
                  </tr>
                  <tr style="border-bottom:2px solid #d6bebe">
                    <td>Rent of Shop 23, Bldg 1311, Ahli house, Manama for the period 01st Dec. 2021 to 31st Dec. 2021</td>
                    <td class="text-center">1.0</td>
                    <td class="text-center">500.00</td>
                    <td class="text-center">500.00</td>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td class="text-center" style="border-bottom: 2px solid;">Sub Total</td>
                      <td class="text-center" style="border-bottom: 2px solid;">500.00</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center" style="font-weight:900">TOTAL BHD</td>
                    <td class="text-center" style="font-weight:900">500.00</td>
                  </tr>
                </table>
              </div>
              <div class="row" style="margin-top: 100px;">
                <div class="col-lg-8">
                  <div class="section-title">Due Date: 3 Dec 2022</div>
                  <p class="section-lead">Bank Transfer Details:</p>
                  <p class="section-lead" style="margin-bottom: 0px">Account Name: Al Ahli House Real Estate</p>
                  <p class="section-lead" style="margin-bottom: 0px">Bank: Bank of Bahrain and Kuwait</p>
                  <p class="section-lead" style="margin-bottom: 0px">Account Number: 100000430664</p>
                  <p class="section-lead" style="margin-bottom: 0px">IBAN: BH75 BBKU 0010 0000 4306 64</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <center style="margin-top: 120px;">
            <p style="font-weight: 700">Building - 1092, Road - 4022, Block 340, Al Juffair, Manama, Kingdom of Bahrain, Tel. +973-17255577, juffairgables@gmail.com</p>
        </center>
        <hr>
        <div>
          <button class="btn btn-warning no-print btn-icon icon-left" id="print"><i class="fas fa-print" ></i> Print</button>
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