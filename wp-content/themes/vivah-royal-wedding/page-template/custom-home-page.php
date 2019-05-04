<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<?php do_action( 'vivah_royal_wedding_above_banner' ); ?>

<section id="banner">
  	<?php $pages = array();
      	for ( $count = 0; $count <= 0; $count++ ) {
	        $mod = absint( get_theme_mod( 'vivah_royal_wedding_page_settings' . $count ));
	        if ( 'page-none-selected' != $mod ) {
	          $pages[] = $mod;
	        }
      	}
      	if( !empty($pages) ) :
	        $args = array(
	          'post_type' => 'page',
	          'post__in' => $pages,
	          'orderby' => 'post__in'
	        );
    	$query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          	$count = 0;
          	while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="box-image">
                  	<a href="<?php echo esc_url( get_permalink() );?>"><img src="<?php the_post_thumbnail_url('full'); ?>"/></a>
                </div>
              	<div class="box-content">
                	<a href="<?php echo esc_url( get_permalink() );?>"><h2><?php the_title(); ?></h2></a>
                </div>
            <?php $count++; endwhile; ?>
      	<?php else : ?>
        	<div class="no-postfound"></div>
        <?php endif;
  	endif; wp_reset_postdata();?>
</section>

<?php do_action('vivah_royal_wedding_below_banner'); ?>

<?php /*--Bride and Groom--*/?>
<section id="bride-groom">
    <div class="container">
    	<?php if( get_theme_mod( 'vivah_royal_wedding_section_title','' ) != '') { ?>
			<h3><?php echo esc_html( get_theme_mod('vivah_royal_wedding_section_title',__('Bride & Groom','vivah-royal-wedding')) ); ?></h3>
			<hr>
	    <?php } ?>
    	<div class="row">
	    	<?php $pages = array();
	    	for ( $count = 0; $count <= 1; $count++ ) {
		      	$mod = intval( get_theme_mod( 'vivah_royal_wedding_services' . $count ));
		     	if ( 'page-none-selected' != $mod ) {
		        	$pages[] = $mod;
		      	}
	    	}
	    	if( !empty($pages) ) :
	      	$args = array(
	        	'post_type' => 'page',
	        	'post__in' => $pages,
	        	'orderby' => 'post__in'
	      	);
	      	$query = new WP_Query( $args );
	     	if ( $query->have_posts() ) :
	        $count = 0;
	        while ( $query->have_posts() ) : $query->the_post(); ?>        	
	          	<div class="col-md-6 col-sm-6">
	          		 <div class="service-image text-center">
	                	<img src="<?php the_post_thumbnail_url('full'); ?>"/>	
	                </div>		                           
	                <div class="content">
	                	<a href="<?php echo esc_url( get_permalink() );?>"><h4><?php the_title(); ?></h4></a>  
	                    <p><?php $excerpt = get_the_excerpt(); echo esc_html( vivah_royal_wedding_string_limit_words( $excerpt,15 ) ); ?></p>
	                    <div class="clearfix"></div>
	                </div>		           
	          	</div>
	        <?php $count++; endwhile; 
	        wp_reset_postdata();?>
	      	<?php else : ?>
	          	<div class="no-postfound"></div>
	      	<?php endif;
	    	endif;?>
      		<div class="clearfix"></div>
      	</div>
 	</div> 
</section>

<?php do_action('vivah_royal_wedding_after_bride_groom_section'); ?>

<div class="container">
  	<?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>