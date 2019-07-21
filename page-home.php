<?php
$logo = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
$hero = get_field('hero_section');
$about = get_field('about_section');
$shows = get_field('shows_section');
$contact = get_Field('contact_section');
$bottom = get_Field('bottom_section');
get_header();?>

<div id="hero" class="jumbotron jumbotron-fluid">
  <?php if ($hero['background']['type'] === 'video'): ?>
  <video autoplay loop muted>
    <source src="<?php echo $hero['background']['url'] ?>">
  </video>
  <?php elseif ($hero['background']['type'] === 'image'): ?>
  <img src="<?php echo $hero['background']['url'] ?>" alt="<?php echo $hero['background']['alt'] ?>" />
  <?php endif;?>
  <div class="container">
    <div class="content">
      <div>
        <h1 class="display-3"><?php echo $hero['headline'] ?></h1>
        <p class="lead"><?php echo $hero['subheadline'] ?></p>
        <?php if ($hero['button']) {?>
        <a href="<?php echo $hero['button']['url'] ?>" class="btn btn-primary btn-lg">
          <?php echo $hero['button']['title'] ?>
        </a>
        <?php }?>
      </div>
    </div>
  </div>
</div>

<section id="about-us">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h2><?php echo $about['headline'] ?></h2>
        <?php echo $about['text'] ?>
      </div>
    </div>
  </div>
</section>

<section id="shows">
  <div class="container">
    <div class="row">
      <h1>Shows</h1>
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
          <?php
$yesterday = date("F j, Y", time() - 60 * 60 * 48);
$args = array(
    'orderby' => 'date',
    'post_type' => 'shows',
    'post_count' => 10,
);
$the_query = new WP_Query($args);
?>
          <?php if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();?>
          <?php if (get_field('show_date') <= $yesterday) {?>

          <div class="col-md-3">
            <div class="card" style="width: 18rem;">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                  card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>

          <div className="column" key={i}>
            <div className="card">
              <div className="card-content">
                <h3>{feature.title}</h3>
                <div dangerouslySetInnerHTML={{
																                        __html: feature.description,
																                      }} />
                <a href={feature.link} className="button is-primary">
                  {feature.button}
                </a>
              </div>
            </div>
          </div>


          <tr>
            <td><?php echo get_field('show_date') ?></td>
            <td><?php echo get_field('show_time') ?></td>
            <td><?php echo get_field('show_location') ?></td>
            <td><?php echo get_field('show_notes') ?></td>
          </tr>
          <?php }?>
          <?php endwhile;else: ?> <p>We don't have anything booked yet. Check back soon!</p> <?php endif;?>
          <?php wp_reset_query();?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section id="contact" style="background-image:url('<?php echo $contact['bg_image'] ?>')">
  <div class="container">
    <?php
$form = $contact['form'];
$shortcode = "[contact-form-7 id='" . $form->ID . "' title='" . $form->post_title . "']";
echo do_shortcode($shortcode);
?>
  </div>
</section>

<?php get_footer();?>