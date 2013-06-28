<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="content">
	<h2>Publicações Oficiais</h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content();?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h3><?php the_title();?></h3>
			<?php the_content();?>
		<?php endwhile;?>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>