<?php
  $heading = get_field('accordion_heading');
  $text = get_field('accordion_text');
$items = get_field('accordion_items');

$id = $block['id'];
    $classes = '';
    
      if($block['align']) {
      $classes .= ' align' . $block['align'];
    }

?>
<div class="<?= $classes; ?>">
    <div class="accordion">
        <h2 class="accordion__heading"><?php echo $heading; ?></h2>
        <div class="accordion__text"><?php echo $text; ?></div>
        <div class="accordion__items">
            <?php if( have_rows('accordion_items') ): ?>
            <?php while( have_rows('accordion_items') ): the_row(); ?>
            <div class="accordion_item">
                <label>
                    <input type="radio" name="accordion" />
                    <h3><?php echo get_sub_field('item_title'); ?></h3>
                </label>
                <div class="accordion_item__content__wrapper">
                    <div class="accordion_item__content">
                        <?php echo get_sub_field('item_content'); ?>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>