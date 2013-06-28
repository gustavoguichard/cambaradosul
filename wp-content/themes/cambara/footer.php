<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
</div>
<div id="footer" class="container_12">
	<div class="grid_4">
		<h4>Mapa do Site</h4>
		<?php wp_nav_menu( array( 'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_1', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
		<?php wp_nav_menu( array( 'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_2', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
		<?php wp_nav_menu( array( 'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_5', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
	</div>
	<div class="grid_4">
		<?php wp_nav_menu( array(  'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_4', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
		<?php wp_nav_menu( array(  'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_3', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
		<?php wp_nav_menu( array(  'fallback_cb' => false, 'theme_location' => 'twentyten', 'menu' => 'menu_rodape_6', 'container' => false, 'menu_class' => 'sitemap' ) ); ?>
	</div>
	<div class="grid_4 right_bottom_collum">
		<h4>Parceiros:</h4>
		<?php $my_query = new WP_Query("post_type=parceiro&showposts=4&orderby=rand"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<?php $parceiro_url =  get_post_meta($post->ID, 'parceiro_url', true); ?>
			<a href="<?=$parceiro_url?>" title="<?php the_title();?>"><?php the_post_thumbnail('parceiro_thumb');?></a>
		<?php endwhile; wp_reset_query(); ?>
	</div>
	<div id="copyright" class="grid_4">
		<a href="http://www.criaideias.com.br" title="Ir para o site da Cria Idéias"><img src="<?php bloginfo('template_url');?>/images/cria.gif" alt="Cria Idéias" /></a>
		<p>Criação e Desenvolvimento por <a href="http://www.criaideias.com.br" title="Ir para o site da Cria Idéias">Cria Idéias</a><br />
		Todos os direitos reservados</p>
	</div>
</div>
<script src="<?php bloginfo('template_url');?>/js/cambara.js" type="text/javascript" charset="utf-8"></script>
<?php if(is_front_page()):?>
<script src="<?php bloginfo('template_url');?>/js/foto360.js" type="text/javascript" charset="utf-8"></script>
<?php endif;?>
<script src="<?php bloginfo('template_url') ?>/js/jquery.lightbox-0.5.min.js" type="text/javascript" charset="utf-8"></script>
<?php wp_footer(); ?>
</body>
</html>
