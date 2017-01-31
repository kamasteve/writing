<?php
include '../client_db_connect.php';
page_protect();
$msg = array();
$nofile = array();
include 'outputs.php';

$uid= $_SESSION['id'];
$username=$_SESSION['username'];

foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
if (isset($_GET['theidd']))  {
  $encoded_order_no=$_GET['theidd']; // Encoded order No
}

if (isset($_GET['id']))  {
  $c_id=$_GET['id']; //order No
  $_SESSION['orderno'] = $_GET['id'];

}
if (isset($_GET['cid']))  {
  $cid=$_GET['cid']; //client id
}
if (isset($_GET['sts']))  {
  $status=$_GET['sts']; // status
}
if (isset($_GET['assigned']))  {
  $assigned=$_GET['assigned']; // is order assigned  0,1
}
if (isset($_GET['apl']))  {
  $apl=$_GET['apl']; //applied
}
if (isset($_GET['apid']))  {
  $ap_id=$_GET['apid']; // writers appliedid
}
if (isset($_GET['rr']))  {
  $rqsts=$_GET['rr']; //request reasign
}
if (isset($_GET['af']))  {
  $assigned_from=$_GET['af']; // assigned from 
}
if (isset($_GET['cf']))  {
  $confirmed=$_GET['cf']; //comfirmed
}
if (isset($_GET['Avp']))  {
  $approved=$_GET['Avp']; //Approved
}
if (isset($_GET['Edt']))  {
  $editing=$_GET['Edt']; //Revision
}
if (isset($_GET['Fd']))  {
  $completed=$_GET['Fd']; //Completed
}
if (isset($_GET['Rj']))  {
  $rejected=$_GET['Rj']; //Rejected
}
if (isset($_GET['Ds']))  {
  $rejected=$_GET['Disputed']; //Disputed
}
if (isset($_GET['Rv']))  {
  $revision=$_GET['Rv']; //Revision
}
if (isset($_GET['writer_ids']))  {
  $the_writers_id=$_GET['writer_ids']; //comfirmed
}
//client
list($uname_client) = mysql_fetch_row(mysql_query("select username from mu_members where id='$cid'"));	
$ext_request=0;

$theid= $data['writer']; 
$the_order_Id= $data['theId'];
$theWriterId= $data['theWriterId'];

 //revision for the Order  
if($_POST['doRequestRevision'] == 'Revision')		
{
$sql_writer_dt = "select email, firstname, id,username, lastname from mu_members where id='$theWriterId'";
$rs_writer_dt = mysql_query($sql_writer_dt) or die(mysql_error());
$row_writer_dt= mysql_fetch_array($rs_writer_dt); 
$toemail_w= $row_writer_dt['email'];
$fname_w= $row_writer_dt['firstname'];
$username= $row_writer_dt['username'];

mysql_query("Update `orders` set `status`='Rv' where `order_no`= '$the_order_Id' and `assigned_to`='$theWriterId'") or die(mysql_error());
mysql_query("Insert into `i_counters` ( `writer_id`,`revision`,`order_no`) values ('$theWriterId','1','$c_id')") or die(mysql_error());
$msg[] = "You have successfully placed Order $c_id on Revision. Its now on revision list. Just note that the Admin has been notified. </b> ";
$host  = $_SERVER['HTTP_HOST'];
$message = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Dear '.ucfirst($fname_w).',<br>
A revision has been requested on Order ['.$c_id.'].<br>
Please login and, Check Revision listings, review the instructions (at the orders details page)<br>
If you have any questions or requests, contact the Support or Editorial team.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.ACADEMIC_SITE_NAME.'</i></strong><br>
Email: '.$academicEmail.'
</span>
</div>
</body>
</html>
';

//to writer
    $toemail_w = $toemail_w;
    $from = "Revision Requested - ".ACADEMIC_SITE_NAME."<$academicEmail>";
    $subject = "There is revision on Order [$c_id ]"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($toemail_w, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());
	
//admin
$message2 = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">


Hello Admin,<br>
Order ['.$c_id.'] has been placed on revision by client '.$_SESSION['username'].'<br>

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.'</i></strong> <br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
//to admin
    $site_email = $site_email;
    $from = "Revision Requested - ".SITE_NAME."<$site_email>";
    $subject = "Order [$c_id] placed on revision"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($site_email, $subject, $message2, $headers.
    "X-Mailer: PHP/" . phpversion());    
}
//Approve for the order 
if($_POST['doApprove'] == 'Approve')		
{
$sql_writer_dt = "select email, firstname, id, username, lastname from mu_members where id='$theWriterId'";
$rs_writer_dt = mysql_query($sql_writer_dt) or die(mysql_error());
$row_writer_dt= mysql_fetch_array($rs_writer_dt); 
$toemail_w= $row_writer_dt['email'];
$fname_w= $row_writer_dt['firstname'];
$username= $row_writer_dt['username'];

mysql_query("Update `orders` set `status`='Apv' where `order_no`= '$the_order_Id' and `assigned_to`='$theWriterId'") or die(mysql_error());
mysql_query("Insert into `i_counters` ( `writer_id`,`approve`,`order_no`) values ('$theWriterId','1','$c_id')") or die(mysql_error());
$msg[] = "You have successfully Approved Order $c_id done by writer <b> $theWriterId. </b> ";
$host  = $_SERVER['HTTP_HOST'];
$message = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">


Dear '.ucfirst($fname_w).',<br>
Order ['.$c_id.'] has been approved. <br>
It is now under Appoved list.<br>

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.ACADEMIC_SITE_NAME.'</i></strong><br>
Email: '.$academicEmail.'
</span>
</div>
</body>
</html>
';

//to writer
    $toemail_w = $toemail_w;
    $from = "Order Approved  - ".ACADEMIC_SITE_NAME."<$academicEmail>";
    $subject = "Order [$c_id ] has been approved"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($toemail_w, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());
	 
//admin
$message2 = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">


Hello Admin,<br>
Order ['.$c_id.'] has been approved by client '.$_SESSION['username'].'

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.'</i></strong><br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
//to admin
    $site_email = $site_email;
    $from = "Order Approved - ".SITE_NAME."<$site_email>";
    $subject = "Order [$c_id] Approved"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($site_email, $subject, $message2, $headers.
    "X-Mailer: PHP/" . phpversion());  
 
} 
//Reject for the order   
if($_POST['doReject'] == 'Reject')		
{
$sql_writer_dt = "select email, firstname, id,username, lastname from mu_members where id='$theWriterId'";
$rs_writer_dt = mysql_query($sql_writer_dt) or die(mysql_error());
$row_writer_dt= mysql_fetch_array($rs_writer_dt); 
$toemail_w= $row_writer_dt['email'];
$fname_w= $row_writer_dt['firstname'];
$username= $row_writer_dt['username'];

mysql_query("Update `orders` set `status`='Rj' where `order_no`= '$the_order_Id' and `assigned_to`='$theWriterId'") or die(mysql_error());
mysql_query("Insert into `i_counters` ( `writer_id`,`reject`,`order_no`) values ('$theWriterId','1','$c_id')") or die(mysql_error());
$msg[] = "You have successfully Rejected Order $c_id for writer <b> $theWriterId. </b> ";
$host  = $_SERVER['HTTP_HOST'];
$message = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Dear '.ucfirst($fname_w).',<br>
Order ['.$c_id.'] has been rejected.<br>
It is placed under your Rejected list.<br>
If you have any questions or requests, contact the Support or Editorial team.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.ACADEMIC_SITE_NAME.'</i></strong><br>
Email: '.$academicEmail.'
</span>
</div>
</body>
</html>
';

//to writer
    $toemail_w = $toemail_w;
    $from = "Order Rejected  - ".ACADEMIC_SITE_NAME."<$academicEmail>";
    $subject = "Order [$c_id ] has been rejected"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($toemail_w, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());
	 
//admin
$message2 = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Hello Admin,<br>
Order ['.$c_id.'] has been rejected by client '.$_SESSION['username'].'

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.'</i></strong><br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
//to admin
    $site_email = $site_email;
    $from = "Order Rejected - ".SITE_NAME."<$site_email>";
    $subject = "Order [$c_id] has been rejected"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($site_email, $subject, $message2, $headers.
    "X-Mailer: PHP/" . phpversion());  	 
} 
//Dispute for the Order  
if($_POST['doDispute'] == 'Dispute')		
{
$sql_writer_dt = "select email, firstname, id,username, lastname from mu_members where id='$theWriterId'";
$rs_writer_dt = mysql_query($sql_writer_dt) or die(mysql_error());
$row_writer_dt= mysql_fetch_array($rs_writer_dt); 
$toemail_w= $row_writer_dt['email'];
$fname_w= $row_writer_dt['firstname'];
$username= $row_writer_dt['username'];

mysql_query("Update `orders` set `status`='Ds' where `order_no`= '$the_order_Id' and `assigned_to`='$theWriterId'") or die(mysql_error());
mysql_query("Insert into `i_counters` ( `writer_id`,`dispute`,`order_no`) values ('$theWriterId','1','$c_id')") or die(mysql_error());
$msg[] = "You have successfully placed Order $c_id on dispute as done by <b> $theWriterId. </b> ";
$message = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Dear '.ucfirst($fname_w).',<br>
Order ['.$c_id.'] has been placed on dispute.<br>
It is now beign placed in the Dispute list.<br>
If you have any questions or requests, contact the Support or Editorial team.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.ACADEMIC_SITE_NAME.'</i></strong><br>
Email: '.$academicEmail.'
</span>
</div>
</body>
</html>
';
//to writer
    $toemail_w = $toemail_w;
    $from = "Order Dispute  - ".ACADEMIC_SITE_NAME."<$academicEmail>";
    $subject = "Order [$c_id ] has been placed on dispute"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($toemail_w, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());

//admin
$message2 = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Hello Admin,<br>
Order  ['.$c_id.'] has been placed on dispute by client '.$_SESSION['username'].'

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.'</i></strong><br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
//to admin
    $site_email = $site_email;
    $from = "Order Dispute - ".SITE_NAME."<$site_email>";
    $subject = "Order [$c_id] has been placed on dispute"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($site_email, $subject, $message2, $headers.
    "X-Mailer: PHP/" . phpversion());  
}
if($_POST['doAdjustDeadlines'] == 'Adjust Deadline') { // adjust dealine
mysql_query("update orders set urgency='$data[theTime]' where order_no = '$c_id'");
$theDTime = date("m/d/Y h:i:s a", $data['theTime']);
$msg[] = "You have successfully adjusted Deadline for this  Order <strong> [$c_id] </strong> to <strong> $theDTime </strong> <br>";

list($assignedTo) = mysql_fetch_row(mysql_query("select assigned_to from orders where order_no='$_GET[id]'"));	
if ($assignedTo <> 0 ){
$sql_writer_dt = "select email, firstname, id, lastname from mu_members where id='$assignedTo'";
$rs_writer_dt = mysql_query($sql_writer_dt) or die(mysql_error());
$row_writer_dt= mysql_fetch_array($rs_writer_dt); 
$toemail_w= $row_writer_dt['email'];
$fname_w= $row_writer_dt['firstname'];

$message = //to writer
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Dear '.ucfirst($fname_w).',<br>
The deadline for Order ['.$c_id.'] has been adjusted to '.$theDTime.'

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.ACADEMIC_SITE_NAME.'</i></strong><br>
Email: '.$academicEmail.'
</span>
</div>
</body>
</html>
';

    $toemail_w = $toemail_w;
    $from = "Deadline Adjustment - ".ACADEMIC_SITE_NAME."<$academicEmail>";
    $subject = "Deadline Adjustment on Order [$c_id]"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
    @mail($toemail_w, $subject, $message, $headers.
    "X-Mailer: PHP/" . phpversion());

$msg[] = " Writer <strong> ".ucfirst($fname_w). "</strong> who is assigned, has been notified." ;
	} 
}

//FILES UPLOAD	
$upload_dir = $upload_download_dir;
if (!is_dir("$upload_dir")) {	die ("The directory <b>($upload_dir)</b> doesn't exist");}

if (!is_writeable("$upload_dir")){ //check if the directory is writable.
       die ("The directory <b>($upload_dir)</b> is not setup properly");
}

if(isset($_POST['doUpload']) && $_FILES['userfile']['size'] > 0)  {

if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
 
 if(isset($_FILES['userfile']['name'])) { 
 $file_Name =mysql_real_escape_string($_FILES['userfile']['name']);
 $fileName =preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '_', $file_Name);
}  
        $max_filesize= 2000000000;	
        $tmpName  = $_FILES['userfile']['tmp_name'];
        $fileSize = $_FILES['userfile']['size'];
        $fileType = $_FILES['userfile']['type'];
        
        $fp = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);

        fclose($fp);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG', '.GIF', '.JPG', '.JPEG','.doc','.DOC','.DOCX','.docx','.pdf','.zip','.txt','.gz','.rar','.rtf','.xml','.html','.ppt','.pptx','.mp3','.accdb','.db','.dbf','.mdb','.sql','.aspx','.htm','.asp','.xhtml','.7z','.zipx','.xls','.csv','.xlsx');
$valid_extensions = '.png , .gif, .jpg, .jpeg .pdf, .doc, .docx,.txt,.zip,
.rar,.rtf,.xml,.html,.ppt,.pptx,.mp3,.accdb,.db,
.dbf,.mdb,.sql,.aspx,.htm,.asp,.xhtml,.7z,.zipx,.xls,.csv,.xlsx';
        $extension = strrchr($_FILES['userfile']['name'], '.');
				
		if(($fileSize) > $max_filesize)
		{$err[]= "<span> &times; &nbsp;</span>".'The file '.$_FILES['userfile']['name'].' is too large.';}
		 if (!in_array($extension, $extensions)) {
		$err[]="<span > &times;&nbsp;</span>".'The file format you selected is not allowed for upload.  Please note that the allowed file formats are <br> <i>"'.$valid_extensions.'"</i>'; }
			//check if file exit
			$search_file = mysql_query("SELECT `id`,`file_name`,`content` FROM upload WHERE 
           `file_name`= '$fileName' " ) or die (mysql_error()); 
     		$num = mysql_num_rows($search_file);
			if ( $num > 0 )
			{ 
			$err[]="<span> &times; &nbsp;</span>"."It seems you have already uploaded this file.&nbsp; Consider renaming it then upload again";
			}
				if(empty($err)) 
				{
				mysql_query("INSERT INTO upload (`file_name`, `size`, `type`, `content`,`user_id`,`username`,`upload_date`, `order_no` )
				VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$uid', '$username', '".date("Y-m-d H:i:s")."','$c_id')") or die(mysql_error());
//send mail	
//to admin			
$from_email= $_SESSION['email'];
$message = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

Client '.ucfirst($_SESSION['username']) . ' has uploaded files for Order No ['.$c_id.']

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.' </i></strong><br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
    $to_amdin = $site_email;
    $from = "File Uploaded - ".SITE_NAME."<$site_email>";
    $subject = "Order [$c_id] uploaded"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if ($from_email <> $site_email){ // dont send to admin
//to site address / admin ....  
  @mail($to_amdin, $subject, $message, $headers.
  "X-Mailer: PHP/" . phpversion());
     
//to uploader
$message2 = 
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

We have received the file on order ['.$c_id.'] <br>
We may request some amendments or clarifications on the same, if need be.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
The Support Department, <br>
<strong><i>'.SITE_HOST_NAME.' </i></strong><br>
Email: '.$site_email.'
</span>
</div>
</body>
</html>
';
   $to_uploader = $from_email;
    $from = "File Received - ".SITE_NAME."<$site_email>";
    $subject = "File on Order [$c_id] received"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
//to uploader
@mail($to_uploader, $subject, $message2, $headers.
"X-Mailer: PHP/" . phpversion());
}
//	to client
list($email_to_client) = mysql_fetch_row(mysql_query("select email from mu_members where id='$row_file_topic[client_id]'"));	
list($site_from_name) = mysql_fetch_row(mysql_query("select from_site from orders where order_no='$c_id'"));	
list($order_site_email) = mysql_fetch_row(mysql_query("select site_email from system where domain_name = '$site_from_name'")); 

$message3 =
'
<html>
<body>
<div style="padding:10px; line-height:22px; -moz-border-radius: 5px;-webkit-border-radius: 5px;	border-radius: 5px; color:#003366;  background:#e6efee; border:1px solid #c4de95; font-family: Corbel; font-size:14px;">

File(s) for your order  ['.$c_id.'] - uploaded.

<br><br>
<span style="color:#253350; font-weight:bold; font-size:15px;">
Regards,<br>
Support Department, <br>
<strong><i>'.$site_from_name.' </i></strong>
</span>
</div>
</body>
</html>
';

    $to_client_x = $email_to_client;
    $from = "File Uploaded - ".ucfirst($site_from_name)."<$order_site_email>";
    $subject = "Order [$c_id] uploaded"; 
    $headers  = "From: $from\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
//to client
@mail($to_client_x, $subject, $message3, $headers.
"X-Mailer: PHP/" . phpversion());
//							
				$target_path = $upload_dir;
				$target_path = $target_path . basename($fileName); 
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
     $msg[]= "<span> &radic;&nbsp;</span>"." File <strong>$fileName</strong> &nbsp;has been uploaded successfully</strong>";						
} else{
    $err[]= "There was an error uploading the file, please try again!";
   } //move_uploaded_file
   } //empty($err				
  } //is_uploaded_file
 } //post
?>	
<!doctype html>
<html lang="en">
<head>
<title>Orders Page - <?php echo SITE_HOST_NAME; ?></title>
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../css/tabs.css" rel="stylesheet" type="text/css">
<link href="../css/popbox.css" rel="stylesheet" type="text/css">
<link href="../css/collapse.css" rel="stylesheet" type="text/css">
<link href="../jquery-ui/jquery-ui.css" rel="stylesheet"/>
<link href="../css/contacts.css"  rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../j_s/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../j_s/jquery.validate.js"></script>
<script type="text/javascript"src="../j_s/jquery-ui.js"></script>
<script type="text/javascript" src="../j_s/popbox.js"></script>
<script>
$(function() {
$( "#accordion" ).accordion();
});
</script>
<script type="text/javascript" charset="utf-8">
		jQuery(function () {
			var tabContainers = jQuery('div.tabs > div');
			tabContainers.hide().filter(':first').show();
			jQuery('div.tabs ul.tabNavigation a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				jQuery('div.tabs ul.tabNavigation a').removeClass('selected');
				jQuery(this).addClass('selected');
				return false;
			}).filter(':first').click();
		});
	</script>
<script  type="text/javascript">
	function hidediv(){
		document.getElementById('doApply').style.display = "none"; 
	}
</script>
<script>
  jQuery(document).ready(function(){
	 jQuery("#Assignform").validate();
	 jQuery("#Force_Assignform").validate();
 	 jQuery("#Assignform_writers").validate();
	 jQuery("#reply-message").validate();
	 jQuery("#reply-message2").validate();
	 jQuery("#ajustdeadlines").validate();
	 jQuery("#ReAssignform").validate();
	 jQuery("#UploadFilesFrm").validate();
	 jQuery("#deadline_ext_request").validate();
	 jQuery('.popbox').popbox();  
	 
  });
</script> 
<script type="text/javascript">
var messageDelay = 10000;  // How long to display status messages (in milliseconds)
$( init );
function init() { // Initialize the form
  $('#contactForm').hide().submit( submitForm ).addClass( 'positioned' );  // 1. Fade the content out
  $('a[href="#contactForm"]').click( function() {
    $('#content').fadeTo( 'slow', .2 );
    $('#contactForm').fadeIn( 'slow', function() {
      $('#senderName').focus();
    } )
    return false;
  } );
  $('#cancel').click( function() {   // When the "Cancel" button is clicked, close the form
    $('#contactForm').fadeOut();
    $('#content').fadeTo( 'slow', 1 );
  } );  
  $('#contactForm').keydown( function( event ) { // When the "Escape" key is pressed, close the form
    if ( event.which == 27 ) {
      $('#contactForm').fadeOut();
      $('#content').fadeTo( 'slow', 1 );
    }
  } );
}
function submitForm() { // Submit the form via Ajax
  var contactForm = $(this);
  // Are all the fields filled in?
  if ( !$('#senderName').val() || !$('#senderEmail').val() || !$('#message').val() ) {
    // No; display a warning message and return to the form
    $('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
    contactForm.fadeOut().delay(messageDelay).fadeIn();
  } else {// Yes; submit the form to the PHP script via Ajax
    $('#sendingMessage').fadeIn();
    contactForm.fadeOut();

    $.ajax( {
      url: contactForm.attr( 'action' ) + "?ajax=true",
      type: contactForm.attr( 'method' ),
      data: contactForm.serialize(),
      success: submitFinished
    } );
  }
  return false; // Prevent the default form submission occurring
}
function submitFinished( response ) { // Handle the Ajax response
  response = $.trim( response );
  $('#sendingMessage').fadeOut();

  if ( response == "success" ) {
    $('#successMessage').fadeIn().delay(messageDelay).fadeOut();
    $('#senderName').val( "" );
    $('#senderEmail').val( "" );
    $('#message').val( "" );
    $('#content').delay(messageDelay+500).fadeTo( 'slow', 1 );
  } else {
    $('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
    $('#contactForm').delay(messageDelay+500).fadeIn();
  }
}
</script>
<script type="text/javascript">
$(function() {
$(".submit_this").click(function() {
    var boxval = $("#msg_content").val();
	var senderID = $("#senderID").val();
	var senderTo = $("#senderTo").val();
	var o_no = $("#o_no").val();
    var dataString = 'msg_content='+ boxval;
	//    var dataString = 'msg_content='+ boxval+'senderID='+senderID+'senderTo='+senderTo+'o_no='+o_no;
	if(boxval=='')
	{
	alert("You have not added a comment yet");
	}
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
$.ajax({
		type: "POST",
  url: "respond.php",
  data: dataString,
  cache: false,
  success: function(html){
  $("ol#update").prepend(html);
  $("ol#update li:first").slideDown("slow");
   document.getElementById('msg_content').value='';
  $("#flash").hide();
  }
 });
}
return false;
	});
});
</script>
<script type="text/javascript"><!--
function get_XmlHttp() {
  var xmlHttp = null;
  if(window.XMLHttpRequest) {		// for Forefox, IE7+, Opera, Safari, ...
    xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {	// for Internet Explorer 5 or 6
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xmlHttp;
}
function ajaxrequest(serverPage, tagID) {
  var request =  get_XmlHttp();		// call the function for the XMLHttpRequest instance
  var message_id = document.getElementById('msg_id').value;
  var senderID = document.getElementById('senderID').value;
  //var  url = serverPage+'?message_id='+document.getElementById('msg_id').value;
   var  url = serverPage+'?message_id='+message_id+'senderID='+senderID;
  request.open("GET", url, true);			// define the request
  request.send(null);		// sends data
  cache: false;
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      //document.getElementById(tagID).innerHTML = request.responseText;
	  $("#flash_reply").fadeIn(400).html('<img src="../images/tick_a.png" align="absmiddle">&nbsp;<span class="msg_success">Message marked as read...</span>');
	setTimeout( "$('#flash_reply').hide('slow');", 8000 );
    }
  }
}
// sends data to a php file, via POST, and displays the received answer
function ajaxsendcomment(php_file, tagID) {
  var sendcommets =  get_XmlHttp();		// calls the function for the XMLHttpRequest instance
  var recip = document.getElementById('recip').value;
  var o_no = document.getElementById('o_no').value;
  var mesaj = document.getElementById('mesaj').value;
  var  the_data = '&mesaj='+mesaj+'&recip='+recip+'&o_no='+o_no;
  sendcommets.open("POST", php_file, true);			// sets the request
  sendcommets.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  sendcommets.send(the_data);		// sends the request
  sendcommets.onreadystatechange = function() {
    if (sendcommets.readyState == 4) {
      document.getElementById(tagID).innerHTML = sendcommets.responseText;
    }
  }
}
--></script>
<script type="text/javascript">
jQuery(function () {
    $(".get_replybox").hide();
    $(".show_replybox").show();
	
	$('.show_replybox').click(function(){
    $(".get_replybox").slideToggle();
    });
});
</script>	
<script type="text/javascript">
function submitForm_Reply() {
var messageDelay = 5000;
$("#flash_reply").show();
	$("#flash_reply").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
				$.ajax(
				{type:'POST',
				url:'respond.php',
				data:$('#respond_to_this').serialize(),
				success: function(html){
  $("ol#update").prepend(html);
  $("ol#update li:first").slideDown("slow");
   document.getElementById('the_msg_content').value='';
   $(".get_replybox").hide('slow');
    $("#flash_reply").fadeIn(400).html('<img src="../images/tick_a.png" align="absmiddle">&nbsp;<span class="msg_success">Reply Sent successfully...</span>');
	setTimeout( "$('#flash_reply').hide('slow');", 5000 );
    }
	});
	return false;
}
		</script>
<script type="text/javascript">
function mark_msg_as_read() { //mark msg as read
				$.ajax(
				{type:'POST',
				url:'mark_as_read.php',
				data:$('#mark_as_read_form<?php echo $dn1['msgID']; ?>').serialize(),
				success: function(html){
$("ol#update").prepend(html);
$("ol#update li:first").slideDown("slow");
// consider css a button to mark as read
$("#flash_reply").fadeIn(400).html('<img src="../images/tick_a.png" align="absmiddle">&nbsp;<span class="msg_success">Message is now read...</span>');
	setTimeout( "$('#flash_reply').hide('slow');", 5000 );
    }
	});
	return false;
}
</script>		
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<table width="100%"  border="0" cellspacing="2" cellpadding="3" align="center">
  <tr valign="top">
<td  valign="top">
<?php include 'access-links.php' ;  ?>
	</td>
    <td width="89%" valign="top" style="padding: 10px;">
<table width="100%" border="0">
  <tr valign="top">
<td nowrap="nowrap"><div  style="color:#006666; font-size:22px; font-weight:bold; margin-bottom:10px;">Order # <?php echo $_GET['id']; ?></div>
	<?php if(checkAdmin()) { ?>	
	<font size="2" style="text-align:center; color:#000033; font-style:italic;"> Client : <?php echo $uname_client; ?> </font>
    <?php } ?>
</td>   
<td nowrap="nowrap" align="right">
<?php if (checkAdmin()) { ?>
<table width="100%" style="border:1px dotted #eee;">
  <tr>
<form name="ajustdeadlines" id="ajustdeadlines" method="post" action="order-page.php?id=<?php echo $_GET['id'] ; ?>&cid=<?php echo $_GET['cid'] ; ?>&sts=<?php echo $_GET['sts'] ; ?>">
    <td>Pick deadline</td>
    <td>
	<?php 
	date_default_timezone_set ("Africa/Nairobi");
	 $tstampNow = $_SERVER['REQUEST_TIME'];
	?>
	<select name="theTime" id="theTime" class="required">
	<option value="" selected=""></option>
        <option value="<?php echo  $tstampNow + 3600 ?>" >1 Hr</option>
	<option value="<?php echo  $tstampNow + 7200 ?>" >2 Hrs</option>
	<option value="<?php echo  $tstampNow + 10800 ?>" >3 Hrs</option>
	<option value="<?php echo  $tstampNow + 14400 ?>" >4 Hrs</option>
    <option value="<?php echo  $tstampNow + 18000 ?>" >5 Hrs</option>
	<option value="<?php echo  $tstampNow + 21600 ?>" >6 Hrs</option>
    <option value="<?php echo  $tstampNow + 25200 ?>" >7 Hrs</option>
	<option value="<?php echo  $tstampNow + 28800 ?>" >8 Hrs</option>
	<option value="<?php echo  $tstampNow + 32400 ?>" >9 Hrs</option>
	<option value="<?php echo  $tstampNow + 36000 ?>" >10 Hrs</option>
	<option value="<?php echo  $tstampNow + 43200 ?>" >12 Hrs</option>
	<option value="<?php echo  $tstampNow + 64800 ?>" >18 Hrs</option>
	<option value="<?php echo  $tstampNow + 86400 ?>" >24 Hrs</option>
	<option value="<?php echo  $tstampNow + 129600 ?>">36 Hrs</option>
	<option value="<?php echo  $tstampNow + 172800 ?>">48 Hrs</option>
	</select>
	</td>
	<td align="right">
<input name="doAdjustDeadlines" type="submit" class="input_submit_s" id="doAdjustDeadlines" value="Adjust Deadline">
</td>
 </form> 
   </tr>
</table>
<?php } ?>
<?php if (checkClient()) { ?>
<table width="100%" style="border:2px dotted #eee;">
<tr>
<td colspan="3">
 <div align="center">
 <?php 
			//$rows_orders['client_id']
			$the_status=$_GET['sts'];
			if($the_status=='')
			 {
			 $o_status='Pending';
			 }
			if($the_status=='Av')
			 {
			 $o_status='Available';
			 }
			 if($the_status=='Paid')
			 {
			 $o_status='Paid';
			 }
			 if($the_status=='Cf')
			 {
			 $o_status='Confirmed';
			 }
			 if($the_status=='Rv')
			 {
			 $o_status='Revision';
			 }
			 if($the_status=='Fd')
			 {
			 $o_status='Completed';
			 }
			 if($the_status=='Edt')
			 {
			 $o_status='Editing';
			 }
			 if($the_status=='Apv')
			 {
			 $o_status='Approved';
			 }
			 if($the_status=='Rj')
			 {
			 $o_status='Rejected';
			 }
			  if($the_status=='Ds')
			 {
			 $o_status='Dispute';
			 }
			 if($the_status=='Rmv')
			 {
			 $o_status='Removed';
			 }
			 if($the_status=='UnAp')
			 {
			 $o_status='Un-Approved';
			 }
			 if($the_status=='Cr')
			 {
			 $o_status='Assigned but Unconfirmed';
			 }
			 
			?>
<?php 
list($assignedto) = mysql_fetch_row(mysql_query("select assigned_to from orders where order_no='$_GET[id]'"));	
$rs_assigned_sql = "select firstname, lastname, username, id from mu_members where id='$assignedto'";
$q_assigned_to = mysql_query($rs_assigned_sql) or die(mysql_error());
$row_assigned_to= mysql_fetch_array($q_assigned_to);
$assigned_id = $row_assigned_to['id'];
$assigned_to = ucfirst($row_assigned_to['firstname']). '&nbsp;'. ucfirst($row_assigned_to['lastname']);		
$uname = $row_assigned_to['username'];
$w_id = $row_assigned_to['id'];

if ($assignedto <> 0){
echo ' Assigned to: (<font size="1" style="font-weight:800"> Writers ID: '. $w_id. '</font>) <font size="1"> &nbsp;&nbsp; Status: <b>'.$o_status.'<b></font>' ; 
?>
<?php }else{
echo ' Status: <font size="2" style="font-weight:800; font-style:italic;"> <b>Not Assigned yet </b></font>';
}
?> 
</div>
</td>
</tr>  
 </table>
<?php } //end client  ?>
<br> 

	</td>
  </tr>
</table>
<br>	
<?php 
      $sql_files = "select * from orders where order_no='$c_id'";
	  $rs_files = mysql_query($sql_files) or die(mysql_error());
	  $row= mysql_fetch_array($rs_files);
  	  $totals_rows = mysql_num_rows($rs_files);
	  ?>

<?php if(checkClient()) { ?> 
<?php if ($_GET['sts'] =='Fd') { //sta finished?>
<table width="700" border="0" align="center">
  <tr>
    <td> 
</td>
    <td>
 <div id="div_revision_approve_reject_dispute">
	<fieldset> <legend class="titles_h"> Set as  Approved or Revision or Dispute</legend>
	<form name="revision_approve_reject_dispute" id="revision_approve_reject_dispute" method="post" action="order-page.php?id=<?php echo $_GET['id'] ; ?>&cid=<?php echo $_GET['cid'] ; ?>&sts=<?php echo $_GET['sts'] ; ?>">
	 <div align="center">
	  <input type="hidden" value="<?php echo $_GET['id']; ?>" id="theId" name="theId"  />
	  <input type="hidden" value="<?php echo $_GET['writer_ids']; ?>" id="theWriterId" name="theWriterId"  />
	  <input name="doApprove" type="submit" class="input_submit" id="doApprove" value="Approve"> | 
	  <input name="doRequestRevision" type="submit" class="input_submit" id="doRequestRevision" value="Revision"> |
	  <input name="doDispute" type="submit" class="input_submit" id="doDispute" value="Dispute">		
    </div>
	</form><br><br>
		<span style="float:right; font-size:14px; line-height:25px;"> If you set as <strong>Revision</strong>, kindly upload revision comments/files on the order.<br> Email or attach necessary files onto the order.<br> Not sure what to do? Leave it at that. Get in touch with us and we shall act accordingly.</span>
	</fieldset>
</div><br>
</td>
  </tr>
</table> 
<?php
   } // end finished
  } //finished client check
?>
 <div class="clear"></div>
 <div style="width:600px; margin: 0 auto;">
<?php	
	if(!empty($err))  {
	   echo "<div class=\"error\">";
	  foreach ($err as $e) {
	    echo "* Error - $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"ord_msg\">" . $msg[0] . "</div>";
	   }
 ?>
</div>
<?php
 if(checkAdmin()) { ?> 
<span style="float:right;  width:auto;">
<div style="float:right; width:auto; display:inline; padding:8px; font-style:italic; font-weight:bold;"><a href="edit-order.php?order=<?php echo $_GET['id'];?>" class="">edit &raquo;&raquo;</a></div>
<div class="popbox">
    <a class="open" href="#"> <span class="open_link">Upload Files </span></a>
    <div class="collapse_this">
      <div class="box">
        <div class="arrow"></div>
        <div class="arrow-border"></div>
 <form id="UploadFilesFrm" name="UploadFilesFrm"  method="post" action="order-page.php?id=<?php echo $_GET['id'] ; ?>&cid=<?php echo $_GET['cid'] ; ?>&sts=<?php echo $_GET['sts'] ; ?>" enctype="multipart/form-data">
<p>Please note the Max file size should be<span class="uploads"> Less than 20MB.</span></p>
<input name="userfile" type="file" id="userfile" class="required">
<input name="doUpload" type="submit"  id="doUpload" value="Upload Files" >
 <a href="#" class="close">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  </span>
<?php } ?> 
<?php if(checkClient()) { ?>
<span style="float:right;  width:auto;">
<div class="popbox">
    <a class="open" href="#"> <span class="open_link">Upload Files </span></a>
    <div class="collapse_this">
      <div class="box">
        <div class="arrow"></div>
        <div class="arrow-border"></div>
 <form id="UploadFilesFrm" name="UploadFilesFrm"  method="post" action="order-page.php?id=<?php echo $_GET['id'] ; ?>&cid=<?php echo $_GET['cid'] ; ?>&sts=<?php echo $_GET['sts'] ; ?>" enctype="multipart/form-data">
<p>Please note the Max file size should be<span class="uploads"> Less than 20MB.</span></p>
<input name="userfile" type="file" id="userfile" class="required">
<input name="doUpload" type="submit"  id="doUpload" value="Upload Files" >
 <a href="#" class="close">Cancel</a>
        </form>
      </div>
    </div>
  </div>
 </span>
<?php } ?> 
<div class="tabs">
        <ul class="tabNavigation">
            <li><a href="#orderdetails">Order Details</a></li>
            <li><a href="#files">Files <div class="no_of_files">
			( <?php 
      $sql_files_ups = "select * from upload where order_no = '$c_id' order by upload_date DESC";
	  $rs_files_ups = mysql_query($sql_files_ups) or die(mysql_error());
  	  $t_files = mysql_num_rows($rs_files_ups); 			
      if ($t_files ==0) {echo '0';}else {echo $t_files;}?> )</div></a>&nbsp;
           </li>
	       <li><a href="#messages">Messages</a></li>
        </ul>
 <div id="orderdetails">
<table width="100%" align="center"  style="background-color: #fff; padding:0 5px;">  
    <tr><td width="19%" bgcolor="#e6efee" class="order_borders">Title: </td>
   <td><div class="order_title"><?php echo $row['topic']; ?>   </div></td>
  </tr>
    <td width="19%" bgcolor="#e6efee" class="order_borders">Paper type </td>
    <td width="72%" class="order_borders2"><div align="left"><?php echo $row['doctype'];?></div></td>
  </tr>
  <tr>
    <td width="19%" bgcolor="#e6efee" class="order_borders">Deadline</td>
<?php  
//date_default_timezone_set('Africa/Nairobi');
dateDiff($time1, $time2);	
$time1 = $row['urgency'];
$time2 = time();
$difference = $time1 - $time2;
$diffSeconds = $difference;
$days = intval($difference / 86400);
$difference = $difference % 86400;
$hours = intval($difference / 3600);
$difference = $difference % 3600;
$minutes = intval($difference / 60);
$difference = $difference % 60;
$seconds = intval($difference);
$remaining = $days." Days, ".$hours." Hrs, ".$minutes." Min";	
$remaining_days = $days.":d ";	
$remaining_hours = $days.":h ";
$remaining_mins = $days.":m ";
$end_date = date("jS M Y @ H:i:s A",$time1);
?>
    <td class="order_borders2"> <div align="left"><?php echo $end_date; ?> ...   ( <?php   
	if($days <0 || $hours <0 || $minutes <0 ) {?>
	<strong><em> Elapsed!</em> :: </strong> <span style="color: #f00; font-weight:bold;">
	<?php echo $remaining . '</span>'; }else{ ?> 
	<strong><em> Remaining </em></strong> :: <span style="color:#039; font-weight:bold;"> 
	<?php   echo $remaining .'</span>';} ?>	 ) 
    </div></td>
  </tr>
  <tr>
    <td width="19%" bgcolor="#e6efee" class="order_borders">Paper format </td>
    <td class="order_borders2"><div align="left"><?php echo $row['style'];?></div></td>
  </tr>
  <tr>
    <td width="19%" bgcolor="#e6efee" class="order_borders">Course level </td>
    <td class="order_borders2"><div align="left"><?php echo $row['academic_level'];?></div></td>
  </tr>
  <tr>
    <td width="19%" bgcolor="#e6efee" class="order_borders">Subject Area </td>
    <td class="order_borders2"><div align="left"><?php echo $row['subject_area'];?></div></td>
  </tr>
  <tr>
    <td bgcolor="#e6efee" class="order_borders"># pages </td>
    <td class="order_borders2"><div align="left">
	<?php echo $row['numpages'];?>&nbsp;&nbsp;  <font size="1"><b>( or 
	 <?php
	 if($row['o_interval']=='Single Spacing'){
	 echo $row['numpages']*275*2 . ' words Minimum)'; 
	 } 
	else if($row['o_interval'] =='Double Spacing'){
	  echo $row['numpages']*275 .' words Minimum)';
	  } 
	 ?>
	  </b></font></div></td>
  </tr>
  <tr>
    <td bgcolor="#e6efee" class="order_borders">Spacing</td>
    <td class="order_borders2"><div align="left"><?php echo $row['o_interval'];?></div></td>
  </tr>
  <tr>
    <td bgcolor="#e6efee" class="order_borders"> Cost </td>
	<td class="order_borders2"><div align="left"> <?php echo number_format($row['client_cost']);?> &nbsp; ( <?php  echo $row['curr'] ?>)</div></td>
  </tr>
  <tr>
    <td bgcolor="#e6efee" class="order_borders"># sources</td>
    <td class="order_borders2"><div align="left"><?php echo $row['numberOfSources'] ; ?></div></td>
  </tr>
  <tr>
    <td bgcolor="#e6efee" class="order_borders" valign="top">Paper Details </td>
    <td   class="order_borders3"> <div align="justify" style="height:250px; overflow:scroll; border:1px dotted #333; padding:8px; color:#4d4d4d;">  <?php echo nl2br($row['order_details']);?></div></td>
    </tr>
    </table>
  
 </div>
 <div id="files">
 <?php 
      $sql_files_download = "select * from upload where order_no = '$c_id' order by upload_date DESC";
	  $rs_files_download = mysql_query($sql_files_download) or die(mysql_error());
  	  $totals_rows_download = mysql_num_rows($rs_files_download);  
?>	
<div align="left"><strong class="titles_h"><u>Files</u></strong></div><br />    	
  <table width="100%" align="center" style="background-color: #fff;">
 <?php	if($totals_rows_download == 0)	{ //files uoloaded?> 
	<?php	echo '<tr><td colspan="5"><div align="center" style="font-size:18px; font-weight:bold;"> No files uploaded for this order, just yet </div></td></tr>'; 	}else{ ?>
<tr>	
    <td width="4%" nowrap="nowrap"><div align="left"><strong>#</strong></div></td>
	<td width="69%" nowrap="nowrap"><div align="left"><strong>File</strong></div></td>	
	<td width="5%" nowrap="nowrap"><div align="left"><strong>By</strong></div></td>
    <td width="14%" nowrap="nowrap"><div align="left"><strong>Time</strong></div></td>
	<td width="8%" nowrap="nowrap"><div align="left"><strong>Size</strong></div></td>
</tr>
 <?php while ($row_files= mysql_fetch_array($rs_files_download)) {?> 
 <?php
 $sql_files_dwld = "select * from upload where order_no='$c_id' and file_name='$row_files[file_name]'  ";
	  $rs_files_dwld = mysql_query($sql_files_dwld) or die(mysql_error());
	  $row_dwld= mysql_fetch_array($rs_files_dwld);
  	  $totals_rows_dwld = mysql_num_rows($rs_files_dwld);
?>  
  <tr>
    <td><div align="left"><li style="list-style: square; list-style-position:inside"></li></div></td>
    <td><div align="left"> 
<?php 
	$usrid = $row_dwld['user_id'];
	$rs_usr_level = "select username, firstname, role, id, email from `mu_members` where `id`='$usrid'";
	$rs_files_uploader = mysql_query($rs_usr_level) or die(mysql_error());
	$row_uploader= mysql_fetch_array($rs_files_uploader);
	$uploader = $row_uploader['role'];
	if ($uploader == 'admin'){
	$is = 'Support';
	}
	if ($uploader == 'writer'){
	$is = 'Writer ID :'.$row_uploader['id'];
	}
	if ($uploader == 'client'){
	$is = 'Client';
	}
	if ($uploader == $_SESSION['username']){
	$is = 'Me';
	}

if ($_GET['sts'] == 'Edt') {  ?>
<strong>File is being edited</strong><br>
<?php if(checkAdmin()){ ?>
<?php echo $row_files['file_name']." &nbsp; &nbsp;<a href=\"download.php?f=".$row_files['file_name']."\">Download</a><br><br>"; ?>
<?php }else{ ?>
<?php echo $row_files['file_name']." &nbsp; &nbsp;<a href=\"download.php?f=".$row_files['file_name']."\">Download</a><br><br>"; ?>
  <?php  } //end check admin?>
 <?php  } //end editing?>
 <?php if ($_GET['sts'] <> 'Edt') {  ?>
 <?php echo $row_files['file_name']." &nbsp; &nbsp;<a href=\"download.php?f=".$row_files['file_name']."\">Download</a><br><br>"; ?>
 <?php  } //not in editing?>

	</div>
    
    </td>
	<td><div align="left"><?php echo $is; ?></div></td>
    <td><div align="center"><?php echo $row_dwld['upload_date'];?></div></td>
	<td><div align="center"><?php echo $row_dwld['size']/1000 . ' kb';?></div></td>
  </tr>
  <?php  } }//end there are files uploaded?> 
    </table>
</div>	

<div id="messages"> 
<div id="contacts_h">
  <div id="content">
  <p><a href="#contactForm"> <span class="new_msg">&raquo;&raquo;Create New</span></a></p>
  </div>
<form id="contactForm" action="sendOrderMsg.php" method="post">
<?php
$sql_get_writer_client = "select * from `mu_members` where `role`='writer' or `role`='client'";
$get_writer_client = mysql_query($sql_get_writer_client) or die(mysql_error());
 ?>
  <h2>Create new Msg on this Order</h2>
  <ul>
    <li>
      <label for="senderName">To</label>
<select name="senderTo" id="senderTo" class="required">
<option selected=""></option>
<?php if (checkAdmin()) { 
 while ($row_get_writer_client = mysql_fetch_array($get_writer_client))  { ?>
	 <option value="<?php echo $row_get_writer_client['username']; ?>" id="writer"> <?php echo $row_get_writer_client['firstname'] . ' ' .$row_get_writer_client['lastname']; ?></option>
<?php }}?>
<?php if (checkClient()) { 
$sql_get_admin = "select * from `mu_members` where `role`='admin'";
$get_admin = mysql_query($sql_get_admin) or die(mysql_error());
 while ($get_admin_details = mysql_fetch_array($get_admin))  { ?>
<option value="<?php echo $get_admin_details['username']; ?>" id="support">Support </option>
<?php } }?>		  
</select>
<input type="hidden" value="<?php echo $c_id; ?>" id="o_no" name="o_no"  />
<input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="senderName" name="senderName"  />
<input type="hidden" value="<?php echo $_SESSION['email']; ?>" id="senderEmail" name="senderEmail"  />
<input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="senderID" name="senderID"  />
    </li>
    <li>
      <label for="message" style="padding-top: .5em;">Your Message</label>
      <textarea name="message" id="message" placeholder="Please type your message" class="required" cols="80" rows="10"></textarea>
    </li>
  </ul>
  <div id="formButtons">
    <input type="submit" id="sendMessage" name="sendMessage" value="Send Email" />
    <input type="button" id="cancel" name="cancel" value="Cancel" />
  </div>
</form>
<div id="sendingMessage" class="statusMessage"><p>Sending message. Please wait...</p></div>
<div id="successMessage" class="statusMessage"><p>Your Message has been sent Successfully.</p></div>
<div id="failureMessage" class="statusMessage"><p>There was a problem sending your message. Please try again.</p></div>
<div id="incompleteMessage" class="statusMessage"><p>  Refresh page and retry again.</p></div>
</div>
<?php
if(isset($_SESSION['id']))
{
$req1_get_sender = mysql_query('select m1.id as msgID, m1.user2read, m1.title, m1.timestamp, m1.order_no,m1.message, count(m2.id) as reps, mu_members.id as user_id,mu_members.role,  mu_members.email, mu_members.firstname,mu_members.lastname, mu_members.username from pm as m1, pm as m2,mu_members where  ((m1.user1="'.$_SESSION['id'].'" and m1.user1read="no" and mu_members.id=m1.user2) or (m1.user2="'.$_SESSION['id'].'" and m1.user2read="no" and mu_members.id=m1.user1)) and m1.order_no ="'.$_GET['id'].'"  and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req1 = mysql_query('select m1.id as msgID, m1.user2read, m1.title, m1.timestamp, m1.order_no,m1.message, count(m2.id) as reps, mu_members.id as user_id,mu_members.role,  mu_members.email, mu_members.firstname,mu_members.lastname, mu_members.username from pm as m1, pm as m2,mu_members where  ((m1.user1="'.$_SESSION['id'].'" and m1.user1read="no" and mu_members.id=m1.user2) or (m1.user2="'.$_SESSION['id'].'" and m1.user2read="no" and mu_members.id=m1.user1)) and m1.order_no ="'.$_GET['id'].'"  and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');

$req2 = mysql_query('select m1.id as msgID, m1.title, m1.timestamp, m1.order_no,m1.message, count(m2.id) as reps, mu_members.id as user_id,mu_members.role,  mu_members.email, mu_members.firstname,mu_members.lastname, mu_members.username from pm as m1, pm as m2,mu_members where ((m1.user1="'.$_SESSION['id'].'" and m1.user1read="yes" and mu_members.id=m1.user2) or (m1.user2="'.$_SESSION['id'].'" and m1.user2read="yes" and mu_members.id=m1.user1)) and m1.order_no ="'.$_GET['id'].'" and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
 } ?>
<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#006;">Unread  (<?php echo intval(mysql_num_rows($req1)); ?>):</p>
<div id="resp" style="font-size:20px; color:#990099; font-style:italic; padding:15px;  text-align:center;"></div>
<div align="center">
<table cellpadding="0" cellspacing="0" width="400px">
<tr>
<td>
<div style="height:7px"></div>
<div id="flash_reply" align="left"  ></div>
<ol  id="update" class="timeline"></ol>
</td>
</tr>
</table>
</div>
<div id="marked_as_read"></div>
 <div class="get_replybox">
 <p>Reply to Message</p>
 <?php
while($reply_to = mysql_fetch_array($req1_get_sender)){ 
$thesender= $reply_to['username'] ;
$senderEmail= $reply_to['email'] ;
$themsgID =$reply_to['msgID'] ;
} 
 ?>
<form id="respond_to_this" onSubmit="return submitForm_Reply();">
<input type="hidden" value="<?php echo  $thesender ; ?>" id="senderTo" name="senderTo"/>	
<input type="hidden" value="<?php echo  $senderEmail ; ?>" id="senderEmail" name="senderEmail"/>    
<input type="hidden" value="<?php echo $_GET['id']; ?>" id="o_no" name="o_no"  />
<input type="hidden" value="<?php echo $s_name= $_SESSION['username']; ?>" id="senderName" name="senderName"  />
<input type="hidden" value="<?php echo $s_id =$_SESSION['id']; ?>" id="senderID" name="senderID"  />
<textarea cols="20" rows="3" style="width:380px;font-size:14px; font-weight:bold;background:#fff; overflow:scroll;resize: none; " name="the_msg_content" id="the_msg_content" class="required" ></textarea><br />
<p><input type="submit"  value="Respond"   name="Replynow" style=" float:right; margin-top: -70px; margin-right:10px; padding:5px; width:100px;" /><p>
</form>
<div class="close_link"><a   href="#" class="show_replybox" title="Cancel"></a></div>
	</div> <!-- //comment box ends-->
<div id="accordion">	
<?php
while($dn1 = mysql_fetch_array($req1)){ ?>
<form id="<?php echo $dn1['msgID']; ?>">
<h3 style="cursor:pointer;" onClick="ajaxrequest('mark_as_read.php', 'context')">Expand &raquo;&raquo;</h3>
<input type="hidden" value="<?php echo $dn1['msgID']; ?>" id="msg_id" name="msg_id"  />
<input type="hidden" value="<?php echo $s_id =$_SESSION['id']; ?>" id="senderID" name="senderID"/>
</form>
<div>
<p><?php
$html = preg_replace('/(<\/[^>]+?>)(<[^>\/][^>]*?>)/', '$1 $2', $dn1['message']);
$html = strip_tags($html);
 echo '<i><strong>Message:</strong> </i> '.nl2br($html); ?></p>
<p><i><strong>From:</strong> </i> <?php // echo $sender1= ucfirst(strtolower($dn1['firstname'])); ?> <font size="1" style="font-weight:bold;">(
<?php
 
  echo $dn1['role'] ?> )</font>
  
<p><?php echo '<i><strong>@:</strong> </i> '.date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></p>
<p> <span class="reply_to_msg"><a href="#" class="show_replybox">Reply &raquo;&raquo;</a></span>  <span class="marked_as_read" onClick="ajaxrequest('mark_as_read.php', 'marked_as_read')"> Mark as Read &raquo;&raquo; </span></p>
</div>		<!-- //Accordion message ends-->  
<?php } ?>
</div> <!-- //ACCORDION ends-->
<br>
<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:006;"> Read / Sent Messages (<?php echo intval(mysql_num_rows($req2)); ?>):</p><br>
<?php while($dn2 = mysql_fetch_array($req2)){?>
<div class="col c1">
<h3><?php echo nl2br(ShortenText($dn2['message'], ENT_QUOTES, 'UTF-8')); ?></h3>
<div>
<p><?php
$html = preg_replace('/(<\/[^>]+?>)(<[^>\/][^>]*?>)/', '$1 $2', $dn2['message']);
$html = strip_tags($html);
 echo '<i><strong>Message:</strong> </i> '.nl2br($html); ?></p>
<p><i><strong></strong> </i>
<font size="1" style="font-weight:bold;">(
 <?php

  echo $dn2['role']  ?>)</font>
</p>
<p><?php echo '<i><strong>@:</strong> </i> '.date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></p>
<p><a href="#" class="show_replybox reply_to_msg" >Reply &raquo;&raquo;</a></p>
</div>	
</div><!--col c1-->
<?php } ?>
 </div> <!--Messages tab-->
</div> <!--tabs -->
</td>
</tr>
</table>
</div>
<div class="clear"></div>
<?php include '../footer.php' ; ?>
</body>
</html>