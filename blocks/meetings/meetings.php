<?php 
    $meetings = new WP_Query( array(
        'post_type' => 'moeder',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'moede-typer',
                'field' => 'slug',
                'terms' => array('andre-moeder', 'aarsmoede', 'generalforsamling'),
                'operator' => 'IN'
            ),
        )
    ) );
    
    $courses = new WP_Query( array(
        'post_type' => 'moeder',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'moede-typer',
                'field' => 'slug',
                'terms' => 'kursus',
            ),
        )
    ) );
?>

<div class="block">
    <div class="block__content meetings">
        <h2>Møder</h2>
        <div class="meetings-list">
            <?php if( $meetings->have_posts() ) : ?>
            <?php while($meetings->have_posts()) : $meetings->the_post() ?>
                <?php 
                    $id = get_the_ID();
                    $type = get_field('modetype', $id);
                    $from_date = get_field('date_start', $id);
                    $today = date('d-m-Y');
                    $program_group = get_field('program_group', $id);
                    $tilmeld_group = get_field('tilmelding_group', $id);
                    $referat_group = get_field('referat_group', $id);
                    $is_past = $from_date < $today;
                    ?>
                <div class="meeting meeting-card">
                    <div class="meeting-labels">
                        <span class="meeting-type"><?php echo get_term($type[0])->name; ?></span>
                        <?php if( $referat_group['referat_vis'] ): ?>
                        <a href="<?php echo $referat_group['referat']['url']; ?>" target="_blank" class="meeting-referat">Referat</a>
                        <?php endif; ?>
                    </div>
                    <h2 class="meeting-title h3"><?php the_title(); ?></h2>
                    <div class="meeting-time">
                        <?php if( $is_past ): ?>
                        <p class="meeting-past">Afholdt</p>
                        <?php else: ?>
                        <p>Fra: <?php the_field('date_start', $id); ?></p>
                        <p>Til: <?php the_field('date_end', $id); ?></p>
                        <?php endif; ?>
                    </div>
                     <?php if( !$is_past ): ?>
                        <p class="meeting-notes"><?php the_field('noter', $id); ?></p>
                    <div class="meeting-actions">
                    <?php if( $program_group['program_vis'] ): ?>
                         <a href="<?php echo $program_group['program']['url']; ?>" target="_blank" class="meeting-button">Program</a>
                    <?php endif; ?>
                    <?php if( $tilmeld_group['tilmelding_vis'] ): ?>
                        <a href="<?php echo $tilmeld_group['link_tilmeld']; ?>" target="_blank" class="meeting-button">Tilmelding</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
            
             <?php wp_reset_postdata(); ?>

             <h2>Kurser</h2>
        <div class="meetings-list">
            <?php if( $courses->have_posts() ) : ?>
            <?php while($courses->have_posts()) : $courses->the_post() ?>
                <?php 
                    $id = get_the_ID();
                    $type = get_field('modetype', $id);
                    $from_date = get_field('date_start', $id);
                    $today = date('d-m-Y');
                    $program_group = get_field('program_group', $id);
                    $tilmeld_group = get_field('tilmelding_group', $id);
                    $referat_group = get_field('referat_group', $id);
                    $is_past = $from_date < $today;
                    ?>
                <div class="meeting meeting-card">
                    <div class="meeting-labels">
                        <span class="meeting-type"><?php echo get_term($type[0])->name; ?></span>
                        <?php if( $referat_group['referat_vis'] ): ?>
                        <a href="<?php echo $referat_group['referat']['url']; ?>" target="_blank" class="meeting-referat">Referat</a>
                        <?php endif; ?>
                    </div>
                    <h2 class="meeting-title h3"><?php the_title(); ?></h2>
                    <div class="meeting-time">
                        <?php if( $is_past ): ?>
                        <p class="meeting-past">Afholdt</p>
                        <?php else: ?>
                        <p>Fra: <?php the_field('date_start', $id); ?></p>
                        <p>Til: <?php the_field('date_end', $id); ?></p>
                        <?php endif; ?>
                    </div>
                     <?php if( !$is_past ): ?>
                        <p class="meeting-notes"><?php the_field('noter', $id); ?></p>
                    <div class="meeting-actions">
                    <?php if( $program_group['program_vis'] ): ?>
                         <a href="<?php echo $program_group['program']['url']; ?>" target="_blank" class="meeting-button">Program</a>
                    <?php endif; ?>
                    <?php if( $tilmeld_group['tilmelding_vis'] ): ?>
                        <a href="<?php echo $tilmeld_group['link_tilmeld']; ?>" target="_blank" class="meeting-button">Tilmelding</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>

         <?php wp_reset_postdata(); ?>
        </div>
        </div>
    </div>