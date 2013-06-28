<?php
/**
 * Template Name: Galeria Page
 *
 * A custom page template for the Galery.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Cambará do Sul  pp Possibilidade de pancadas, pc Pancadas de Chuva, pn Parcialmente nublado, vn Variação de Nebulosidade, np Nublado e Pancadas
 * @since Starkers 1.0
 */

get_header(); ?>
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h2><?php the_title(); ?></h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content();?>
		<div class="gallery">
		<?php $i = 0;?>
		<?php $my_query = new WP_Query("post_type=album&showposts=-1"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
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
		<?php endwhile; wp_reset_query(); ?>
		</div>
	</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>