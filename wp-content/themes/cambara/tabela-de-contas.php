<?php
/**
 * Template Name: Tabela de Contas Page
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
	<?php 
		if(isset($_GET["area"])):
		$slug = $_GET["area"];
		$term = get_term_by('slug', $slug, 'area_da_publicacao');
		else:
		?>
			<meta http-equiv="REFRESH" content="0;url=<?=get_permalink_by_name('contas-publicas')?>" />
		<?php
		endif;
	?>
	<h2><?php echo $term->name; ?></h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if($term->description != ""):?>
		<p><?php echo $term->description;?></p>
		<?php endif;?>
		<table id="tabela_contas" class="zebra-striped">
			<thead>
				<tr>
					<th>Ano</th>
					<th>Período</th>
					<th>Relatório</th>
					<th>Anexo</th>
					<th>Data de Inserção</th>
				</tr>
			</thead>
			<tbody>
				<?php $my_query = new WP_Query("showposts=-1&area=$slug&post_type=publicacao"); ?>
				<?php if($my_query->have_posts()) : ?><?php while($my_query->have_posts()) : $my_query->the_post(); ?>
					<?php $ano = get_post_meta($post->ID, 'publicacao_ano', true);?>
					<?php $periodo = get_post_meta($post->ID, 'publicacao_periodo', true);?>
					<?php $data = get_post_meta($post->ID, 'publicacao_data', true);?>
					<?php $file = get_post_meta($post->ID, 'pdf_file', true);?>
					<tr>
						<td><?=$ano?></td>
						<td><?=$periodo?></td>
						<td><?php the_title(); ?></td>
						<td><a href="<?=$file?>" class="label warning">Ver</a></td>
						<td><?=$data?></td>
					</tr>
				<?php endwhile; endif; wp_reset_query(); ?>
			</tbody>
		</table>
	</div>
<?php endwhile; ?>
<?php get_sidebar(); ?>
</div>
<script src="<?php echo get_bloginfo('template_directory') . '/js/jquery.tablesorter.min.js';?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">  
jQuery(function() {  
  jQuery('table#tabela_contas').tablesorter({ sortList: [[1,0]] });
});
</script>
<?php get_footer(); ?>