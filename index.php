<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
  <meta charset="<?php bloginfo( 'charset' );?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head();?>
</head>

<body>
  <div id="vue-wordpress-app" class="container">
    <div class="site-branding">
      <?php 
        $logo_id = RADL::get('state.site')['logo'];
        if ( $logo_id ):
            $logo = RADL::get('state.media', $logo_id);
        ?>
      <img class="logo" src="<?php echo $logo['source_url']; ?>" alt="<?php echo $logo['alt_text']; ?>" />
      <?php endif;?>
      <span><?php echo RADL::get('state.site')['name']; ?></span>
    </div>
    <nav class="main-menu">
      <?php echo '<script>console.log('.json_encode(RADL::get('state.menus')).')</script>'; ?>
      <?php foreach ( RADL::get('state.menus')['main'] as $item ): ?>
      <a href="<?php echo $item['link']; ?>" target="<?php echo $item['target']; ?>"
        title="<?php echo $item['title']; ?>"><?php echo $item['content']; ?></a>
      <?php endforeach;?>
    </nav>
    <main>
    </main>
  </div>
  <?php wp_footer();?>
</body>

</html>