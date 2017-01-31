    <form action="" method="post" name="logForm" id="logForm" >
        <table width="200"  align="right" cellpadding="2" cellspacing="2" class="login-form-index">
        <tr> 
         <td colspan="3">
<?php
	  if(!empty($err))  {
	   echo "<div class=\"loginerrors\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
 ?>   </td>
        </tr>
         <tr> 
          <td>
&nbsp;Username or Email<br /><div align="center"><input name="usr_email" type="text" class="txtbox required" id="usr_email" size="16"  value="" onClick="this.value=''"></div>
		  </td>
         <td >
&nbsp;Password<br /><div align="center"><input name="pwd" type="password" class="txtbox required password" id="pwd" size="16" value="" onclick="this.value=''"></div>
		 </td>
          <td>
<div align="center"><br /><input name="doLogin" type="submit" class="submit_login_tp" id="doLogin3" value="Login"></div>
		 </td>
		</tr>
          <tr> 
            <td><!--<input name="remember" type="checkbox" id="remember" value="1">--></td>
			<td nowrap="nowrap"><div align="center"><a href="place-order/">Register</a></div></td>
			<td nowrap="nowrap"><a href="forgot.php">Forgot Password</a></td>
          </tr>
        </table>
      </form>