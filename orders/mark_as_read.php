<?php 
include '../client_db_connect.php';  
//mark as read
// if data are received via GET, with index of 'message_id'
if (isset($_GET['message_id'])){
    $msg_id = $_GET['message_id'];   
	$senderID = $_GET['senderID'];         // get data

$req1 = mysql_query('select * from pm where id="'.$msg_id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
//We check if the discussion exists
if(mysql_num_rows($req1)==1)
{
//We check if the user have the right to read this discussion
//if($dn1['user1']==$senderID or $dn1['user2']==$senderID)
//  {
//The discussion will be placed in read messages
     if($dn1['user1']==$senderID)
     {
	   mysql_query('update pm set user1read="yes" where id="'.$msg_id.'" and id2="1"');
	  $user_partic = 2;
     }
     else
     {
	 mysql_query('update pm set user2read="yes" where id="'.$msg_id.'" and id2="1"');
	 $user_partic = 1;
     }
  //}
}
}
echo 'Message marked as read.';
?>