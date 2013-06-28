<?php
/**
 * Template Name: Depoimentos
 *
 * A custom page template for the Depoimentos post type.
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
		<?php $my_query = new WP_Query("post_type=depoimento&showposts=-1"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<blockquote>
			<?php the_post_thumbnail('depoimento_thumb');?><?php the_content();?>
			<span>
				<?php the_title();?>
				<?php $profissao = get_post_meta($post->ID, 'depoimento_profissao', true); if($profissao != '') echo '<small>' . $profissao . '</small>';?>
			</span>
		</blockquote>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>