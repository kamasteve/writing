<?php
include '../client_db_connect.php';
		page_protect();
        $msg=array(); 
		$err=array();
	    $uid= $_SESSION['id'];
	    $username=$_SESSION['username'];
		
	    if (isset($_GET['up_id']))  {
        $order_no=$_GET['up_id'];
//}
$sql_file_topic = "select * from orders where order_no='$order_no'";
	  $rs_file_topic = mysql_query($sql_file_topic) or die(mysql_error());
	  $row_file_topic= mysql_fetch_array($rs_file_topic);	
	//$upload_dir = '../uploads/'; // The place the files will be uploaded to (currently a 'files' directory)
	$upload_dir = $upload_download_dir;

	if (!is_dir("$upload_dir")) {
	die ("The directory <b>($upload_dir)</b> doesn't exist");
}


//check if the directory is writable.
if (!is_writeable("$upload_dir")){
        die ("The directory <b>($upload_dir)</b> is not setup properly");
}
        if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
     {
if (is_uploaded_file($_FILES['userfile']['tmp_name']))
{
 
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
		
			//	if(!get_magic_quotes_gpc())
             //   {
             //    $fileName = addslashes($fileName);
              //  }
				
							if(($fileSize) > $max_filesize)
							{
							$err[]= "<span> &times; &nbsp;</span>".'The file '.$_FILES['userfile']['name'].' is too large.';
							}
					   if (!in_array($extension, $extensions))
						 {
					$err[]="<span > &times;&nbsp;</span>".'The file format you selected is not allowed for upload. <br>  Please note that the allowed file formats are <br><br> <i>"'.$valid_extensions.'"</i>';
						 }
			//check if file exit
			$search_file = mysql_query("SELECT `id`,`file_name`,`content` FROM upload WHERE 
           `file_name`= '$fileName' " ) or die (mysql_error()); 
     		$num = mysql_num_rows($search_file);
			if ( $num > 0 )
			{ 
			$err[]="<span> &times; &nbsp;</span>"."It seems you have already uploaded this file.<br>&nbsp;&nbsp;&nbsp; Consider renaming it then upload again";
			}
				if(empty($err)) 
				{
				mysql_query("INSERT INTO upload (`file_name`, `size`, `type`, `content`,`user_id`,`username`,`upload_date`, `order_no` )
				VALUES ('$fileName', '$fileSize', '$fileType', '$content', '$uid', '$username', now(),'$order_no')") or die(mysql_error());
				
			    mysql_query ("Update orders set status='Fd'  where assigned_to ='$_SESSION[id]' and  order_no = '$order_no'") or die(mysql_error());
				
				//update bids
				
				//mysql_query("delete from `bids` where  bid_order_no ='$order_no' and  by_id = '$_SESSION[id]',  and `username`'$_SESSION[username]'") or die(mysql_error());
//send mail	
//to admin			
$host  = $_SERVER['HTTP_HOST'];
$from_email= $_SESSION['email'];
$message =  ucfirst($_SESSION[username]) . "(client) has uploaded Order No  # [$order_no].\n

Regards,\n
Support Department \n
".SITE_HOST_NAME." \n
Email: ".$site_email."
______________________________________________________

";
//to site address  ....  site_email  = support
     @mail($site_email,  "Order # [$order_no] uploaded", $message,
    "From: \"File Uploaded - ".SITE_NAME."\" <$site_email>\r\n" .
     "X-Mailer: PHP/" . phpversion());
     
//to client
$message2 = 
"
We have received the file on order # [$order_no].\n
We may request some amendments or clarifications on the same, therefore, kindly check back shortly.\n

Regards,\n
Support Department \n
".SITE_HOST_NAME." \n
Email: ".$site_email."
______________________________________________________

";
   @mail($from_email, "File on order #[$order_no] received", $message2,
   "From: \"File Received - ".SITE_NAME."\" <$site_email>\r\n" .
   "X-Mailer: PHP/" . phpversion());
//		
//								
				$target_path = $upload_dir;
				$target_path = $target_path . basename($fileName); 
if(move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path)) {
     $msg[]= "<span> &radic;&nbsp;</span>"." File <strong>$fileName</strong> &nbsp;has been uploaded successfully</strong>";						
} else{
    $err[]= "There was an error uploading the file, please try again!";
}
}				
	       }
}
 ?>
<html>
<head>  
<script type="text/javascript" language="javascript" src="../j_s/jquery-1.7.2.min.js"></script>   
<script language="JavaScript" type="text/javascript" src="../j_s/jquery.validate.js"></script>
  <script>
  $(document).ready(function(){
    $("#upload_Form").validate();
	   });
  </script>
<title><?php echo SITE_NAME; ?>  | Upload files</title> 
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {color: #FF0000}
-->
</style>
</head>
<body>
<?php include '../header.php'?>
<div id="main-content">
<form name="upload_Form" id="upload_Form" method="post" enctype="multipart/form-data">
<table width="90%" border="0" cellpadding="1" cellspacing="1" align="center" >
<tr>
<td valign="top">
<?php include 'access-links.php' ;  ?>   
</td>
<td valign="top" width="80%" style="padding:20px 0 0 30px;">
<div style=" font-size:14px; margin-bottom:25px;">
<p  style=" float:left;"><h3 class="titlehdr">Upload file(s) for Order ID <strong><?php echo $_GET['up_id']; ?></strong></h3> </p>
<p>Here you can upload files which you wish to be included in your Order(s).</p>
<p>Please note the Max file size should be<span class="uploads"> Less than 20MB.</span></p>
<p>Upload only image or document files e.g png, jpeg, pdf, doc, zip.</p>
<p>At times, the file can be renamed, other than what you propose. This is ok.</p>
<hr style="border: 1px dotted #ccc;" />
<div>Upload files for article titled : <span style="font-size:16px; color:#6633CC; font-weight:700;"> <?php echo $row_file_topic['topic']; ?></span> </div>
</div>
<input name="userfile" type="file" id="userfile" class="required">
<input name="upload" type="submit"  id="upload" value=" Upload " >
         <div id="infos">
           <?php
		   //success
             if(!empty($msg))  {
               echo "<div class=\"msg_success\">";
              foreach ($msg as $m) {
               echo "$m <br>";
                }
               echo "</div>";	
                }
         echo'<br>'; //err
             if(!empty($err))  {
               echo "<div class=\"upload_error\">";
              foreach ($err as $e) {
               echo "$e <br>";
                }
               echo "</div>";	
                }
          ?>
       </div>
</td>
</tr>
</table>
</form>
</div>
<?php 
}else{//file id set ?>
<div id="main-content">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center">Seems no Order has been set for files upload;  </p>
  <p>&nbsp;</p>
</div>
<?php } ?>	
<?php include '../footer.php' ; ?>
</body>
</html>	