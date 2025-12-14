<?php

if ( ! is_active_sidebar( 'sidebar-2' )) {
	return;
}
?>
<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>