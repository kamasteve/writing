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
                
                        <h2 class="thetitle">404 Error</h2>
                	<h2>Page not found!</h2>

                        <div>
                	<p>
				if you cannot find what you are looking for, the page may not be available anymore.  please try searching here:
			</p>
				<div class="searchinner"><?php get_search_form();?></div>
				</div>
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