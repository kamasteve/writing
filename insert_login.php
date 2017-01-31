<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>
		  $(document).ready(function(){
				$('#login-trigger').click(function(){
					$(this).next('#login-content').slideToggle();
					$(this).toggleClass('active');					
					
					if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
						else $(this).find('span').html('&#x25BC;')
					})
		  });
	</script>
<div id="nav">
<?php
	  if(!empty($err))  {
	   echo "<div class=\"loginerrors\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";	
	   }
 ?>   
	<ul>
		<li id="login">
			<a id="login-trigger" href="#">Log in <span>&#x25BC;</span></a>
			<div id="login-content">    
	            <form method="post" name="logForm" id="logForm">
					<fieldset id="inputs">
						<input name="usr_email" id="usr_email" type="text"  onClick="this.value=''" placeholder="username Or email" required>   
						<input id="password" type="password" name="pwd"  onClick="this.value=''" placeholder="Password" required>
					</fieldset>
					<fieldset id="actions">
						<input type="submit"  name="doLogin" id="doLogin" class="submit_login_tp_a" value="Log in">
					<label>&nbsp;&nbsp;<a href="../forgot.php">Forgot Password</a></label>
					</fieldset>
				</form>
	  </div>                     
		</li>
		<li id="signup">
			<a href="../place-order/">Register</a> 
		</li>
	</ul>
 </div>