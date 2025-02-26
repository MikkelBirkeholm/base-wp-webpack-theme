<?php 
    $footer_width = get_field('footer_width', 'option') ?: 'none';
?>
</main>
<footer id="footer" class="site-footer">
    <div class="footer__content <?= $footer_width ?>">
        <div class="footer-logo">
            <?php get_template_part( 'partials/header/header', 'logo' ); ?>
        </div>
        <?php footer_nav(); ?>
    </div>
</footer>
</body>

<?php wp_footer(); ?>