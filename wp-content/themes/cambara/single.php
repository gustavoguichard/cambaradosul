<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<h3><?php the_title(); ?></h3>
		<p class="posted">Data: <?php the_time('d/m/Y');?> - <?php the_time();?></p>
		<div class="post-content"><?php the_post_thumbnail('single_thumb');?>
		<?php the_content(); ?></div>
	
	</div>
</div>
<div id="more_news">
	<h2>Mais Notícias</h2>
	<?php $prevPost = get_previous_post(); if($prevPost):?>
	<?php $my_query = new WP_Query("p=$prevPost->ID"); ?>  
		<?php if($my_query->have_posts()) : ?><?php while($my_query->have_posts()) : $my_query->the_post(); ?>
		<div class="hentry post">
			<h3>Notícia anterior</h3>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<p class="posted">Data: <?php echo get_the_time('d/m/Y \- H:i', $post->ID);?></p>
			<p><?php the_excerpt();?></p>
		</div>
	<?php endwhile; endif; wp_reset_query(); endif; ?>
	<?php $nextPost = get_next_post(); if($nextPost):?>
	<?php $my_query = new WP_Query("p=$nextPost->ID"); ?>  
		<?php if($my_query->have_posts()) : ?><?php while($my_query->have_posts()) : $my_query->the_post(); ?>
		<div class="hentry post">
			<h3>Próxima notícia</h3>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<p class="posted">Data: <?php echo get_the_time('d/m/Y \- H:i', $post->ID);?></p>
			<p><?php the_excerpt();?></p>
		</div>
	<?php endwhile; endif; wp_reset_query(); endif; ?>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>