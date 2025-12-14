<?php
/**
 * Template Name: Blank Template(For Page Builders)
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Cleaning Light
 */

get_header();  ?>

<div class="ikthemewrap">
	<div class="contentarea">
		<main id="main" class="site-main">

			<?php while (have_posts()) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; ?>

		</main>
	</div>
</div>
<?php get_footer();