<?php
include '../client_db_connect.php'; 
 $sql_check = mysql_query("SELECT * FROM pm order by id desc");

if(isset($_POST['the_msg_content'])){
 $message  = $_POST['the_msg_content'];
 $senderID = $_POST['senderID'];
 $senderTo = $_POST['senderTo'];
 $senderEmail = $_POST['senderEmail'];
 $order_no = $_POST['o_no'];
 
//We check if the recipient exists
	$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, email, id as recipid, (select count(*) from pm) as npm from mu_members where username="'.$senderTo.'"'));
		$email_to=$dn1['email']	;			
		if($dn1['recip']==1)
	{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$senderID)
			{ 
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read, order_no)values("'.$id.'", "1", "'.$title.'", "'.$senderID.'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no", "'.$order_no.'")'))
			
				{
//THIS SENDS THE EMAIL	
$host  = $_SERVER['HTTP_HOST'];
$from_email= $senderEmail;	
$full_message	= $message . "\n

Regards,\n
".ucfirst(strtolower($senderTo))." \n
______________________________________________________

";		
@mail($email_to, "There is a reply message on order: # $order_no", $full_message,
"From: \"Order Message - ".SITE_NAME."\" <".$site_email.">\r\n" .
"X-Mailer: PHP/" . phpversion());	  

$sql_in= mysql_query("SELECT message,id FROM pm order by id desc");
$r=mysql_fetch_array($sql_in);

$msg=$r['message'];
$msg_id=$r['id'];
               }
        }
	}
}	
?>
<li class="bar<?php echo $msg_id; ?>">
<div align="left">
<span style=" padding:10px"><?php echo '<em><strong>You have sent message :</strong></em> '. $msg .' <br> <em>to </em>: <strong>'. $senderTo.'</strong> ';  ?> </span>

</div>
</li>