<?php if (isset($_SESSION['id']) ) {
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];

$host  = $_SERVER['HTTP_HOST'];
?>
<li><a href="../orders/list_pm.php" class="icon_msg">
(<?php if($nb_new_pm <> 0) {?><span style="color: red; text-decoration:blink;"><?php echo $nb_new_pm .'</span>';}else{ echo $nb_new_pm;}?>)</a></li><?php } ?>	