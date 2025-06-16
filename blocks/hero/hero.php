<?php

$id = isset($block['anchor']) && $block['anchor'] ? $block['anchor'] : $block['id'];

$wrapper_attributes = get_block_wrapper_attributes([
  'id' => $id,
  'class' => 'block hero',
]);

$text = get_field('block_hero_text');

?>
<div <?= $wrapper_attributes; ?>>
    <div class="block__content">
        <!-- Block content goes here -->
        <div class="hero-content">
            <?= $text; ?>
        </div>
    </div>
</div>