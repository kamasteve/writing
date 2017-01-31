<link href="<?php echo BASE_URL_C ?>styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo BASE_URL_C ?>wp-content/themes/premierpapers/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_URL_C ?>wp-content/themes/premierpapers/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_URL_C ?>wp-content/themes/premierpapers/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo BASE_URL_C ?>wp-content/themes/premierpapers/favicon.png" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo BASE_URL_C ?>wp-content/themes/premierpapers/favicon.png" type="image/x-icon" />
<div class="wrapp">
<span class="span2">
<div class="nxtmsg_inbox"> <?php if (isset($_SESSION['id']) ) {
$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<a href="<?php echo BASE_URL_C ?>orders/list_pm.php" class="icon_msg">(<?php echo $nb_new_pm; ?>)</a>
<?php } ?>	
  </div>
</span>
<div id="signuparea">			
<?php
if (!isset($_SESSION['id'])) 
{
 include 'insert_login.php'; 
}
else {
$sql_u_details = "select  username,firstname, lastname from mu_members where id='$_SESSION[id]' AND username='$_SESSION[username]'";
$rs_writers_dts = mysql_query($sql_u_details) or die(mysql_error());
$u_details= mysql_fetch_array($rs_writers_dts); 

 echo '<p><span class="welcome_u"> Welcome &nbsp; <a href="'.BASE_URL_C.'orders/mysettings.php" class="icon_account"> '. ucfirst(strtolower($u_details['username'])).' </a> </span><a href="'.BASE_URL_C.'orders" class="icon_stock_m"> My WorkDesk </a><a href="'.BASE_URL_C.'logout.php" class="icon_exit">Sign Out</a></p>';
 }
?>
</div>
</div>
<header class="wrapp">
        <div class="header">
            <div class="row-fluid">
                <div class="span4">
                    <div class="logo">
                        <a href="www.premierpapers.com">
         <div style="float:left; width:500px;"> <img src="/images/logo.png" height="120" width="400"  alt="logo" border="0"></a>
</div>
</div>
      </div>
         <div class="span8">
                <div style="float:right">
		<img src="/images/Contact.png" height="80" width="150 "alt="logo" "align "right"></p>
		<span class="phone-number"> <font size="4" color="#39004d"><b><i>+1(123) 456-7890</i></b></font></span><br>
		<span class="st_email"> <font size="4" color="#39004d"><b><i>Support@premierpapers.com</i></b></font></span><br>
		 </div>
		 </div>
                </div>
        </div>
        <div class="menusection">
            <div class="meanbar"></div>
            <div class="nav clearfix">
                <div class="menu-main-container"><ul id="menu-main" class="menu"><li id="menu-item-210" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-210"><a href="http://premierpapers.com/">Home</a></li>
<li id="menu-item-317" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-317"><a href="place-order/">Order Now</a></li>
<li id="menu-item-55" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-55"><a href="<?php echo BASE_URL_C ?>how-it-works/">Services</a></li>
<li id="menu-item-56" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-56"><a href="<?php echo BASE_URL_C ?>our-writers/">Dissertation Format</a></li>
<li id="menu-item-57" class="menu-item menu-item-type-post_type menu-item-object-page menu-item page_item page-item-40 current_page_item menu-item-57"><a href="<?php echo BASE_URL_C ?>privacy/">Privacy Policy</a></li>
<li id="menu-item-58" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-58"><a href="<?php echo BASE_URL_C ?>customers-testimonials/">Client Testimonials</a></li>
<li id="menu-item-59" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-59"><a href="<?php echo BASE_URL_C ?>contact-us/">Contact Us</a></li>
</ul>
</li>
</ul></div>            </div>
        </div>
    </header>