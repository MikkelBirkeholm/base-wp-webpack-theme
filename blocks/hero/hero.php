<?php
    $preheader = get_field('preheader');
    $heading = get_field('heading');
    $buttons = get_field('buttons');
    $image = get_field('image');
    $video = get_field('video_link');
    ?>

    <div class="hero">
        <div class="hero__content">
            <?php if( $preheader ): ?>
            <p class="hero__preheader animate delay-1"><?php echo $preheader; ?></p>
            <?php endif; ?>
            <h1 class="hero__heading animate delay-2"><?php echo $heading; ?></h1>
            <div class="hero__buttons animate delay-3">
                <?php if( have_rows('buttons') ): ?>
                    <?php while( have_rows('buttons') ): the_row(); ?>
                    <?php $button = get_sub_field('button'); ?>
                    <a href="<?php echo $button['url']; ?>" class="button"><?php echo $button['title']; ?></a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


   