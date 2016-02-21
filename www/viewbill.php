<?php
error_reporting(0);
try 
{
		 // connect to SQLite from PDO database
		 $dbh = new PDO("sqlite:omelec.db");

}
catch(PDOException $e)
{
		 echo $e->getMessage();//this getMessage throws an exception if any 
	  
}
//$sql = $dbh->query("select * from register");
//$nRows = $sql->fetchColumn();
//echo $nRows;
//print_r($_POST);
//echo count($_POST['item']);
if(isset($_GET['inv']))
{
	$invnum = $_GET['inv'];
	
	$sql = $dbh->query("select * from register where invnum='$invnum'");
	$obj = $sql->fetch(PDO::FETCH_OBJ);

	$custname = $obj->custname;
	$invdate = $obj->invdate;
	$numofprod = $obj->numofprod;
	
	
	$item=$obj->item;
	$desc=$obj->desc;
	$qty=$obj->qty;
	$cost=$obj->cost;
	$vat=$obj->vat;
	$price=$obj->price;
	
	
	$subtotal = $obj->subtotal;
	$tax = $obj->tax;
	$total = $obj->total;
	$due = $obj->due;
	$rbdf = $obj->rbdf;
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
	<script type="text/javascript" src="js/inwords.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		var tot = $(".rtot").html();
		var tot = Math.floor(tot);
		var words = toWords(tot);
	    $('#inwords').html("Rs. " + words + "Only");

	});
	</script>
	<style type="text/css">
	textarea:hover,textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#fff; }
	.item-row td{min-height:100px;border:1px solid #000!important; vertical-align:middle }
	</style>
</head>

<body>
	<a href="reports.php">
    <img class="delete" src="images/goback.jpg" width="79" height="40" style="position:fixed; background:#CCC; left:0px; top:0px; border:5px solid #000;z-index:111"/>
    </a>
    <a href="javascript:window.print()" >
<img  class="delete" src="images/printButton.gif" style="position:fixed;  left:95px; top:12px; border:none  " onclick="" />
	</a>
	<div id="page-wrap">

		<div align="center" style="height:130px; border:1px solid black; font-weight:bold">
              <img id="image" src="images/logo.jpg" alt="logo" /><br />
            C/U - 12, New Durga Bazar,<br />
            Himatnagar - 383001<br />
            <br />
            Mob. No. : 8141565779 <br />
            Email Id : omelehmt@gmail.com

        </div>
		
		<h3>RETAIL INVOICE</h3>
		<div style="clear:both"></div>
        <div style="border:1px solid #000">
            <div id="customer">
                Consignee,<br />
                <textarea name="custname" tabindex="1" rows="4" style="font-size: 20px; float: left; " readonly="readonly"><?php echo $custname;?></textarea>
    
                <table id="meta">
                    <tr>
                        <td class="meta-head">Invoice #</td>
                        <td><span ><?php echo sprintf('%05d',$invnum);?></span></td>
                    </tr>
                    <tr>
    
                        <td class="meta-head">Date</td>
                        <td style="font: 14px Arial, Helvetica, sans-serif;"><?php echo $invdate;?></td>
                    </tr>
    
                </table>
            
            </div>
            
            <table id="items">
            
              <tr>
                  <th>Item</th>
                  <th>Description</th>
                  <th width="100">Quantity</th>
                  <th width="150">Rate</th>
                  <th width="100">VAT %</th>
                  <th width="100">Amount</th>
                  <th width="200">Price (with VAT)</th>
              </tr>
              <?php 
			  $item = explode("*#*",$item);
			  $desc = explode("*#*",$desc);
			  $qty = explode("*#*",$qty);
			  $cost = explode("*#*",$cost);
			  $vat = explode("*#*",$vat);
			  $price = explode("*#*",$price);
			  
			  $count=0;
			  
			  while($count<$numofprod)
			  {
				?>
              <tr class="item-row"style="font: 14px Arial, Helvetica, sans-serif;">
                  <td class="item-name" ><?php echo $item[$count];?></td>
                  <td class="description"><?php echo $desc[$count];?></td>
                  <td align="right"><?php echo sprintf('%0.2f',$qty[$count]);?></td>
                  <td align="right"><?php echo sprintf('%0.2f',$cost[$count]);?></td>
                  <td align="right"><?php echo sprintf('%0.2f',$vat[$count]);?></td>
                  <td align="right"><?php echo sprintf('%0.2f',$cost[$count]*$qty[$count]);?></td>
                  <td align="right"><?php echo sprintf('%0.2f',$price[$count]);?>&nbsp;</td>
              </tr>
			  	<?php
				$count++;
              }
			  ?>
              
              
              <tr>
                  <td colspan="3" class="blank"> </td>
                  <td colspan="3" class="total-line">Subtotal: </td>
                  <td class="total-value" align="right"><div id="subtotal"><?php echo sprintf('%0.2f',$subtotal);?></div>
                  </td>
              </tr>
              <tr>
                  <td colspan="3" class="blank"> </td>
                  <td colspan="3" class="total-line">TAX:</td>
                  <td class="total-value" align="right"><?php echo sprintf('%0.2f',$tax);?> %
                  </td>
              </tr>
              <tr>
                  <td colspan="3" class="blank"> </td>
                  <td colspan="3" class="total-line">VAT:</td>
                  <td class="total-value" align="right">
				  <?php 
				  $temp=0;
				  foreach($price as $a)
				  $temp+=$a;
				  $temp-=$subtotal;
				  echo sprintf('%0.2f',$temp);
				  
				  ?>
                  </td>
              </tr>
              <tr>
    
                  <td colspan="3" class="blank"> </td>
                  <td colspan="3" class="total-line">Total:</td>
                  <td class="total-value" align="right"><div id="total"><?php echo sprintf('%0.2f',$total);?></div></td>
              </tr>
              <tr>
                  <td colspan="3" class="blank"> </td>
                  <td colspan="3" class="total-line">Balance Due:</td>
                  <td class="total-value" align="right"><div class="due"><?php echo sprintf('%0.2f',$due);?></div></td>
              </tr>
              <tr>
                  <td colspan="3" class="total-value" id="inwords" style="text-transform:capitalize"> </td>
                  <td colspan="3" class="total-line balance">Round Total:</td>
                  <td class="total-value balance" align="right"><div class="rtot"><?php echo sprintf('%0.2f',floor($rbdf));?></div></td>
              </tr>
            
            </table>
            
            <div id="terms" style="float:left;width:53%;border:1px solid #000; min-height:156px">
              <h4 style="border-bottom: 1px solid black; text-align:left; padding:5px 7px; font-weight:normal">TIN No. : <strong>24050704200</strong>&emsp;&emsp;&emsp;&emsp;&emsp;Dt.: 06-Aug-2013</h4>
              <h5>Terms</h5>
              <div>
              2% CD if payment within 7 days Strictly.<br />
              Price can change without prior notice during the scheme.<br />
              Higher wattage 6 month guarantee. No Breakage guarantee.
              </div>
            </div>
            <div style="float:left; text-align:center;width:19%;border:1px solid #000; min-height:156px; margin:20px 0 0 0;"> 
             <span style="display:block;height:115px;"></span>
             <span>Received Signature</span>
            </div>
            <div style="float:left;width:27%;border:1px solid #000; min-height:156px; margin:20px 0 0 0;"> 

              <span style="display:block;height:25px;"></span>
              <span style="margin:10px 10px; display:block">
              For, <strong>OM ELECTRICALS</strong>
              <br />
              <br />
              <br />
              <br />
              &emsp;&nbsp;Authorized Signatory
              </span>
            </div>
		</div>
        <br />
	</div>
	
</body>

</html>