<?php

//Replacing Handlebars
require_once __DIR__ . '/../whitepaper_blocks_functions.php';

//Storing Variables
$block_id = get_field( 'block_id' );
$carousel_class = get_field( 'carousel_class' );
$num_posts = get_field( 'num_posts' );
$post_type = get_field( 'post_type' );
$post_class = get_field( 'post_class' );
$carousel_layout = get_field( 'carousel_layout');
$taxonomy = get_field( 'taxonomy' );
$taxonomy_term = get_field( 'taxonomy_term' );
$carousel_indicators = get_field( 'carousel_indicators' );
$carousel_controls = get_field( 'carousel_controls' );

// Preparing the Loop
$args = array( 'post_type' => $post_type, 'posts_per_page' => $num_posts );
if(!empty($taxonomy) && !empty($taxonomy_term)) {
  $args['tax_query'] = array(
    array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $taxonomy_term,
      )
    );
}

$loop = new WP_Query( $args );
$i = 0;

?>

<div id="<?php echo $block_id ?>" class="carousel slide whitepaper-block <?php echo $carousel_class; ?>" data-ride="carousel">
  <?php if ( $carousel_indicators === true ) { ?>
    <ol class="carousel-indicators">
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <li data-target="#<?php echo $block_id ?>" data-slide-to="<?php echo $i ?>" <?php if($i===0) {?> class="active" <?php }  ?>></li>
      <?php
        $i++;
        endwhile;
        wp_reset_postdata();
      ?>
    </ol>
  <?php } ?>
  <div class="carousel-inner">
  <?php
  $i = 0;
  while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <div class="carousel-item <?php if($i===0) {?> active <?php }  ?> <?php echo $post_class; ?>">
      <?php
        if(!empty($carousel_layout)){
          eval('?>'.whitepaper_handlebars($carousel_layout));
        } else { ?>
            <img class="d-block w-100" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
      <?php } ?>
    </div>
  <?php
    $i++;
    endwhile;
    wp_reset_postdata();
  ?>
  </div>
  <?php if ( $carousel_controls === true ) { ?>
    <a class="carousel-control-prev" href="#<?php echo $block_id ?>" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#<?php echo $block_id ?>" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  <?php } ?>
</div>
