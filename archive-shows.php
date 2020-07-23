<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$query = new WP_Query([
    'post_type' => 'shows',
    'numberposts' => -1,
    'meta_query' => [
        'relation' => 'OR',
        [
            'key' => 'show_date',
            'value' => date('Ymd', strtotime('now')),
            'compare' => '>='
        ]
    ],
	'meta_key' => 'show_date',
	'orderby' => 'meta_value_num',
    'order' => 'ASC'
]);

$events = $query->posts;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

  <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

    <div class="row">

      <!-- Do the left sidebar check -->
      <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

      <main class="site-main" id="main">

        <?php if ( count($events) > 0 ) : ?>

        <header class="entry-header">
          <?php
						echo "<h1 class='page-title'>Shows</h1>";
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
        </header><!-- .page-header -->

        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Location</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
			  
            <?php foreach($events as $event) : ?>
            <tr>
              <td><?php echo get_field('show_date', $event->ID) ?></td>
              <td><?php echo get_field('show_time', $event->ID) ?></td>
              <td><?php echo get_field('show_location', $event->ID) ?></td>
              <td><?php echo get_field('show_notes', $event->ID) ?></td>
            </tr>
            <?php endforeach; ?>

            <?php else : ?>

            <?php get_template_part( 'loop-templates/content', 'none' ); ?>

            <?php endif; ?>
          </tbody>
        </table>

      </main><!-- #main -->

      <!-- The pagination component -->
      <?php understrap_pagination(); ?>

      <!-- Do the right sidebar check -->
      <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

    </div> <!-- .row -->

  </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
