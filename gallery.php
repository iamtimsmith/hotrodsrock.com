<?php
/**
 * The template for displaying gallery pages
 *
 * Template Name: Gallery Page
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

  <div id="content" class="<?php echo $container ?>" tabindex="-1">

    <div class="row">

      <!-- Do the left sidebar check -->
      <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

      <main class="site-main" id="main">

        <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'loop-templates/content', 'page' ); ?>

        <div class="gallery-wrapper">
          <?php 
        $items = get_field('gallery');
        foreach ($items as $item) : ?>

          <a href="<?php echo $item['url'] ?>" class="swipebox">
            <img src="<?php echo $item['url'] ?>" alt="<?php echo $item['title'] ?>">
          </a>

          <?php endforeach ?>

        </div>

        <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->

      <!-- Do the right sidebar check -->
      <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

    </div><!-- .row -->

  </div><!-- #content -->

</div><!-- #page-wrapper -->

<script type="text/javascript">
;
(function($) {

  $('.swipebox').swipebox({
    useCSS: true, // false will force the use of jQuery for animations
    useSVG: true, // false to force the use of png for buttons
    initialIndexOnArray: 0, // which image index to init when a array is passed
    hideCloseButtonOnMobile: false, // true will hide the close button on mobile devices
    removeBarsOnMobile: true, // false will show top bar on mobile devices
    hideBarsDelay: 3000, // delay before hiding bars on desktop
    videoMaxWidth: 1140, // videos max width
    beforeOpen: function() {}, // called before opening
    afterOpen: null, // called after opening
    afterClose: function() {}, // called after closing
    loopAtEnd: true // true will return to the first image after the last image is reached
  });

})(jQuery);
</script>

<?php get_footer(); ?>