<div class="nxtmsg"> <?php if (isset($_SESSION['id']) ) {
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<a href="<?php echo BASE_URL_C ?>orders/list_pm.php" class="icon_msg">(<?php echo $nb_new_pm; ?>)</a>
<?php } ?>	
  </div>
 </div>
</div> 
<div id="menu-wrap">
 <div id="menu_i">
  <div id="menu">
					<ul>
						<li><a href="<?php echo BASE_URL_C ?>" >Home</a></li>
						<li><a href="<?php echo BASE_URL_C ?>place-order">Order Now</a></li>
						<li><a href="<?php echo BASE_URL_C ?>services/">Services</a></li>
						<li><a href="<?php echo BASE_URL_C ?>faq/">F.A.Qs</a></li>
	                    <li><a href="<?php echo BASE_URL_C ?>terms/">Terms</a></li>
					</ul>
  </div>
 </div>
</div>