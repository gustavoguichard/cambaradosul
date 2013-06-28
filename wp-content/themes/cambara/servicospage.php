<?php
/**
 * Template Name: Serviços Page
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
		<?php $post_obj = $wp_query->get_queried_object();
			$post_ID = $post_obj->ID;
			$post_title = $post_obj->post_title;
			$post_slug = $post_obj->post_name;
		?>
		<?php $my_query = new WP_Query("post_type=servico&showposts=-1&tipo=$post_slug&order=ASC&orderby=title"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<?php $custom_fields = get_post_custom($post->ID); $endereco =  $custom_fields['servico_endereco'][0]; $telefones =  $custom_fields['servico_telefones'][0]; $email =  $custom_fields['servico_email'][0]; $site =  $custom_fields['servico_site'][0]; ?>
		<div class="servico_div">
			<?php the_post_thumbnail('servico_thumb');?>
			<h3><?php the_title();?></h3>
			<ul class="no-bullet">
				<?php if($endereco != ''):?><li>Endereço: <?php echo $endereco; ?></li><?php endif;?>
				<?php if($telefones != ''):?><li>Telefones: <?php echo $telefones; ?></li><?php endif;?>
				<?php if($email != ''):?><li>E-mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li><?php endif;?>
				<?php if($site != ''):?><li>Site: <a href="http://<?php echo $site; ?>"><?php echo $site; ?></a></li><?php endif;?>
			</ul>
		</div>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php endwhile; ?>
</div>
<?php get_footer(); ?>