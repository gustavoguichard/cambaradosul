<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php 
if(is_single() || is_page() || is_category() || is_home()) {
        echo '<meta name="robots" content="all,noodp" />';
}
else if(is_archive()) {
        echo '<meta name="robots" content="noarchive,noodp" />';
}
else if(is_search() || is_404()) { 
        echo '<meta name="robots" content="noindex,noarchive" />';
}
?>
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="http://fonts.googleapis.com/css?family=Arvo:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" />
<![endif]-->
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="<?php bloginfo('template_url');?>/js/modernizr.js" type="text/javascript" charset="utf-8"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class('no-js'); ?>>
	<form role="search" method="get" id="searchform" action="<?php bloginfo('url');?>" >
		<input type="text" value="" name="s" id="s" class="input-text" />
		<input type="submit" id="searchsubmit" value="Procurar" />
	</form>
	<div id="logo">
		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<h4><?php bloginfo( 'description' ); ?></h4>
		</a>
	</div>

	<div id="access" role="navigation">
	  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
		<a href="<?php if(is_front_page()){echo "#home_content";}else{echo "#content";};?>" title="<?php esc_attr_e( 'Ir para o conteúdo', 'twentyten' ); ?>"><?php _e( 'Ir para o conteúdo', 'twentyten' ); ?></a>
	</div><!-- #access -->
	
	<div id="container" class="container_12">
	<?php wp_nav_menu( array( 'container_id' => 'nav_container', 'menu_class' => 'no-js', 'menu_id' => 'nav' ) ); ?>