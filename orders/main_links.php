<div class="myaccount">
<?php
if (checkClient()) { 
//We count the number of new messages the user has
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
//The number of new messages is in the variable $nb_new_pm
$nb_new_pm = $nb_new_pm['nb_new_pm'];
//We display the links
?>  
  <a href="myorders.php"> View order(s) </a><br><br>
  <a href="create.php"> Create new order &raquo;&raquo; </a><br><br>
  <a href="list_pm.php">My Messages (<?php echo $nb_new_pm; ?> unread)</a>

<?php }

//We count the number of new messages the user has
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
//The number of new messages is in the variable $nb_new_pm
$nb_new_pm = $nb_new_pm['nb_new_pm'];
//We display the links

 if (checkWriter()) { ?>  
<p><a href="list_pm.php">My Messages (<?php echo $nb_new_pm; ?> unread)</a></p>
<p><a href="new_pm.php" class="link_new_pm">Send a private message &raquo;&raquo;</a></p>
<?php }?>
 	
<?php 
if (checkAdmin()) {

?>
      <p> <a href="manage_orders.php">Admin CP </a></p>
	  <p><a href="list_pm.php">My Messages (<?php echo $nb_new_pm; ?> unread)</a></p>
      <p><a href="new_pm.php" class="link_new_pm">Create message &raquo;&raquo;</a></p>
	  <?php } ?>
      <p><a href="logout.php">Logout</a></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  </div>