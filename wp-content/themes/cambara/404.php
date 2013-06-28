<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<div id="content">


	<h2><?php _e( 'Nada encontrado', 'twentyten' ); ?></h2>
	<div class="hentry"><p><?php _e( 'Desculpe-nos, mas não encontramos nenhum conteúdo correspondente. Tente fazer uma busca no topo da página ou veja o Mapa do Site abaixo.', 'twentyten' ); ?></p></div>

</div>
<?php get_footer(); ?>