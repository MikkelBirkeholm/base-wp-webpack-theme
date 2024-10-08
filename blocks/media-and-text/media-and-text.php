<?php
  $preheader = get_field('preheader');
    $heading = get_field('heading');
    $buttons = get_field('buttons');
    $image = get_field('image');
    $text = get_field( 'text' );
?>

<div class="block media-text">
  <div class="block__content-narrow">
    <div class="media-text__wrapper">
          <div class="media-text__media">
      <?php if( $image ): ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
  </div>
    <div class="media-text__content">
      <p class="media-text__preheader"><?php echo $preheader; ?></p>
      <h2 class="media-text__heading"><?php echo $heading; ?></h2>
      <hr />
      <div class="media-text__text"><?php echo $text; ?></div>
      <div class="media-text__buttons">
        <?php if( have_rows('buttons') ): ?>
          <?php while( have_rows('buttons') ): the_row(); ?>
            <?php $button = get_sub_field('button'); ?>
            <a href="<?php echo $button['url']; ?>" class="button"><?php echo $button['title']; ?></a>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  </div>
</div>