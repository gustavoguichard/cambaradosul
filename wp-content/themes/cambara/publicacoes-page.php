<?php
/**
 * Template Name: Publicações Oficiais Page
 *
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
		<?php the_content(); ?>
		<ul>
			<?php 
				$terms = get_terms("area_da_publicacao", "hide_empty=0");
				$count = count($terms);
				if ( $count > 0 ){
				   echo "<ul>";
				   foreach ( $terms as $term ) {
				     echo "<li><a href='" . get_permalink_by_name("tabela-de-contas-publicas") . "?area=" . $term->slug . "'>" . $term->name . "</a></li>";
				   }
				   echo "</ul>";
				}
			;?>
		</ul>
	</div>
<?php endwhile; ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>