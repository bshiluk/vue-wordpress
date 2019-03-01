<?php
$name = get_query_var( 'vw_nav_menu' ); ?>

<nav class="main-menu">

    <?php
    foreach ( RADL::get( 'state.menus' )[$name] as $item ): ?>

    <a href="<?php echo $item['url']; ?>" target="<?php echo $item['target']; ?>"
        title="<?php echo $item['title']; ?>"><?php echo $item['content']; ?></a>

    <?php
    endforeach;?>

</nav>