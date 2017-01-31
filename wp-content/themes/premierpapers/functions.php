<?php
/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-responsive.min', get_template_directory_uri().'/css/bootstrap-responsive.min.css' );
	wp_enqueue_style( 'meanmenu', get_template_directory_uri().'/css/meanmenu.css' );
	    
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/font-awesome/css/font-awesome.css' );
	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
    wp_enqueue_style( 'media-css', get_template_directory_uri().'/css/media.css' );
    
	wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/script.js', array('jquery'), true );
	wp_enqueue_script( 'jquery.meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array('jquery'), true );
	#wp_enqueue_script( 'jquery.sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

register_nav_menu( 'footer', 'Footer Menu' ); 
register_nav_menu( 'primary', 'Primary Menu' ); 

add_theme_support( 'post-thumbnails' );
#add_image_size( 'th-recent', 60, 45, true);


$function_include = dirname( __FILE__ ) . '/plugins.php' ;
if ( file_exists( $function_include) ) require_once( $function_include );  
#$options = dirname( __FILE__ ) . '/options.php' ;
#if ( file_exists( $options) ) require_once( $options );  

function word_count($string, $limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $limit));
}

function favicon4admin() {
echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('template_url') . '/images/favicon.png" />';
}
add_action( 'admin_head', 'favicon4admin' );

// Add Signature Image after single post and page
add_filter('the_content','add_signature', 1);
function add_signature($text) {
global $post;
if(($post->post_type == 'post') || ($post->post_type == 'page')) 
   $text .= '<div class="signature"> <div><a href="'.get_home_url('') . '/order"><img src="'.get_bloginfo(template_url) . '/images/findout.png" alt="find the cost of your paper" /></a></div></div>';
return $text;
}

/* widget_text plugin*/
add_filter('widget_text', 'site_widget_text', 99);

function site_widget_text($text) {
    if (strpos($text, '<' . '?') !== false) {
        ob_start();
        eval('?' . '>' . $text);
        $text = ob_get_clean();
    }
    return $text;
}



function the_breadcrumb() {
		echo '<ul id="crumbs">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo "</a></li>";
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {
				echo "</li><li>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li>';
			echo the_title();
			echo '</li>';
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
}

 

register_sidebar(array(
	'name'          => __( 'Left Sidebar' ),
	'id'            => 'left-sidebar',
	'description'   => __( 'Widgets in this area will be shown on the left-hand side.' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>' 
));
register_sidebar(array(
	'name'          => __( 'Right Sidebar' ),
	'id'            => 'right-sidebar',
	'description'   => __( 'Widgets in this area will be shown on the right-hand side.' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3 class="widgettitle">',
	'after_title'   => '</h3>' 
));
register_sidebar(array(
	'name'          => __( 'TOOL-FREE' ),
	'id'            => 'toolfree',
	'description'   => __( 'Widgets in this area will be shown on the top TOOL -FREE area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));
register_sidebar(array(
	'name'          => __( 'Live Chat' ),
	'id'            => 'livechat',
	'description'   => __( 'Widgets in this area will be shown on the livechat area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));
register_sidebar(array(
	'name'          => __( 'Copyright' ),
	'id'            => 'copyright',
	'description'   => __( 'Widgets in this area will be shown on the copyright area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));
register_sidebar(array(
	'name'          => __( 'Footer Content' ),
	'id'            => 'fcontent',
	'description'   => __( 'Widgets in this area will be shown on the Footer Content area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));
register_sidebar(array(
	'name'          => __( 'Payment' ),
	'id'            => 'payment',
	'description'   => __( 'Widgets in this area will be shown on the payment area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));
register_sidebar(array(
	'name'          => __( 'Social' ),
	'id'            => 'social',
	'description'   => __( 'Widgets in this area will be shown on the social area.' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '' 
));