<?php
//Storing Variables
$title = get_field( 'title', get_the_ID() );
$block_id = get_field( 'block_id', get_the_ID() );
$num_posts = get_field( 'num_posts', get_the_ID() );
$post_type = get_field( 'post_type', get_the_ID() );
$post_class = get_field( 'post_class', get_the_ID() );
$before_loop_layout = get_field( 'before_loop_layout', get_the_ID() );
$loop_layout_input = get_field( 'loop_layout', get_the_ID() );
$after_loop_layout = get_field( 'after_loop_layout', get_the_ID() );

//Replacing Bracecodes
require( 'whitepaper_blocks_functions.php' );
$loop_layout = whitepaper_bracecodes($loop_layout_input);

//Before The Loop
?>
<div class="row whitepaper-block" id="<?php echo $block_id ?>">
  <div class="col-md-12">
    <div class="row whitepaper-block-inner">
      <div class="col-md-12">
        <?php
        if(!empty($before_loop_layout)) {
          eval('?>'.$before_loop_layout);
        } else {
          if(!empty($title)){echo '<h2 class="module-heading">' . $title . '</h2>';}
        }

        //The Loop
        ?>
        <div class="row" id="post-area">
          <?php
          $args = array( 'post_type' => $post_type, 'posts_per_page' => $num_posts );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="<?php echo $post_class; ?>">
              <?php
                if(!empty($loop_layout)){
                  eval('?>'.$loop_layout);
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
          eval('?>'.$after_loop_layout);
        }
        ?>
      </div>
    </div>
  </div>
</div>
