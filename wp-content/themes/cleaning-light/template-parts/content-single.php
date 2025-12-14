<?php

$alignment = get_theme_mod('cleaninglight_blog_single_alignment', 'text-left');

$single_post_top_elements = get_theme_mod('cleaninglight_single_post_top_elements', array('title', 'post_meta', 'content'));

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('singlearticle ' .$alignment); ?>>
	<?php

		cleaninglight_themes_post_format_media();

		foreach ($single_post_top_elements as $element) {

			$template_function_name = "cleaninglight_themes_single_{$element}";

			$template_function_name();
		}

	?>
</article><!-- #post-<?php the_ID(); ?> -->