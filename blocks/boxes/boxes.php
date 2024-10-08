<?php
    $title = get_field('title');
    $links = get_field('links');

    ?>

    <div class="block boxes">
        <div class="block__content">
        <h2 class="boxes__title"><?php echo $title; ?></h2>
        <div class="boxes__links">
            <?php if( have_rows('links') ): ?>
                <?php while( have_rows('links') ): the_row(); ?>
                <?php $link = get_sub_field('link'); ?>
                <div class="boxes__link">
                <a href="<?php echo $link['url']; ?>">
                    <?php echo $link['title']; ?>
                </a>
            </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        </div>
    </div>
    