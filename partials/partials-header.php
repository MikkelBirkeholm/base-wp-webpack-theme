<?php 
    $header_width = get_field('header_width', 'option') ?: 'none';
?>
<div class="site-header <?= $header_width ?>">
    <?php get_template_part( 'partials/header/header', 'logo' ); ?>
    <div class="main-nav">
        <?php get_template_part( 'partials/header/header', 'nav' ); ?>
    </div>
    <div class="mobile-nav">
        <label for="check" id="nav-toggle" aria-label="Mobile Navigation Button" role="button" class="mobile-toggle">
            <input type="checkbox" id="check" />
            <span></span>
            <span></span>
            <span></span>
        </label>

        <div id="nav-wrapper" class="nav-wrapper">
            <?php get_template_part( 'partials/header/header', 'nav' ); ?>
        </div>
    </div>
</div>