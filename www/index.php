<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OM Electricals</title>
<style type="text/css">
body{font-family:Arial, Helvetica, sans-serif}
#mydiv {
    position:fixed;
    top: 50%;
    left: 50%;
    width:28em;
    height:13em;
    margin-top: -6.5em; /*set to a negative number 1/2 of your height*/
    margin-left: -14em; /*set to a negative number 1/2 of your width*/
    border: 1px solid #ccc;
    background-color: #f3f3f3;
}
#mydiv input{
	position:absolute; 
}
</style>
</head>

<body>
    <div id="mydiv">
	    <center>
        <h1>WELCOME TO <br />
OM ELECTRICALS <br />Billing Software</h1>
		</center>
        <hr/>
        <input type="button" value="CREATE BILL"  style="margin:5px 20px 0 50px; width:120px" onclick="window.location='invoice.php'"/>
        <input type="button" value="REPORTS" style="margin:5px 0 0 270px; width:120px" onclick="window.location='reports.php'"/>
        <div align="right" style="position:absolute; font-size:15px; bottom:0px; left:0px; width:100%; height:20px; background:#000; color:white">
        powered by <a href="http://techzod.com" style="color:#FF3">TECHZOD</a> &nbsp;
        </div>
    </div>
</body>
</html>
