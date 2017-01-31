<?php get_header();?>
    
    <section class="main-content wrapp">
        <div class="row-fluid">
            <div class="span3">
                <div class="left-sidebar">
                    <?php  if ( is_active_sidebar( 'left-sidebar' ) ) : dynamic_sidebar( 'left-sidebar' ); endif; ?>
                </div>
            </div>
            <div class="span6">
                <div class="content clearfix">
                
              
                <?php
                if ( have_posts() ) :
                	while ( have_posts() ) : the_post();
                    ?>
                        <h2 class="posttitle"><?php the_title();?></h2>
                		<div class="the_content">
                        <?php the_content();?>
                        </div>
                	<?php
                    endwhile;
                endif;
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