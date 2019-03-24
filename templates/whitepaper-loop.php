<?php

//Replacing Handlebars
require_once __DIR__ . '/../whitepaper_blocks_functions.php';

//Storing Variables
$title = get_field( 'title' );
$block_id = get_field( 'block_id' );
$num_posts = get_field( 'num_posts' );
$post_type = get_field( 'post_type' );
$post_class = get_field( 'post_class' );
$before_loop_layout = get_field( 'before_loop_layout' );
$loop_layout_input = get_field( 'post_layout');
$after_loop_layout = get_field( 'after_loop_layout' );
$taxonomy = get_field( 'taxonomy' );
$taxonomy_term = get_field( 'taxonomy_term' );

//Before The Loop
?>
<div class="row whitepaper-block" id="<?php echo $block_id ?>">
  <div class="col-md-12">
    <div class="row whitepaper-block-inner">
      <div class="col-md-12">
        <?php
        if(!empty($before_loop_layout)) {
          eval('?>'.whitepaper_handlebars($before_loop_layout));
        } else {
          if(!empty($title)){echo '<h2 class="module-heading">' . $title . '</h2>';}
        }

        //The Loop
        ?>
        <div class="row" id="post-area">
          <?php
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
          while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="<?php echo $post_class; ?>">
              <?php
                if(!empty($loop_layout_input)){
                  eval('?>'.whitepaper_handlebars($loop_layout_input));
                } else { ?>
              <h3><?php the_title(); ?></h3>
              <?php the_content(); ?>
              <a href="<?php the_field('link'); ?>" class="btn btn-primary">Read More</a>
              <?php } ?>
            </div>
          <?php
          endwhile;
          wp_reset_postdata();
          ?>

          <div class="clear"></div>
        </div>

        <?php
        //After The Loop
        if (!empty($after_loop_layout)) {
          eval('?>'.whitepaper_handlebars($after_loop_layout));
        }
        ?>
      </div>
    </div>
  </div>
</div>
