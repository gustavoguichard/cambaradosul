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
	<h2>Galeria de Fotos</h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content();?>
		<div class="gallery">
		<?php $i = 0;?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $i++;?>
			<dl class="gallery-item"> 
				<dt class="gallery-icon"> 
					<a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a> 
				</dt>
				<dd class="wp-caption-text gallery-caption"> 
				<?php the_title();?>
				</dd>
			</dl>
			<?php if($i == 4):?>
			<br style="clear: both" />
			<?php $i = 0;?>
			<?php endif;?>
		<?php endwhile;?>

		</div>
	</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>