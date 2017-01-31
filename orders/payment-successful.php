<?php 
include '../client_db_connect.php';
page_protect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<title>Payment Successful</title>
<style type="text/css">
<!--
.style3 {font-size: 18px}
-->
</style>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<div id="paypal_success">
<h1>Thank You</h1>
<p>Thank you for your payment. <br /> <br />
Your transaction has been completed, and a receipt for your purchase has been emailed to you.<br /></br>
You may log into your account at www.paypal.com to view details of this transaction.</br></br>

 Kindly note that the order is now placed in the available list. You can track it's status at <u><a href="c_manage_orders.php?qoption=all&doSearch=View" class="titlehdr style3">Manage Orders</a></u> page</p>

<p> Let us know of any requirements.</p>
</div>
</div>
<?php include '../footer.php' ; ?>
</body>
</html>
