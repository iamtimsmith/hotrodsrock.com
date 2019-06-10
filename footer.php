<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
?>
<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<section class="footer-social">
  <div class="container">
    <ul>
      <?php
    if (get_theme_mod('phone') !== '') {
      echo "<li><i class='fa fa-phone'></i> " . get_theme_mod('phone') . "</li>";
    }
    if (get_theme_mod('email') !== '') {
      echo "<li><i class='fa fa-envelope'></i> " . get_theme_mod('email') . "</li>";
    }
    ?>
    </ul>
  </div>
</section>

<div class="wrapper" id="wrapper-footer">

  <div class="<?php echo esc_attr( $container ); ?>">

    <div class="row">

      <div class="col-md-12">

        <footer class="site-footer" id="colophon">

          <div class="site-info">

            <?php echo '<p>&copy;<a href="' . get_bloginfo('url') . '">' . get_bloginfo('name') . '</a> ' . date('Y') . '. All Rights Reserved.</p>'; ?>
            <small>Site by <a href="https://www.iamtimsmith.com">Tim Smith</a></small>

          </div><!-- .site-info -->

        </footer><!-- #colophon -->

      </div>
      <!--col end -->

    </div><!-- row end -->

  </div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->
<?php wp_footer(); ?>

</body>

</html>