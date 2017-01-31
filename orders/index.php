<?php 
include '../client_db_connect.php';
page_protect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Available Orders - <?php echo SITE_HOST_NAME ;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../order_styles/styles.css" rel="stylesheet" type="text/css">
<link href="../styles/blue/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="../css/qtip.css" rel="stylesheet" type="text/css">
<link href="../css/tables.css" rel="stylesheet" type="text/css">
<link href="../css/contacts.css"  rel="stylesheet" type="text/css" />
<script type="text/javascript"  src="../j_s/jquery-1.7.2.min.js"></script>
<script type="text/javascript"  src="../j_s/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    setInterval("my_function();",15000);
    function my_function(){
      jQuery('#myaccount_links').fadeOut('slow').load(location.href + ' #getfacts') .fadeIn("slow");
	  jQuery('#get_msg').fadeOut('slow').load(location.href + ' #nxtmsg') .fadeIn("slow");
	  jQuery('#expring_soon').fadeOut('slow').load(location.href + ' #expring_soon') .fadeIn("slow");
    }
</script>
<script type="text/javascript">
jQuery(function () {
    $(".get_help_info").hide();
    $(".show_hide_help_info").show();
	
	$('.show_hide_help_info').click(function(){
    $(".get_help_info").slideToggle();
    });
	
});
</script>
<script type="text/javascript">
jQuery(function () {
    $(".show_update_info").hide();
    $(".update_p_details").show();
	
	$('.show_update_info').click(function(){
    $(".update_p_details").slideToggle();
    }); 
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
<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function() {
				jQuery('#thetable').dataTable( {
					"sPaginationType": "full_numbers"
				} );
				jQuery('#thetable_c').dataTable( {
					"sPaginationType": "full_numbers"
				} );
			} );
</script>
</head>
<body>
<?php include '../header.php' ; ?>
<div id="main-content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding:5px;">
	<?php include 'access-links.php' ;  ?>  
	</td>
    <td width="89%" valign="top" style="padding:5px;">
<table width="100%" border="0">
  <tr valign="top">
    <td>
	<div  style=" float:left; width:auto;">
	<a href="#contactForm"> <span class="talktous">&raquo;Talk to Us</span></a> &nbsp;&nbsp;&nbsp;
	 </div>
<!-- <a href="#" class=" icon_info">Important!! &raquo;</a>--> <!--<?php	if(checkWriter()) { ?><a href="#" class="show_hide_help_info  icon_help">How to </a> |<span class="icon_bug"><a href="../message/">Report bugs</a></span> | <?php } ?>--> <a class="" href="#" rel="modal">&raquo; &raquo; <u>Get to Learn How it works</u></a></td>
    <td><div style="float:right;"><?php include 'gmttime.php'; ?> 
</div> </td></tr>
	<tr><td colspan="2">
<div class="get_help_info">
		<div  style=" font-size:14px;" align="left" ><span style="float:right;"><a href="#" class="show_hide_help_info">Close</a></span></br>
		</div>
</div>

<?php list($the_msg) = mysql_fetch_row(mysql_query("select site_msg from system where url ='$siteUrl'"));	
if($the_msg <> ""){ ?>
 <div class="notifier">
<?php if (checkAdmin()) { ?> <span style="float:right;  font-size:11px; width:auto;"><a href="settings.php">Edit&raquo;&raquo;</a></span> <?php } ?>
<div class="icon_info"> 
<?php
list($user_f_name) = mysql_fetch_row(mysql_query("select firstname from mu_members where id='$_SESSION[id]'"));	 ?>
Dear <strong><?php  echo ucfirst(strtolower($user_f_name)) ; ?></strong>,<br />
<span class="msg_center_demo"> <?php echo $the_msg ; ?> </span>
 </div>
 <span style="float:right;  width:auto;font-size:11px; margin-top:-25px;"><strong>~Support~</strong></span>
</div>
<?php } ?>
</td>
</tr>
<tr valign="top"><td colspan="2" align="left">
<div id="contacts_h">
<form id="contactForm" action="talkToUs.php" method="post">
<?php
$sql_get_writer = "select * from `mu_members` where `role`='writer'";
$get_writer = mysql_query($sql_get_writer) or die(mysql_error());
 ?>
  <div style="color:#333; font-size:16px;">Any question, suggestions.... Let us Know. <br />Don't get stuck.</div>
  <ul>
    <li>
      <label for="senderName">To</label>
<select name="senderTo" id="senderTo" required="required">
<option selected=""></option>
<?php if (checkAdmin()) { 
 while ($row_get_writer = mysql_fetch_array($get_writer))  { ?>
	 <option value="<?php echo $row_get_writer['email']; ?>" id="writer"> <?php echo $row_get_writer['firstname'] . ' ' .$row_get_writer['lastname']; ?></option>
          <?php }}?>
<?php if (checkClient()) { 
$sql_get_admin = "select * from `mu_members` where `role`='admin'";
$get_admin = mysql_query($sql_get_admin) or die(mysql_error());
 while ($get_admin_details = mysql_fetch_array($get_admin))  { ?>
<option value="<?php echo $get_admin_details['email']; ?>" id="support">Support </option>
<?php } }?>		  
</select>
<input type="hidden" value="<?php echo $_SESSION['username']; ?>" id="senderName" name="senderName"  />
<input type="hidden" value="<?php echo $_SESSION['email']; ?>" id="senderEmail" name="senderEmail"  />
<input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="senderID" name="senderID"  />
    </li>
    <li>
      <label for="message" style="padding-top: .5em;">Your Message</label>
      <textarea name="message" id="message" placeholder="Please type your message" required="required" cols="80" rows="10" maxlength="10000"><?php echo htmlentities($message, ENT_QUOTES, 'UTF-8'); ?></textarea>
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
</td></tr>
</table>
	<div style="width:auto; float:left; padding:5px 0;"><h3 class="titlehdr">Available Orders </h3></div> 

	<?php 
	if(checkClient()) {
	  $sql_available_by_c = "select * from orders where status='Av' and client_id='$_SESSION[id]'";
	  $rs_total_available_by_c = mysql_query($sql_available_by_c) or die(mysql_error());
	  $total_available_by_c = mysql_num_rows($rs_total_available);
	  $rs_results_available_by_c = mysql_query($sql_available_by_c) or die(mysql_error());
	  ?>
		<table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable_c">
         <thead>
		  <tr valign="top"> 
			<th> <div align="center"><strong>Order <br />No</strong></div></th>
            <th> <div align="center"><strong>Title</strong></div></th>
            <th><div align="center"><strong>Subject Area</strong></div></th>
            <th><div align="center"><strong>Academic Level</strong></div></th>
            <th><div align="center"><strong>Deadline</strong></div></th>
            <th><div align="center"><strong>Pages</strong></div></th>
            <th> <div align="center"><strong>Cost</strong></div></th>
            </tr>
		</thead>
		<tbody>	
        <!--   <?php   if ($total_available_by_c  == 0)  { ?>
          <tr>
	       <td colspan="7" nowrap><div align="center"><?php   echo 'There are no available orders yet from you';  ?></div> </td>
		  </tr>	
<?php } ?>-->		  	 
          <?php while ($rrows = mysql_fetch_array($rs_results_available_by_c)) {?>
          <tr > 
		  <?php	$theidd = base64_encode($rrows['order_no']);?>

			<td class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&assigned=<?php echo $rrows['assigned']; ?>&apl=<?php echo $rrows['applied']; ?>"><?php echo $rrows['order_no']; ?> </a>
			</div></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&assigned=<?php echo $rrows['assigned']; ?>&apl=<?php echo $rrows['applied']; ?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['academic_level']; ?></div></td>
            <td class="order_borders"><div align="center">
<?php
$time1 = $urgency = $rrows['urgency'];
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
$remaining = $days.":d, ".$hours.":h, ".$minutes.":m ";	

echo $remaining; ?>
</div></td>
            <td class="order_borders"> <div align="center">
              <?php echo $rrows['numpages']; ?>
             </div></td>
            <td class="order_borders"><div align="center"><?php echo number_format($rrows['client_cost']); ?> &nbsp; ( <?php  echo $rrows['curr'] ?>)
             </div></td>
            </tr>
          <?php    }   ?>
		 </tbody> 
        </table>
		<?php }?>
		
		
		
		<?php 
	if(checkAdmin()) {
	  $sql_available_all = "select * from orders where status='Av'";
	  $rs_total_available_all = mysql_query($sql_available_all) or die(mysql_error());
	  $total_available_all= mysql_num_rows($rs_total_available_all);
	  $rs_results_available_all = mysql_query($sql_available_all) or die(mysql_error());
	  ?>
		<table  cellpadding="0" cellspacing="0" border="0" class="display" id="thetable_c">
         <thead>
		  <tr valign="top"> 
			<th> <div align="center"><strong>Order <br />No</strong></div></th>
            <th> <div align="center"><strong>Title</strong></div></th>
            <th><div align="center"><strong>Subject Area</strong></div></th>
            <th><div align="center"><strong>Academic Level</strong></div></th>
            <th><div align="center"><strong>Deadline</strong></div></th>
            <th><div align="center"><strong>Pages</strong></div></th>
            <th> <div align="center"><strong>Cost(<?php  echo $curr_symbol ?>)</strong></div></th>
            </tr>
		</thead>
		<tbody>	
          <?php while ($rrows = mysql_fetch_array($rs_results_available_all)) {?>
          <tr > 
		  <?php	$theidd = base64_encode($rrows['order_no']);?>

			<td class="order_borders" ><div align="center"> <a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&assigned=<?php echo $rrows['assigned']; ?>&apl=<?php echo $rrows['applied']; ?>"><?php echo $rrows['order_no']; ?> </a>
			</div></td>
            <td class="order_borders"><div align="center"><a href="order-page.php?id=<?php echo $rrows['order_no'];?>&cid=<?php echo $rrows['client_id']; ?>&sts=<?php echo $rrows['status']; ?>&assigned=<?php echo $rrows['assigned']; ?>&apl=<?php echo $rrows['applied']; ?>"><?php echo $rrows['topic']; ?></a></div></td>
            <td class="order_borders"> <div align="center"><?php echo $rrows['subject_area'];?></div></td>
            <td class="order_borders"><div align="center"><?php echo $rrows['academic_level']; ?></div></td>
            <td class="order_borders"><div align="center">
<?php
$time1 = $urgency = $rrows['urgency'];
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
$remaining = $days.":d, ".$hours.":h, ".$minutes.":m ";	

echo $remaining; ?>
</div></td>
            <td class="order_borders"> <div align="center">
              <?php echo $rrows['numpages']; ?>
             </div></td>
            <td class="order_borders"><div align="center"><?php echo number_format($rrows['client_cost']); ?>
             </div></td>
            </tr>
          <?php    }   ?>
		 </tbody> 
        </table>
		<?php }?>
	</td>
  </tr>
</table>
</div>
<?php include '../footer.php'  ?>
<script  type="text/javascript">
$(document).ready(function()
{
   $('a[rel="modal"]:first').qtip(
   {
      content: {
         title: {
            text: 'So how does it work? (Summary)',
            button: 'Close'
         },
         text: 'Wondering where to start! Worry Not.<br /><br />' +
               'Simply click <font color="#004569"><b>Place Order</b> </font> on the left Navigation menu, to create a new order. Fill in details as <em><strong>required</strong></em> (Any field you wish to be included - let us know.) Note that we added <em><strong>track Id</strong></em> field to help you track your orders.<br /><br /> ' +
               'Once everything is ok, you will be taken to a preview page about your Order. There you can choose to Pay ( via Paypal ). There is also a button to cancel and create a fresh order. <br /><br />' +
			   'Immediately after payment, we get the notification. We check the details. We put your order in the available list (actually upon successful payment, your order becomes available). (Depending on writers level - they either claim directly, others bid or we auto assign....Simply leave it to us).<br><br>Sit back and relax as we deliver your order. Should there be any requirements on the order; maybe deadline extensions requests from writer, clarifications or files additions if necessary, we will notify you accordingly.<br /><br />'+
			   ' Through <font color="#004569"><b>Manage Orders</b></font> page, you can follow the progress of the your order(The status - e.g. assigned, completed, revision, approved. etc). Once done, you will get notification about the file being uploaded.<br /><br />'+
			   ' <em>Remember,</em> don\'t get stuck. Let us know of any difficulties or requirements.'
      },
      position: {
         target: $(document.body), // Position it via the document body...
         corner: 'center' // ...at the center of the viewport
      },
      show: {
         when: 'click', // Show it on click
         solo: true // And hide all other tooltips
      },
      hide: false,
      style: {
         width: { max: 600 },
         padding: '15px',
         border: {
            width: 9,
            radius: 9,
            color: '#004569'
         },
         name: 'light'
      },
      api: {
         beforeShow: function()
         {
            // Fade in the modal "blanket" using the defined show speed
            $('#qtip-blanket').fadeIn(this.options.show.effect.length);
         },
         beforeHide: function()
         {
            // Fade out the modal "blanket" using the defined hide speed
            $('#qtip-blanket').fadeOut(this.options.hide.effect.length);
         }
      }
   });
   // Create the modal backdrop on document load so all modal tooltips can use it
   $('<div id="qtip-blanket">')
      .css({
         position: 'absolute',
         top: $(document).scrollTop(), // Use document scrollTop so it's on-screen even if the window is scrolled
         left: 0,
         height: $(document).height(), // Span the full document height...
         width: '100%', // ...and full width

         opacity: 0.7, // Make it slightly transparent
         backgroundColor: 'black',
         zIndex: 5000  // Make sure the zIndex is below 6000 to keep it below tooltips!
      })
      .appendTo(document.body) // Append to the document body
      .hide(); // Hide it initially
});
</script>
<script type="text/javascript"  src="../j_s/jquery.qtip.js"></script>
</body>
</html>
