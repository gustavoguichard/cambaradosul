<?php
/**
 * Template Name: Experimente Page
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
		<?php the_post_thumbnail('experimente_thumb');?><?php the_content(); ?>
	</div>
	<?php $post_obj = $wp_query->get_queried_object();
	$post_ID = $post_obj->ID;
	$post_title = $post_obj->post_title;
	$post_slug = $post_obj->post_name;
	?>
	<?php $my_query = new WP_Query("post_type=atrativo&showposts=-1&experimente=$post_slug&order=ASC&orderby=title"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<div class="experimente_item hentry">
		<a href="<?php the_permalink();?>"><?php the_post_thumbnail('servico_thumb');?></a>
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<?php the_excerpt();?>
		<a href="<?php the_permalink();?>" class="more_link">Ver mais</a>
	</div>
	<?php endwhile; wp_reset_query(); ?>

<?php endwhile; ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>