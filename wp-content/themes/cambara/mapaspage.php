<?php
/**
 * Template Name: Mapas Page
 *
 * A custom page template for the Mapas posts.
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
		<?php $my_query = new WP_Query("post_type=mapa&showposts=-1"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<h3><?php the_title();?></h3>
			<?php the_content();?>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>