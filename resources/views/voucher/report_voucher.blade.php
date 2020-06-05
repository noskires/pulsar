<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulsar Construction</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body onload="window.print();" style="font-family: Helvetica;">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- Header -->
    <div class="row">
      <div class="col-xs-12" style="font-size: 11px;">
        <p> <span style="font-size:12px;font-weight:bold;">PULSAR CONSTRUCTION<br></span> Dodan, Penablanca 3502, Philippines</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/credit-cards-payment.png" style="margin-bottom:-4px;width:30px;">&nbsp;
          PAYMENT VOUCHER<br>
        </h2>
        <!-- Control Number -->
        <span style="font-size:14px;letter-spacing:1px;"><strong>Control #: {{$voucher->voucher_code}}</strong> &nbsp; </span>
        <!-- end::Control Number -->
        <!-- Date -->
        <div style="font-size:14px;letter-spacing:1px;position: absolute;top:13.25%;right:0;"> 
          Date: {{$voucher->created_at}}
        </div>
        <!-- end::Date -->

        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
    </div>
    <!-- end::Header -->
<br>

<!-- VOUCHER DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:20%; border-bottom:1px solid black;">Payee Name:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$voucher->payee_text}}</td>
          </tr>
          <tr>
            <td align="left" style="border-bottom:1px solid black;">Address:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->address}}</td>
            <td align="left" style="width:13%; border-bottom:1px solid black;">Contact No:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->contact_no}}</td>
          </tr>
          <tr>
            <td align="left" style="border-bottom:1px solid black;">Description/Remarks:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->description}}</td>
            <td align="left" style="border-bottom:1px solid black;">Particulars:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->supply_category_name}}</td>
          </tr>
          <tr>
            <td align="left" style="border-bottom:1px solid black;">Payment Type:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->payment_type}}</td>
            <td align="left" style="border-bottom:1px solid black;">Check No:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$voucher->check_number}}</td>
          </tr>
          <tr>
            <td align="left" style="border-bottom:1px solid black;">Bank:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$voucher->bank_name}} </td>
            <td align="left" style="border-bottom:1px solid black;">Check Date:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$voucher->check_date}} </td>
          </tr>         
        </table> 
      </div>
<br>      
      <div class="col-md-12">
        <h4><b>VOUCHER DETAILS</b></h4> 
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left" width="35%">PO No.</th>
            <th align="left" width="35%">Receipt No.</th>
            <th align="left" width="35%">Receipt Type</th>
            <th align="left" width="30%">Amount (Php)</th>
          </tr>
          </thead>
          <tbody style="font-size: 12px;">
          @foreach($voucher_items as $voucher_item)
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$voucher_item->purchase_order_code}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$voucher_item->receipt_number}} </td>
            <td>#############</td>
            <td style="border-top: 1px solid #e1e1e1;"> {{number_format($voucher_item->total_item_cost_receipt,2)}} </td>
          </tr>       
          @endforeach
          @if(count($voucher_items)==0)
           <tr>
            <td align="center" colspan="4"> <br> NO RECORDS </td>
          </tr>
          @endif        
          </tbody>
        </table>
      </div>
    </div>
<!-- end::VOUCHER DETAILS -->     
<br><br>
<div class="col-md-12" style="border-bottom: 2px dotted gray;"> </div>
<br>

<!-- SIGNATORY DETAILS -->    
    <div class="row">
      <div class="col-md-12">
          <table border="0" width="100%" style="font-size:11.5px;">
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Prepared by:</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Checked by:</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Approved by:</td>
            </tr>
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr style="font-size:10px;">
              <td>______________________________________</td>
              <td></td>              
              <td>______________________________________</td>
              <td></td>
              <td>______________________________________</td>
            </tr>
            <tr style="font-size:10px;">
              <td></td>              
              <td></td>
              <td align="center" style="font-style: italic;">Accountant</td>
              <td></td>
              <td align="center" style="font-style: italic;">General Manager</td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
              <td align="left" width="20%">Date: ____________________________</td>
              <td align="left"></td>
              <td align="left" width="20%">Date: ____________________________</td>
              <td align="left"></td>
              <td align="left" width="20%">Date: ____________________________</td>
            </tr>
          </table>
<br><br>
          <table border="0" width="100%" style="font-size:12px;">
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Recorded by:</td>
              <td align="left" width="5%"></td>
              <td align="left" width="20%" style="font-weight: bold;">Audited by:</td>
              <td align="center" rowspan="6" width="3%" style="border-right: 2px dotted black;"></td>
              <td rowspan="6" width="5%"></td>
              <td align="left" style="font-weight: bold;"> Payment Received by:</td>
            </tr>
            <tr>
              <td colspan="6">&nbsp;</td>
            </tr>
            <tr style="font-size:10px;">
              <td>______________________________________</td>
              <td></td>              
              <td>______________________________________</td>
              <td>______________________________________</td> 
            </tr>
            <tr style="font-size:10px;">
              <td></td>              
              <td></td>
              <td align="center" style="font-style: italic;">Accountant</td>
              <td align="center" style="font-style: italic;">Printed Name and Signature</td>
            </tr>
            <tr>
              <td colspan="6">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">Date: __________________________</td>
              <td align="left"></td>
              <td align="left">Date: __________________________</td>
              <td align="left">Date: __________________________</td>

            </tr>
          </table>
        </div>
      </div>
<!-- end::SIGNATORY DETAILS  -->
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF PAYMENT VOUCHER</center></span>
</div>
<!-- end::footer -->

</body>
</html>
