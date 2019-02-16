<!DOCTYPE html>
<html <?php language_attributes();?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' );?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php wp_head();?>
    </head>
    <body>
        <div id="vue-wordpress-app">
            <h1><?php echo RADL::get('state.site')['name'];?></h1>
            <p><?php echo RADL::get('state.site')['description'];?></p>
        </div>
        <?php wp_footer();?>
    </body>
</html>