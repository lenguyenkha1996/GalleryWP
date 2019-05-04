<?php
/**
 * Template part for displaying posts
 * @package WordPress
 * @subpackage vivah-royal-wedding
 * @since 1.0
 * @version 1.4
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="article_content">
      <img src="<?php the_post_thumbnail_url('full'); ?>"/>
        <div class="article-text">
          <i class="far fa-calendar-alt"></i><span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
          <h4><?php the_title();?></h4>
          <p><?php $excerpt = get_the_excerpt();echo esc_html( vivah_royal_wedding_string_limit_words( $excerpt,30 ) ); ?></p>
          <div class="row">
            <div class="col-md-6">
              <div class="metabox">
                <i class="fas fa-user"></i><span class="entry-author"><?php the_author(); ?></span>
                <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','vivah-royal-wedding'), __('0 Comments','vivah-royal-wedding'), __('% Comments','vivah-royal-wedding') ); ?></span>
          	  </div>
            </div>
            <div class="col-md-6">
              <div class="read-btn">
                <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'READ MORE', 'vivah-royal-wedding' ); ?>"><?php esc_html_e('READ MORE','vivah-royal-wedding'); ?>
                </a>
            	</div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div> 
  </div><hr class="horizontal">
</div>