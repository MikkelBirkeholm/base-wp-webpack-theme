<?php 
    $button = get_field('knap');
?>

<div class="cta block">
    <div class="block__content">
        <div class="cta__content">
            <h2><?php the_field('header'); ?></h2>
            <hr />
            <p><?php the_field('text'); ?></p>
            <a href="<?php echo $button['url']; ?>" class="button"><?php echo $button['title']; ?></a>
        </div>
        </div>
        </div>
