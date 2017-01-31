<div style="float:right; width:auto;  display: inline;">
<?php 
$default_time_zone;
$dtz = new DateTimeZone('Africa/Nairobi');
$time_in_nai = new DateTime('now', $dtz);
$offset = $dtz->getOffset( $time_in_nai ) / 3600;
//$tnow= time() + ($offset*3600);
$date = date('m/d/Y h:i:s a', time());
$tnow= strtotime($date);


//for writer
$rs_total_expiring= mysql_query("select count(*) as total_expiring from orders WHERE Status='Cf' AND assigned_to ='$_SESSION[id]' AND ( urgency - $tnow <=2)") or die(mysql_error());
list($expiring_soon) = mysql_fetch_row($rs_total_expiring);

//list($writer_lv_row) = mysql_fetch_row(mysql_query("select writer_level from mu_members where id='$_SESSION[id]'"));

// for admin
$total_expiring= mysql_query("select count(*) as total_expiring from orders WHERE Status='Cf' AND (urgency - $tnow <=2)") or die(mysql_error());
list($currently_assigned_confirmed) = mysql_fetch_row($total_expiring);
?>


<?php if(checkClient()) {?>
<div style="width:auto; ">
<span style="font-size:12px">
<?php echo '<b>'. $today = date("D, jS M  Y"). '</b> ';?> </span>
</div>
<?php } ?>

<?php if(checkAdmin()) {?>
<div style="width:auto;">
<!--<span id="expring_soon" style="font-size:10px"><a href="assigned_confirmed.php" class="icon_clock">Submissions in < 2 hrs : (<?php if ($currently_assigned_confirmed ==0) 
  {echo '0';}else {echo $currently_assigned_confirmed ; }?>) </a> 	&nbsp;
   </span>-->
  <span style="font-size:12px">
<?php
  echo '<b>'. $today = date("D, jS M  Y"). "</b> &nbsp;&nbsp;&nbsp; All times in : <b> GMT " . ($offset < 0 ? $offset : "+".$offset) . '</b>';
?> </span>
</div>
<?php } ?>
</div>
