<?php $rs_ac_settings = mysql_query("select * from mu_members where id='$_SESSION[id]' AND username='$_SESSION[username]'");
$row_ac_settings = mysql_fetch_array($rs_ac_settings);
  ?>
<div class="tabs">
        <ul class="tabNavigation">
            <li><a href="#personal_details">Personal Details</a></li>
			<li><a href="#password_details">Update Password</a></li>
        </ul>
 <div id="personal_details">
       <h3 class="titlehdr">Personal Info</h3>	  
      <p>Here you can make changes to your profile. Please note that you Username and Email are not changeable.</p>
	  <?php //while ($row_ac_settings = mysql_fetch_array($rs_ac_settings)) {?>
      <form action="mysettings.php" method="post" name="myform" id="myform">
        <table width="100%" border="0" align="center"  class="forms_acccount">
          <tr> 
            <td>Firstname</td>
            <td><input name="firstname" type="text" id="firstname" class="required" value="<?php echo $fname=$row_ac_settings['firstname']; ?>"> 
            </td>
          </tr>
          <tr> 
            <td>Lastname</td>
            <td><input name="lastname" type="text" id="lastname" class="required"  value="<?php echo $lname=$row_ac_settings['lastname']; ?>"> 
			 
            </td>
          </tr>
          <tr> 
            <td>Country</td>
            <td><input name="country" type="text" id="country" class="required" value="<?php echo $row_ac_settings['country']; ?>" ></td>
          </tr>
          <tr> 
            <td width="27%">Phone 1 </td>
            <td width="73%"><input name="phone1" type="text" id="phone1" minlength="10" maxlength="10" class="required digits" value="<?php echo $row_ac_settings['phone1']; ?>"></td>
          </tr>
          <tr> 
            <td>Phone 2 </td>
            <td><input name="phone2" type="text" id="phone2" minlength="10" maxlength="10" class="digits"value="<?php echo $row_ac_settings['phone2']; ?>"></td>
          </tr>
          <tr> 
            <td>UserName</td>
            <td><input name="user_name" type="text" disabled id="web2" value="<?php echo $row_ac_settings['username']; ?>" size="30"></td>
          </tr>
          <tr> 
            <td>Email</td>
            <td><input name="user_email" type="text" disabled id="web3"  value="<?php echo $row_ac_settings['email']; ?>" size="30">
			<?php if(checkAdmin()) { ?>
			 (Updated on  <a href="settings.php"><u>Settings &raquo;&raquo; </u></a> - as Site Email )
			<?php } ?> 
			</td>
          </tr>
        </table>
        <p align="center"> 
          <input name="doSave" type="submit" class="input_submit" id="doSave" value="Save">
        </p>
      </form>
	  <?php //} ?>
	  </div>
	  <div id="password_details">
      <h3 class="titlehdr">Change Password</h3>
      <p>If you want to change your password, please input your old and new password 
        to make changes.</p>
      <form name="pform" id="pform" method="post" action="">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3" class="forms_acccount">
          <tr> 
            <td width="31%">Old Password</td>
            <td width="69%"><input name="pwd_old" type="password" minlength="6" class="required password"  id="pwd_old"></td>
          </tr>
          <tr> 
            <td>New Password</td>
            <td><input name="pwd_new" type="password" id="pwd_new" class="required password"  ></td>
          </tr>
        </table>
        <p align="center"> 
          <input name="doUpdate" type="submit" class="input_submit" id="doUpdate" value="Update">
        </p>
      </form>
    </div>
  <?php //} ?>
	</div> 	   
     