<head>
    <title><?=get_the_title()?></title>

    <!-- meta tag header includes -->
    <meta name="author" content="Taylor Callsen" />
    <meta name="description" content="<?=get_the_excerpt()?>" />
    <meta name="keywords" content="<?=$metaTags?>">
    <link rel="canonical" href="<?=wp_get_canonical_url()?>">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />
    <meta name="robots" content="index, follow">

    <!-- compatability header includes -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- open graph header includes -->
    <meta property="og:title" content="<?=get_the_title()?>" />
    <meta property="og:url" content="<?=wp_get_canonical_url()?>" />
    <meta property="og:description" content="<?=get_the_excerpt()?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- wordpress header includes -->
    <?php wp_head(); ?>

</head>

<body <? body_class(); ?>>
    <?php get_template_part( 'partials/partials', 'header' ); ?>
    <main id="site-content" class="site-content" role="main">