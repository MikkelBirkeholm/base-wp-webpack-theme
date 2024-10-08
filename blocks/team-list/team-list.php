<?php 
   $team = get_field('team');

?>
<div class="block team">
    <div class="block__content">
        <div class="team__list">
            <?php foreach($team as $member): ?>
                <?php 
                    $name = get_the_title($member);
                    $image = get_field('billede', $member);
                    $role = get_field('medlemstype', $member);
                    ?>
            <div class="team__member">
                <div class="team__member__image">
                 <?php if($image): ?>
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                    <?php endif; ?>
                </div>
                <div class="team__member__content">
                    <p><?php echo $name ?></p>
                    <p><?php the_field('baggrund', $member); ?></p>
                    <p class="member-role"><?php echo get_term($role)->name; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
            </div>
            
</div> 
</div>