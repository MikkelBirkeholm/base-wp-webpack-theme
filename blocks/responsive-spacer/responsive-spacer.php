<?php
/**
 * Block: Responsive Spacer
 */
$mobileHeight = get_field('responsive_spacer_mobile_height');
$tabletHeight = get_field('responsive_spacer_tablet_height');
$desktopHeight = get_field('responsive_spacer_desktop_height');
$id = $block['id'];
$classes = '';    

    if($block['align']) {
      $classes .= ' align' . $block['align'];
    }
?>
<div aria-hidden="true" class="responsive-spacer"
    style="--mobile-height: <?= $mobileHeight ?>px; --tablet-height: <?= $tabletHeight ?>px; --desktop-height: <?= $desktopHeight ?>px;">
</div>