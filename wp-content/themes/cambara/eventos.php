<?php
/**
 * Template Name: Eventos
 *
 * A custom page template.
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
		<h3>Janeiro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=janeiro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Fevereiro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=fevereiro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Março</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=marco"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Abril</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=abril"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Maio</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=maio"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Junho</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=junho"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Julho</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=julho"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Agosto</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=agosto"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Setembro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=setembro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Outubro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=outubro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Novembro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=novembro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
		<h3>Dezembro</h3>
		<ul class="no-bullet">
		<?php $my_query = new WP_Query("post_type=evento&order=ASC&orderby=title&showposts=-1&mes=dezembro"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li><?php the_title();?></li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
	</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>