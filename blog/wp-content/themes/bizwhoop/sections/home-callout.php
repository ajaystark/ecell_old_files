<?php $bizwhoop_callout_enable = get_theme_mod('bizwhoop_callout_enable');
if($bizwhoop_callout_enable)
{
$bizwhoop_callout_background = get_theme_mod('bizwhoop_callout_background');
$bizwhoop_callout_text_color = get_theme_mod('bizwhoop_callout_text_color');
$bizwhoop_callout_text_align = get_theme_mod('bizwhoop_callout_text_align','left');
$bizwhoop_callout_button_one_label = get_theme_mod('bizwhoop_callout_button_one_label','Buy Now!');
$bizwhoop_callout_button_one_link = get_theme_mod('bizwhoop_callout_button_one_link','#');
$bizwhoop_callout_button_one_target = get_theme_mod('bizwhoop_callout_button_one_target','true');
$bizwhoop_callout_button_two_label = get_theme_mod('bizwhoop_callout_button_two_label','Know More');
$bizwhoop_callout_button_two_link = get_theme_mod('bizwhoop_callout_button_two_link','#');
$bizwhoop_callout_button_two_target = get_theme_mod('bizwhoop_callout_button_two_target','true'); ?>
<style>
.ta-callout .overlay h3, .ta-callout .overlay p { color: <?php echo esc_attr($bizwhoop_callout_text_color); ?>; }
</style>
<!--==================== CALLOUT SECTION ====================-->
<?php if($bizwhoop_callout_background != '') { ?>

<section class="ta-callout" style="background-image:url('<?php echo esc_url($bizwhoop_callout_background);?>');">
<?php } else { ?>
<section class="ta-callout">
  <?php } ?>
  <div class="overlay">
    <div class="container">
      <div class="row">
        <div class="ta-callout-inner text-xs text-<?php echo $bizwhoop_callout_text_align; ?>">
          <?php $bizwhoop_callout_title = get_theme_mod('bizwhoop_callout_title',__('ready to work with <span>you</span>','bizwhoop'));
          
            if( !empty($bizwhoop_callout_title) ):

              echo '<h3 class="padding-bottom-30">'.$bizwhoop_callout_title.'</h3>';

            endif; ?>
          <?php $bizwhoop_callout_description = get_theme_mod('bizwhoop_callout_description',__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dolor tellus, egestas id elit in, vestibulum imperdiet ligula. Sed cursus velit sem, ut ultrices risus tincidunt a. Nullam id neque ipsum. Duis posuere fermentum purus, eget vehicula est accumsan maximus','bizwhoop'));

            if( !empty($bizwhoop_callout_description) ):

              echo '<p>'.$bizwhoop_callout_description.'</p>';

            endif; ?>
          <div class="padding-top-20">
          <?php if( !empty($bizwhoop_callout_button_one_label) ): ?>
      		  <a href="<?php echo $bizwhoop_callout_button_one_link; ?>" <?php if( $bizwhoop_callout_button_one_target == true) { echo "target='_blank'"; } ?> class="btn btn-theme-two margin-bottom-10">
      		<?php echo $bizwhoop_callout_button_one_label; ?></a>
      		<?php
      		endif;

          if( !empty($bizwhoop_callout_button_two_label) ): ?>
      		  <a href="<?php echo $bizwhoop_callout_button_two_link; ?>" <?php if( $bizwhoop_callout_button_two_target ==true) { echo "target='_blank'"; } ?> class="btn btn-theme margin-bottom-10"><?php echo $bizwhoop_callout_button_two_label; ?></a>
    		<?php endif; ?>	
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
