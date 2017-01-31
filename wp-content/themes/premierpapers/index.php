<?php get_header();?>

    <section class="banner wrapp">
        <?php layerslider(1) ?>
        <!-- <img src="<?php echo get_template_directory_uri();?>/images/slider.jpg" /> -->
    </section>
    <section class="main-content wrapp">
    <div id="main-wrapper" class="container">

<p align="Center"><b>WELCOME TO PREMIER PAPERS</b></p>
      
			<div class="container marketing">

        <div class="row widget-area" role="complementary"><div class="span4 fp-one">
          <div class="widget-front">
            <div class="thumb-wrapper "><a class="round-div" href="javascript:void(0)" title="About Us"></a><img src="https://www.premierpapers.com/images/Cap.png" class="attachment-tc-thumb tc-thumb-type-attachment wp-post-image"></div><h2>About Us</h2><p class="fp-text-one"></p><a class="btn btn-primary fp-button" href="http://http://www.premierpapers.com/about-us/" title="About Us">Read more &raquo;</a>
          </div><!-- /.widget-front -->

          </div><div class="span4 fp-two">
          <div class="widget-front">
            <div class="thumb-wrapper "><a class="round-div" href="javascript:void(0)" title="Our Policies"></a><img src="https://wp-themes.com/wp-content/themes/customizr/inc/assets/img/demo/11-270x250.jpg" class="attachment-tc-thumb tc-thumb-type-attachment wp-post-image"></div><h2>Our Policies</h2><p class="fp-text-two"></p><a class="btn btn-primary fp-button" href="http://www.premierpapers.com/our-policies/" title="Our Policies">Read more &raquo;</a>
          </div><!-- /.widget-front -->

          </div><div class="span4 fp-two">
          <div class="widget-front">
            <div class="thumb-wrapper "><a class="round-div" href="javascript:void(0)" title="Our Guarantee"></a><img src="https://wp-themes.com/wp-content/themes/customizr/inc/assets/img/demo/11-270x250.jpg" class="attachment-tc-thumb tc-thumb-type-attachment wp-post-image"></div><h2>Our Guarantee</h2><p class="fp-text-two"></p><a class="btn btn-primary fp-button" href="http://www.premierpapers.com/our-guarantee/" title="Our Guarantee">Read more &raquo;</a>
          </div><!-- /.widget-front -->

          </div></div>
			</div>
    </div>

</div>
        <div class="row-fluid">
            <div class="span3">
                <div class="left-sidebar">
                    <?php  if ( is_active_sidebar( 'left-sidebar' ) ) : dynamic_sidebar( 'left-sidebar' ); endif; ?>
                </div>
            </div>
            <div class="span6">
                <div class="content clearfix">
                
              
<?php
query_posts( 'name=home&post_type=page' );
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
endif;
wp_reset_query();
?>

                </div>
            </div>
            <div class="span3">
                <div class="right-sidebar">
                    <?php  if ( is_active_sidebar( 'right-sidebar' ) ) : dynamic_sidebar( 'right-sidebar' ); endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();?>