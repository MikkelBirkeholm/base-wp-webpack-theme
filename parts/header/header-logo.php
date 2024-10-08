<?php // ACF vars
$logo = get_field('logo', 'option');
?>

<div class="site-logo">
	<a href="<?= home_url(); ?>" class="site-logo__link" aria-label="Home Link" role="link">
	<?php if ( $logo ) :  ?>
	    <img class="site-logo__img" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" width="70" height="auto">
	<?php endif; ?>
	</a>
</div>