<?php
/**
 * The header for our theme
 *
 * @package WordPress
 * @subpackage vivah-royal-wedding
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="<?php echo esc_url( __( 'http://gmpg.org/xfn/11', 'vivah-royal-wedding' ) ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header">
	<div class="toggle"><a class="toggleMenu" href="#"><?php esc_html_e('Menu','vivah-royal-wedding'); ?></a></div>    
    <div class="menu-section">
		<div class="container">
			<div class="main-top">
				<div class="row padd0">
					<div class="col-md-3">
						<div class="logo">
					        <?php if( has_custom_logo() ){ vivah_royal_wedding_the_custom_logo();
					           }else{ ?>
					          <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					          <?php $description = get_bloginfo( 'description', 'display' );
					          if ( $description || is_customize_preview() ) : ?> 
					            <p class="site-description"><?php echo esc_html($description); ?></p>       
					        <?php endif; }?>
					    </div>
					</div>
					<div class="nav col-md-9">
						<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
					</div>			
			     	<div class="clearfix"></div>   
				</div>	
			</div>
		</div>
	</div>
</div>