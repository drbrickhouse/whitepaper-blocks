<?php

//Replacing Handlebars
require_once __DIR__ . '/../whitepaper-blocks-functions.php';

//Storing Variables
$block_id = $attributes['blockId'];
$carousel_class = $attributes['carouselClasses'];
$post_type = $attributes['postType'];
$num_posts = $attributes['numPosts'];
$post_class = $attributes['postClasses'];
$carousel_layout = $attributes['carouselLayout'];
$carousel_indicators = $attributes['carouselIndicators'];
$carousel_controls = $attributes['carouselControls'];
$taxonomy = $attributes['taxonomy'];
$taxonomy_term = $attributes['taxonomyTerm'];
$block_class = $attributes['className'];

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

<div <?php if(!empty($block_id)){ ?> id="<?php echo $block_id ?>" <?php } ?> class="wp-block-whitepaper-blocks-carousel-block carousel slide <?php echo $block_class; if(!empty($carousel_class)){ echo ' '.$carousel_class; } ?>" data-ride="carousel">
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
    <div class="carousel-item <?php if($i===0) { echo ' active'; } if(!empty($post_class)){ echo ' '.$post_class; } ?>">
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
