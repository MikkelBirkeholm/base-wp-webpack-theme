<!DOCTYPE html>

<?php if (is_user_logged_in()) { ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="da-DK" xml:lang="da-DK" class="wpadmin-logged-in">
<?php } else { ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="da-DK" xml:lang="da-DK">
<?php } ?>

<?php include('header.php'); ?>
<div class="blocks-container">
    <?php the_content(); ?>
</div>
<?php include('footer.php'); ?>

</html>