<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="content">
<?php if ( have_posts() ) : ?>
				<h2><?php printf( __( 'Resultados da busca por: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h2>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
	<h2><?php _e( 'Nada encontrado', 'twentyten' ); ?></h2>
	<div class="hentry"><p><?php _e( 'Desculpe-nos, mas não encontramos nenhum conteúdo correspondente. Tente fazer uma busca no topo da página ou veja o Mapa do Site abaixo.', 'twentyten' ); ?></p></div>
<?php endif; ?>

<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>