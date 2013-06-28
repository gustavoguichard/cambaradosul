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
	<?php $custom_fields = get_post_custom($post->ID); $endereco =  $custom_fields['atrativo_endereco'][0]; $distancia =  $custom_fields['atrativo_distancia'][0]; $acesso =  $custom_fields['atrativo_acesso'][0]; $visitacao =  $custom_fields['atrativo_visitacao'][0]; $comercial =  $custom_fields['atrativo_comercial'][0]; $funcionamento =  $custom_fields['atrativo_funcionamento'][0]; $ingresso =  $custom_fields['atrativo_ingresso'][0]; $mais =  $custom_fields['atrativo_mais'][0]; ?>

	<?php $term = wp_get_post_terms($post->ID, 'experimente', 'name' ); $experimente = $term[0]->name; ?>
	<h2><?php echo $experimente; ?> - <?php the_title(); ?></h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_post_thumbnail('experimente_thumb');?>
		<strong>Descrição e características do atrativo:</strong> <?php the_content(); ?>
		<ul class="no-bullet">
			<?php if($endereco != ''):?><li><strong>Endereço / Localização:</strong> <?php echo $endereco; ?></li><?php endif;?>
			<?php if($distancia != ''):?><li><strong>Distância do centro:</strong> <?php echo $distancia; ?>km</li><?php endif;?>
			<?php if($acesso != ''):?><li><strong>Tipo de acesso:</strong> <?php echo $acesso; ?></li><?php endif;?>
			<?php if($visitacao != ''):?><li><strong>Tipo de visitação:</strong> <?php echo $visitacao; ?></li><?php endif;?>
			<?php if($comercial != ''):?><li><strong>Quem comercializa:</strong> <?php echo $comercial; ?></li><?php endif;?>
			<?php if($funcionamento != ''):?><li><strong>Funcionamento:</strong> <?php echo $funcionamento; ?></li><?php endif;?>
			<?php if($ingresso != ''):?><li><strong>Ingresso:</strong> <?php echo $ingresso; ?></li><?php endif;?>
		</ul>
		<?php if($mais != ''):?><strong>Mais informações:</strong> <?php echo $mais; ?><?php endif;?>
	</div>

<?php endwhile; ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>