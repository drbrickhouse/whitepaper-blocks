<?php

//Replacing Handlebars
require_once __DIR__ . '/../whitepaper_blocks_functions.php';

//Storing Variables
$background_image = get_field( 'background_image');
$block_id = get_field( 'block_id' );
$hero_class = get_field( 'hero_class' );
$hero_overlay = get_field( 'hero_overlay' );

//Hero Layout
?>

<div class="row whitepaper-block" id="<?php echo $block_id ?>" style="background-image: url('<?php echo $background_image; ?>');">
  <div class="col-md-12">
    <div class="row whitepaper-block-inner">
      <div class="col-md-12">
        <div class="<?php echo $hero_class; ?> hero-overlay">
          <div class="col-md-12">
            <?php echo $hero_overlay; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
