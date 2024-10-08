<?php 
    $products_1 = new WP_Query( array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'produkttype',
                'field' => 'slug',
                'terms' => 'godkendte-laegemidler'
            )
        )
    ) );

    $products_2 = new WP_Query( array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'produkttype',
                'field' => 'slug',
                'terms' => 'kraever-udleveringstilladelse'
            )
        )
    ) );

        $products_3 = new WP_Query( array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'produkttype',
                'field' => 'slug',
                'terms' => 'magistrelt-fremstillet'
            )
        )
    ) );
    
        $products_4 = new WP_Query( array(
        'post_type' => 'produkt',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => 'produkttype',
                'field' => 'slug',
                'terms' => 'i-forsoegsordningen'
            )
        )
    ) );

    

?>
<div class="block products">
    <div class="block__content">
        <div class="product__list">
            <div class="product__list__headings">
                <span class="product-title">Godkendte lægemidler</span>
                <span>THC, koncentration</span>
                <span>CBD, koncentration</span>
                <span>Adminstration</span>
                <span>Pakning</span>
            </div>
            <?php while( $products_1->have_posts() ) : $products_1->the_post(); ?>
            <div class="product">
                <?php 
                    $id = get_the_ID();
                ?>
                <span class="product-title"><?php the_title(); ?></span>
                <span><?php the_field('thc', $id); ?></span>
                <span><?php the_field('cbd', $id); ?></span>
                <span><?php the_field('adminstration', $id); ?></span>
                <span><?php the_field('pakning', $id); ?></span>
            </div>
            <?php endwhile; ?>
        </div>

         <div class="product__list">
            <div class="product__list__headings">
                <span class="product-title">Lægemidler som kræver udleveringstilladelse</span>
                <span>THC, koncentration</span>
                <span>CBD, koncentration</span>
                <span>Adminstration</span>
                <span>Pakning</span>
            </div>
            <?php while( $products_2->have_posts() ) : $products_2->the_post(); ?>
            <div class="product">
                <?php 
                    $id = get_the_ID();
                ?>
                <span class="product-title"><?php the_title(); ?></span>
                <span><?php the_field('thc', $id); ?></span>
                <span><?php the_field('cbd', $id); ?></span>
                <span><?php the_field('adminstration', $id); ?></span>
                <span><?php the_field('pakning', $id); ?></span>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="product__list">
            <div class="product__list__headings">
                <span class="product-title">Magistrelt fremstillet</span>
                <span>THC, koncentration</span>
                <span>CBD, koncentration</span>
                <span>Adminstration</span>
                <span>Pakning</span>
            </div>
            <?php while( $products_3->have_posts() ) : $products_3->the_post(); ?>
            <div class="product">
                <?php 
                    $id = get_the_ID();
                ?>
                <span class="product-title"><?php the_title(); ?></span>
                <span><?php the_field('thc', $id); ?></span>
                <span><?php the_field('cbd', $id); ?></span>
                <span><?php the_field('adminstration', $id); ?></span>
                <span><?php the_field('pakning', $id); ?></span>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="product__list">
            <div class="product__list__headings">
                <span class="product-title">Produkter optaget i Forsøgsordningen</span>
                <span>THC, koncentration</span>
                <span>CBD, koncentration</span>
                <span>Adminstration</span>
                <span>Pakning</span>
            </div>
            <?php while( $products_4->have_posts() ) : $products_4->the_post(); ?>
            <div class="product">
                <?php 
                    $id = get_the_ID();
                ?>
                <span class="product-title"><?php the_title(); ?></span>
                <span><?php the_field('thc', $id); ?></span>
                <span><?php the_field('cbd', $id); ?></span>
                <span><?php the_field('adminstration', $id); ?></span>
                <span><?php the_field('pakning', $id); ?></span>
            </div>
            <?php endwhile; ?>
        </div>
        
    </div>
</div>
<?php wp_reset_postdata(); ?>