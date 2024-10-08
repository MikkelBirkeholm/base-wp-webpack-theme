<div class="site-header">
<?php get_template_part( 'parts/header/header', 'logo' ); ?>
<div class="main-nav">
<?php get_template_part( 'parts/header/header', 'nav' ); ?>
</div>
<div class="mobile-nav">
    <label for="check" id="nav-toggle" aria-label="Mobile Navigation Button" role="button" class="mobile-toggle">
        <input type="checkbox" id="check"/> 
        <span></span>
        <span></span>
        <span></span>
    </label>
   
    <div id="nav-wrapper" class="nav-wrapper">
        <?php get_template_part( 'parts/header/header', 'nav' ); ?>
    </div>
</div>
</div>
