<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <?php if( get_field('page_top_image')) { ?>
  <div class="header-image">
    <img src="<?php echo get_field('page_top_image')['url']?>" alt="<?php echo get_field('page_top_image')['alt']?>" />
  </div>
  <?php } ?>

  <div class="container">
    <header class="entry-header">
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

    <div class="entry-content">

      <?php the_content(); ?>

      <?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">

      <?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

    </footer><!-- .entry-footer -->
  </div>
</article><!-- #post-## -->