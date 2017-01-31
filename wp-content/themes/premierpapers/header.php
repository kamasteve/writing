<!DOCTYPE HTML>
<html>
<head>
<meta name="msvalidate.01" content="A349F85441F54B28D01F5C3565BB8F92" />
<meta name="fl-verify" content="a7d4a515fe6e408ec09525a5c2219b5b">
<meta name="google-site-verification" content="Y9I9jNlEEarAeLNGEF0hbSDlWcnpNMwNESoYXzKoQBY" />
	<meta http-equiv="content-type" content="text/html" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
	<meta name="description" content="<?php if ( is_single() ) {
        single_post_title('', true); 
    } else {
        bloginfo('name'); echo " - "; bloginfo('description');
    }
    ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="icon" href="<?php bloginfo('template_url');?>/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/custom.css" type="text/css"/>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<style type="text/css">
.gradient {
   filter: none;
}
</style>
<![endif]-->

<?php wp_head();?>

 <header class="wrapp">
        <div class="header">
            <div class="row-fluid">
                <div class="span4">
                    <div class="logo">
                        <a href="www.premierpapers.com">
         <div style="float:left; width:500px;"> <img src="/images/logo.png" height="120" width="450"  alt="logo" border="0"></a>
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
                <?php wp_nav_menu(array('theme_location'=>'primary'));?>
            </div>
        </div>
    </header>