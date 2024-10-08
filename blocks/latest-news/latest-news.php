<?php 
    $title = get_field('title');
    $read_more_button = get_field('read_more_button');

    $args = array(
        'post_type' => 'forskningsartikler',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 4
    );

    $query = new WP_Query( $args );

?>

<div class="block latest-news">
    <div class="block__content">
        <div class="latest-news__top">
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo $read_more_button['url']; ?>" class="button"><?php echo $read_more_button['title']; ?></a>
        </div>
    <?php if( $query->have_posts() ) : ?>
        <ul class="latest-news__list">
            <?php while( $query->have_posts() ) : $query->the_post(); ?>
            <?php 
                $id = get_the_ID();
            ?>
                <li class="card">
                    <div class="card__date">
                        <span class="day"><?php echo get_the_date( 'j' ); ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                    </div>
                    <div class="card__content">
                        <span class="orginal">Original: <?php the_field( 'journal', $id ); ?></span>
                        <h3 class="title"><?php the_title(); ?></h3>
                        <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="button">
                    Læs mere
                    </a>
                </li>

            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    </div>
</div>