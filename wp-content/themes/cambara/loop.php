<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<h2><?php _e( 'Não encontrado', 'twentyten' ); ?></h2>
		<p><?php _e( 'Desculpe-nos mas não encontramos nada de acordo com o que você requisitou, talvez você pode fazer uma busca ou olhar o Mapa do Site abaixo.', 'twentyten' ); ?></p>
		
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>
		
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( get_post_type() == 'curiosidade' ){ ?>
			<h3>Curiosidade</h3>
			<p><?php the_title();?></p>
			<?php the_content();?>
			<?php } else if( get_post_type() == 'publicacao' ){ ?>
			<h3><?php the_title();?></h3>
			<?php the_content();?>
			<?php } else if( get_post_type() == 'servico' ){ ?>
			<div class="servico_div">
			<?php $term = wp_get_post_terms($post->ID, 'tipo_de_servico', 'name' ); $tipo = $term[0]->name; ?>
			<h3>Serviços -> <?php echo $tipo; ?> -> <?php the_title();?></h3>
			</div>
			<?php } else if( get_post_type() == 'atrativo' ){ ?>
			<div class="post">
				<a href="<?php the_permalink();?>"><?php the_post_thumbnail('servico_thumb');?></a>
				<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<?php the_excerpt();?>
			</div>
			<?php } else { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_post_thumbnail();?></a>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php if(get_post_type() == 'post'):?><p class="posted">Data: <?php the_time('d/m/Y');?> - <?php the_time();?></p><?php endif;?>
			<?php the_excerpt();?>
			<?php }?>
		</div>
<?php endwhile; // End the loop. Whew. ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<?php if(function_exists('wp_paginate')) { wp_paginate(); } ?>
<?php endif; ?>