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
		
		
		$sql = $dbh->query("select * from register ORDER BY invnum DESC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Reports</title>
	<style type="text/css">
	<!--
	@import url("style.css");
	-->
	</style>
	<script type="text/javascript">
    function funcdelete(id,name){
        var del=confirm("Are you sure you want to delete INVOICE #"+id+" of "+name+" ??");
        if(del==true)
        {
            window.location="delinvoice.php?id="+id;
            return false;
        }
    }
    </script>
<?php 		
		if(isset($_GET['action'])) {
			$mat=$_GET['action'];
			if($mat=='success')
			echo '<script type="text/javascript">alert("SUCCESSFULLY DELETED");</script>';
			
		}
?>

</head>

<body>
	<a href="index.php">
    <img class="delete" src="images/goback.jpg" width="79" height="40" style="position:fixed; background:#CCC; left:0px; top:0px; border:5px solid #000;z-index:111"/>
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
		
    <table id="box-table-a" summary="Employee Pay Sheet" align="center">
        <thead>
            <tr>
                <th scope="col">Invoice#</th>
                <th scope="col">Invoice Date</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Number Of Items</th>
                <th scope="col">Round Total</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($sql as $row)
        {
			?>
            <tr>
                <td><a href="viewbill.php?inv=<?php echo $row['invnum'];?>"><?php echo $row['invnum'];?></a></td>
                <td><a href="viewbill.php?inv=<?php echo $row['invnum'];?>"><?php echo $row['invdate'];?></a></td>
                <td><a href="viewbill.php?inv=<?php echo $row['invnum'];?>"><?php echo $row['custname'];?></a></td>
                <td><a href="viewbill.php?inv=<?php echo $row['invnum'];?>"><?php echo $row['numofprod'];?></a></td>
                <td><a href="viewbill.php?inv=<?php echo $row['invnum'];?>">Rs. <?php echo $row['rbdf'];?></a></td>
                <td><input type="button" value="Delete" onclick="return funcdelete('<?php echo $row['invnum'];?>','<?php echo $row['custname'];?>')"/></td>
            </tr>
			<?php
		}
		?>
        </tbody>
    </table>
	</div>
	
</body>

</html>