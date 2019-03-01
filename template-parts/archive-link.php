<?php
$archive = get_query_var( 'vw_archive_link' ); ?>

<a href="<?php echo $archive['link']; ?>" title="<?php echo $archive['name']; ?>"><?php echo $archive['name']; ?></a>