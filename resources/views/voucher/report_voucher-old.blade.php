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
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12" style="font-size: 11px;">
        <p> <span style="font-size:12px;font-weight:bold;">PULSAR CONSTRUCTION<br></span> Tel No.: 844-1234 | Camasi, Penablanca 3502, Philippines</p>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/text-file.png" style="margin-bottom:-4px;width:30px;">&nbsp;PAYMENT VOUCHER<br></h2>
        <span style="font-size:16px;letter-spacing:1px;"><strong>Voucher No: {{$voucher->voucher_code}}</strong> &nbsp; </span>
        <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div>
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- VOUCHER DETAILS -->    
    <div class="row">
      <div class="col-md-12">
        Payee Name: <b>{{$voucher->payee_text}}</b> <br>
        Address: <b>{{$voucher->address}}</b> <br>
        Contact No: <b>{{$voucher->contact_no}}</b> <br>
        <!-- Email: <b>email@email.com</b> <br>                 -->
        <br>

<!-- PAYMENT DETAILS -->    
        <h4><b>VOUCHER DETAILS</b></h4> 
          <table border="1" width="100%" style="font-size:13px;border-spacing:0px;">
          <thead>
          <tr>
            <th align="left" width="35%">PO No.</th>
            <th align="left" width="35%">Receipt No.</th>
            <th align="left" width="30%">Amount (Php)</th>
          </tr>
          </thead>
          <tbody style="font-size: 12px;">
          @foreach($voucher_items as $voucher_item)
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$voucher_item->purchase_order_code}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$voucher_item->receipt_number}} </td>
            <td style="border-top: 1px solid #e1e1e1;align:right;" align="right"> {{number_format($voucher_item->total_item_cost_receipt,2)}} </td>
          </tr>       
          @endforeach
          @if(count($voucher_items)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="4"> NO RECORDS </td>
          </tr>
          @endif        
          </tbody>
        </table>
      </div>
    </div>
  <br><br>
<!-- SIGNATORY DETAILS -->    
    <div class="row">
      <div class="col-md-12">
        <hr>
          <table border="0" width="100%" style="font-size:12px;">
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Prepared by:</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Checked by:</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Approved by:</td>
              <td align="left"></td>              
            </tr>
            <tr><td colspan="6">&nbsp;</td></tr>
            <tr style="font-size:10px;">
              <td align="left">_____________________________</td>
              <td></td>              
              <td align="left">_____________________________</td>
              <td></td>
              <td align="left">_____________________________</td>
              <td></td>
            </tr>
            <tr style="font-size:10px;">
              <td></td>              
              <td></td>
              <td align="center">Accountant</td>
              <td></td>
              <td align="center">General Manager</td>
              <td></td>
            </tr>
            <tr><td colspan="4">&nbsp;</td></tr>
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Date: _________________</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Date: _________________</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Date: _________________</td>
              <td align="left"></td>              
            </tr>
          </table> <br>
        <hr>
          <table border="0" width="100%" style="font-size:12px;">
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Recorded by:</td>
              <td align="left" width="10%"></td>
              <td align="left" width="20%" style="font-weight: bold;">Audited by:</td>
              <td rowspan="6" width="5%"></td>
              <td align="center" rowspan="6" width="5%" style="border-left: 1px dotted black;"></td>
              <td align="left" rowspan="6">
                <b>Payment Received by:</b> <br><br>
                ___________________________ <br>
                <span style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Printed Name and Signature</span> <br><br><br>
                Date: _________________ <br> 
              </td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            <tr style="font-size:10px;">
              <td align="left">_____________________________</td>
              <td></td>              
              <td align="left">_____________________________</td>
              <td></td>
            </tr>
            <tr style="font-size:10px;">
              <td></td>              
              <td></td>
              <td align="center">Accountant</td>
              <td></td>
            </tr>
            <tr><td colspan="3">&nbsp;</td></tr>
            <tr>
              <td align="left" width="20%" style="font-weight: bold;">Date: _________________</td>
              <td align="left"></td>
              <td align="left" width="20%" style="font-weight: bold;">Date: _________________</td>
              <td align="left"></td>            
            </tr>
          </table> <br>
        
        </div>
      </div>  
    </div> <br>
</section>
</div>
<div style="text-align:center;">
  <span style="font-size: 10px;">*** END OF PAYMENT VOUCHER ***</span><br>
  <span style="font-size: 9.5px;">ASSETERIK&copy; V.1.0 &nbsp;&nbsp; Developed by Bizlogiks Information Technology Systems (BITS) &nbsp;&nbsp; www.bizlogiks.ph</span>
</div>
</body>
</html>
