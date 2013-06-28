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
	<h2>Atrativos</h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="experimente_item hentry">
				<a href="<?php the_permalink();?>"><?php the_post_thumbnail('servico_thumb');?></a>
				<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<?php the_excerpt();?>
				<a href="<?php the_permalink();?>" class="more_link">Ver mais</a>
			</div>
		<?php endwhile;?>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>