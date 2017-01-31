<?php 
include '../client_db_connect.php';
include '../top_log_in_inner.php';
if (isset($_GET['us_email']))  {
  $d_eml=$_GET['us_email']; //user id
}
?>
<html>
<head>
<title>Login - <?php echo SITE_HOST_NAME ;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<script  type="text/javascript" src="../j_s/jquery-1.7.2.min.js"></script>
<script  type="text/javascript" src="../j_s/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#logForm").validate();
  });
  </script>
</head>
<body>
<?php include ROOT_DIR_C. 'header.php'; ?> 
<?php if (!isset($_SESSION['id']) ) {?>
<div id="main-content">

      <form action="" method="post" name="logForm" id="logForm" style="width:680; float:right;" >
        <table width="650" border="0" align="right"  class="sign_in" style="padding-top:30px;">
          <tr>
            <td width="100%" valign="top">
	<?php
	  if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
	  ?>
             <span style="font-size: 30px;color:#333;font-weight: normal;">Welcome back,</span><br>
             <span style="font-size: 30px;color:#333;font-weight: bold;">Log in, please</span></td>
          </tr>
          <tr>
              <td>Username / Email<br>
                <input name="usr_email" type="text" class="required" id="txtbox" value="<?php echo $d_eml ; ?>" size="25">              </td>
          </tr>
          <tr>
                <td>Password<br>
                <input name="pwd" type="password" class="required password" id="txtbox" size="25">                </td>
          </tr>
          <tr>
            <td ><div align="center">
                <input name="remember" type="checkbox" id="remember" value="1">
                Remember me</div></td>
          </tr>
          <tr>
            <td > <div align="center" style="margin:0 auto; width:250px;"> 
               
                  <span style="float:right; "><input name="doLogin" type="submit" class="input_submit"  id="doLogin3" value="Log in">
                  </span>
                
               <span style="float:left; padding:15px 2px;">   <a href="../forgot.php"><u>Forgot Password</u></a> </span>
                
              </div></td>
          </tr>
        </table>
      </form>
</div>
<?php }else{ ?>	
<div id="main-content">
<p>&nbsp;</p>
<div align="center"> You are already signed in. Go to <a href="../orders/">Orders page</a></div>
</div>
<?php } ?>	
<?php include ROOT_DIR_C.'footer.php' ; ?>
</body>
</html>
