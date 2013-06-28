<?php
/**
 *
 * @package WordPress
 * @subpackage Cambará do Sul
 * @since Cambará do Sul 1.0
 */


/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function get_permalink_by_name($page_name)
{
	global $post;
	global $wpdb;
	$pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return get_permalink($pageid_name);
}

function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size('servico_thumb', 150, 100, true);
	add_image_size('depoimento_thumb', 100, 100, true);
	add_image_size('single_thumb', 250, 250, false);
	add_image_size('parceiro_thumb', 130, 130, true);
	add_image_size('experimente_thumb', 232, 185, true);
	add_image_size('news_thumb', 60, 60, true);

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
		'footer1' => __( 'First Footer Sitemap', 'twentyten' ),
		'footer2' => __( 'Second Footer Sitemap', 'twentyten' ),
		'footer3' => __( 'Third Footer Sitemap', 'twentyten' ),
		'footer4' => __( 'Forth Footer Sitemap', 'twentyten' ),
		'footer5' => __( 'Fifth Footer Sitemap', 'twentyten' ),
		'footer6' => __( 'Sixth Footer Sitemap', 'twentyten' ),
	) );


}
endif;


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );


/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'twentyten' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'twentyten'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Notícias';
    $submenu['edit.php'][5][0] = 'Notícias';
    $submenu['edit.php'][10][0] = 'Nova Notícia';
    echo '';
}

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Notícias';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/* CURIOSIDADES */
$curiosidades_labels = array(
	'name' => _x('Curiosidades', 'post type general name'),
	'singular_name' => _x('Curiosidade', 'post type singular name'),
	'add_new' => _x('Nova Curiosidade', 'curiosidade'),
	'add_new_item' => __('Adicionar nova Curiosidade'),
	'edit_item' => __('Editar Curiosidade'),
	'new_item' => __('Nova Curiosidade'),
	'view_item' => __('Ver Curiosidade'),
	'search_items' => __('Procurar Curiosidades'),
	'not_found' =>  __('Não foram encontradas Curiosidades'),
	'not_found_in_trash' => __('Não há Curiosidades no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Curiosidades'
);
$curiosidades_args = array(
	'labels' => $curiosidades_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => false,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-other.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 26,
	'supports' => array('title')
);

/* DICAS */
$dicas_labels = array(
	'name' => _x('Dicas', 'post type general name'),
	'singular_name' => _x('Dica', 'post type singular name'),
	'add_new' => _x('Nova Dica', 'dica'),
	'add_new_item' => __('Adicionar nova Dica'),
	'edit_item' => __('Editar Dica'),
	'new_item' => __('Nova Dica'),
	'view_item' => __('Ver Dica'),
	'search_items' => __('Procurar Dicas'),
	'not_found' =>  __('Não foram encontradas Dicas'),
	'not_found_in_trash' => __('Não há Dicas no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Dicas'
);
$dicas_args = array(
	'labels' => $dicas_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-other.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 27,
	'supports' => array('editor')
);

/* PARCEIROS */
$parceiros_labels = array(
	'name' => _x('Parceiros', 'post type general name'),
	'singular_name' => _x('Parceiro', 'post type singular name'),
	'add_new' => _x('Novo Parceiro', 'parceiro'),
	'add_new_item' => __('Adicionar novo Parceiro'),
	'edit_item' => __('Editar Parceiro'),
	'new_item' => __('Novo Parceiro'),
	'view_item' => __('Ver Parceiro'),
	'search_items' => __('Procurar Parceiros'),
	'not_found' =>  __('Não foram encontrados Parceiros'),
	'not_found_in_trash' => __('Não há Parceiros no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Parceiros'
);
$parceiros_args = array(
	'labels' => $parceiros_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 26,
	'supports' => array('title', 'thumbnail')
);

/* ALBUM FOTOS */
$albuns_labels = array(
	'name' => _x('Albuns', 'post type general name'),
	'singular_name' => _x('Album', 'post type singular name'),
	'add_new' => _x('Novo Album', 'album'),
	'add_new_item' => __('Adicionar novo Album'),
	'edit_item' => __('Editar Album'),
	'new_item' => __('Novo Album'),
	'view_item' => __('Ver Album'),
	'search_items' => __('Procurar Album'),
	'not_found' =>  __('Não foram encontrados Albuns'),
	'not_found_in_trash' => __('Não há Albuns no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Albuns'
);
$albuns_args = array(
	'labels' => $albuns_labels,
	'public' => false,
	'publicly_queryable' => true,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-image.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'page',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 30,
	'supports' => array('title', 'thumbnail', 'editor')
);

/* DEPOIMENTOS */
$depoimentos_labels = array(
	'name' => _x('Depoimentos', 'post type general name'),
	'singular_name' => _x('Depoimento', 'post type singular name'),
	'add_new' => _x('Novo Depoimento', 'depoimento'),
	'add_new_item' => __('Adicionar novo Depoimento'),
	'edit_item' => __('Editar Depoimento'),
	'new_item' => __('Novo Depoimento'),
	'view_item' => __('Ver Depoimento'),
	'search_items' => __('Procurar Depoimentos'),
	'not_found' =>  __('Não foram encontrados Depoimentos'),
	'not_found_in_trash' => __('Não há Depoimentos no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Depoimentos'
);
$depoimentos_args = array(
	'labels' => $depoimentos_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-other.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 28,
	'supports' => array('editor', 'title', 'thumbnail')
);

/* TELEFONES ÚTEIS */
$telefones_labels = array(
	'name' => _x('Telefones Úteis', 'post type general name'),
	'singular_name' => _x('Telefone', 'post type singular name'),
	'add_new' => _x('Novo Telefone', 'telefone'),
	'add_new_item' => __('Adicionar novo Telefone'),
	'edit_item' => __('Editar Telefone'),
	'new_item' => __('Novo Telefone'),
	'view_item' => __('Ver Telefone'),
	'search_items' => __('Procurar Telefones'),
	'not_found' =>  __('Não foram encontrados Telefones'),
	'not_found_in_trash' => __('Não há Telefones no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Telefones'
);
$telefones_args = array(
	'labels' => $telefones_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 24,
	'supports' => array('title')
);

/* MAPAS */
$mapas_labels = array(
	'name' => _x('Mapas', 'post type general name'),
	'singular_name' => _x('Mapa', 'post type singular name'),
	'add_new' => _x('Novo Mapa', 'mapa'),
	'add_new_item' => __('Adicionar novo Mapa'),
	'edit_item' => __('Editar Mapa'),
	'new_item' => __('Novo Mapa'),
	'view_item' => __('Ver Mapa'),
	'search_items' => __('Procurar Mapas'),
	'not_found' =>  __('Não foram encontrados Mapas'),
	'not_found_in_trash' => __('Não há Mapas no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Mapas'
);
$mapas_args = array(
	'labels' => $mapas_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 23,
	'supports' => array('title', 'editor')
);

/* EVENTOS */
$eventos_labels = array(
	'name' => _x('Eventos', 'post type general name'),
	'singular_name' => _x('Evento', 'post type singular name'),
	'add_new' => _x('Novo Evento', 'evento'),
	'add_new_item' => __('Adicionar novo Evento'),
	'edit_item' => __('Editar Evento'),
	'new_item' => __('Novo Evento'),
	'view_item' => __('Ver Evento'),
	'search_items' => __('Procurar Evento'),
	'not_found' =>  __('Não foram encontrados Eventos'),
	'not_found_in_trash' => __('Não há Eventos no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Eventos'
);
$eventos_args = array(
	'labels' => $eventos_labels,
	'public' => false,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => true,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/date-button.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 21,
	'supports' => array('title')
);

/* SERVIÇOS */
$servicos_labels = array(
	'name' => _x('Serviços', 'post type general name'),
	'singular_name' => _x('Serviço', 'post type singular name'),
	'add_new' => _x('Novo Serviço', 'servico'),
	'add_new_item' => __('Adicionar novo Serviço'),
	'edit_item' => __('Editar Serviço'),
	'new_item' => __('Novo Serviço'),
	'view_item' => __('Ver Serviço'),
	'search_items' => __('Procurar Serviço'),
	'not_found' =>  __('Não foram encontrados Serviços'),
	'not_found_in_trash' => __('Não há Serviços no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Serviços'
);
$servicos_args = array(
	'labels' => $servicos_labels,
	'public' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => false,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-video.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 22,
	'supports' => array('title', 'thumbnail')
);

/* PUBLICAÇÕES */
$publicacoes_labels = array(
	'name' => _x('Publicações Oficials', 'post type general name'),
	'singular_name' => _x('Publicação Oficial', 'post type singular name'),
	'add_new' => _x('Nova Publicação Oficial', 'publicacao'),
	'add_new_item' => __('Adicionar nova Publicação Oficial'),
	'edit_item' => __('Editar Publicação Oficial'),
	'new_item' => __('Nova Publicação Oficial'),
	'view_item' => __('Ver Publicação Oficial'),
	'search_items' => __('Procurar Publicação Oficial'),
	'not_found' =>  __('Não foram encontradas Publicações Oficiais'),
	'not_found_in_trash' => __('Não há Publicações Oficiais no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Publicações Oficiais'
);
$publicacoes_args = array(
	'labels' => $publicacoes_labels,
	'public' => true,
	'publicly_queryable' => false,
	'show_ui' => true,
	'exclude_from_search' => false,
	'show_in_menu' => true,
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 31,
	'supports' => array('title')
);

/* ATRATIVOS */
$atrativos_labels = array(
	'name' => _x('Atrativos', 'post type general name'),
	'singular_name' => _x('Atrativo', 'post type singular name'),
	'add_new' => _x('Novo Atrativo', 'atrativo'),
	'add_new_item' => __('Adicionar novo Atrativo'),
	'edit_item' => __('Editar Atrativo'),
	'new_item' => __('Novo Atrativo'),
	'view_item' => __('Ver Atrativo'),
	'search_items' => __('Procurar Atrativos'),
	'not_found' =>  __('Não foram encontrados Atrativos'),
	'not_found_in_trash' => __('Não há Atrativos no lixo'), 
	'parent_item_colon' => '',
	'menu_name' => 'Atrativos'
);
$atrativos_args = array(
	'labels' => $atrativos_labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'exclude_from_search' => false,
	'show_in_menu' => true,
	'menu_icon' => get_bloginfo('url') . '/wp-admin/images/media-button-other.gif',
    'query_var' => true,
	'rewrite' => true,
	'capability_type' => 'page',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => 15,
	'supports' => array('title', 'editor', 'thumbnail')
);

register_post_type('atrativo',$atrativos_args);
register_post_type('evento',$eventos_args);
register_post_type('servico',$servicos_args);
register_post_type('mapa',$mapas_args);
register_post_type('telefone',$telefones_args);
register_post_type('curiosidade',$curiosidades_args);
register_post_type('dica',$dicas_args);
register_post_type('parceiro',$parceiros_args);
register_post_type('depoimento',$depoimentos_args);
register_post_type('album',$albuns_args);
register_post_type('publicacao',$publicacoes_args);

/* COLOCAR CURRENT EM ITEM DE MENU DEPENDENDO DO TIPO DE POST */
function remove_parent($var)
{
	// check for current page values, return false if they exist.
	if ($var == 'current_page_parent' || $var == 'current-menu-item' || $var == 'current-page-ancestor') { return false; }
	return true;
}

function tg_add_class_to_menu($classes)
{
	// team is my custom post type
	$term = wp_get_post_terms($post->ID, 'experimente', 'name' ); $experimente = $term[0]->slug;
	if (get_post_type() == 'atrativo' || get_post_type() == 'album')
	{
		// we're viewing a custom post type, so remove the 'current-page' from all menu items.
		$classes = array_filter($classes, "remove_parent");

		// add the current page class to a specific menu item.
		if (in_array('menu-item-13', $classes)) $classes[] = 'current-menu-parent';
	}
	elseif (get_post_type() == 'post')
	{
		// we're viewing a custom post type, so remove the 'current-page' from all menu items.
		$classes = array_filter($classes, "remove_parent");

		// add the current page class to a specific menu item.
		if (in_array('menu-item-112', $classes)) $classes[] = 'current-menu-parent';
	}

	return $classes;
}

if (!is_admin()) { add_filter('nav_menu_css_class', 'tg_add_class_to_menu'); }

function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'), __('Comments'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');

function remove_submenus() {
  global $submenu;
  //unset($submenu['index.php'][10]); // Removes 'Updates'.
  unset($submenu['themes.php'][5]); // Removes 'Themes'.
  //unset($submenu['options-general.php'][15]); // Removes 'Writing'.
  //unset($submenu['options-general.php'][25]); // Removes 'Discussion'.
  unset($submenu['edit.php'][15]); // Removes 'Categories'.
  unset($submenu['edit.php'][16]); // Removes 'Tags'.  
  unset($submenu['edit.php?post_type=servico'][15]); // Taxonomy.
  unset($submenu['edit.php?post_type=evento'][15]); // Taxonomy.
  unset($submenu['edit.php?post_type=atrativo'][15]); // Taxonomy.
  unset($submenu['themes.php'][7]); // Widgets
  unset($submenu['themes.php'][11]); // Gallery Cleaner
  unset($submenu['plugins.php'][15]); // Editor de Plugins
  unset($submenu['tools.php'][5]); // Ferramentas Sub
}

add_action('admin_menu', 'remove_submenus');

/* REMOVER O EDITOR DO ADMIN */
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);

function customize_meta_boxes() {
  /* Removes meta boxes from Posts */
  remove_meta_box('postcustom','post','normal');
  remove_meta_box('trackbacksdiv','post','normal');
  remove_meta_box('commentstatusdiv','post','normal');
  remove_meta_box('commentsdiv','post','normal');
  remove_meta_box('tagsdiv-post_tag','post','normal');
  remove_meta_box('postexcerpt','post','normal');
  remove_meta_box('slugdiv','post','normal');
  remove_meta_box('authordiv','post','normal');
  remove_meta_box('categorydiv','post','normal');
  /* Removes meta boxes from pages */
  remove_meta_box('postcustom','page','normal');
  remove_meta_box('trackbacksdiv','page','normal');
  remove_meta_box('commentstatusdiv','page','normal');
  remove_meta_box('commentsdiv','page','normal'); 
  remove_meta_box('slugdiv','page','normal');
  remove_meta_box('authordiv','page','normal');
}

add_action('admin_init','customize_meta_boxes');

/* COLUNAS MOSTRADAS NOS POSTS E PAGINAS */
function custom_post_columns($defaults) {
  unset($defaults['comments']);
  unset($defaults['author']);
  unset($defaults['categories']);
  unset($defaults['tags']);
  return $defaults;
}

add_filter('manage_posts_columns', 'custom_post_columns');

function custom_pages_columns($defaults) {
  unset($defaults['comments']);
  unset($defaults['author']);
  return $defaults;
}

add_filter('manage_pages_columns', 'custom_pages_columns');

/* MENU DE ACOES FAVORITAS */
function custom_favorite_actions($actions) {
  unset($actions['edit-comments.php']);
  return $actions;
}

add_filter('favorite_actions', 'custom_favorite_actions');

/* TEXTO DO RODAPÉ DO ADMIN */
function modify_footer_admin () {
  echo 'Criado por <a href="http://gustavoguichard.com">Gustavo Guichard</a> e <a href="http://criaideias.com.br">Cria Ideias</a>.';
  echo ' Suportado por <a href="http://WordPress.org">WordPress</a>.';
}

add_filter('admin_footer_text', 'modify_footer_admin');

/* LOGOTIPO DO AMIN */
function custom_logo() {
  echo '<style type="text/css">
    #header-logo { background-image: url(http://www.criaideias.com.br/images/cria.png) !important; height: 30px !important; width: 17px !important; position: relative; margin-top: 1px !important; }
    </style>';
}

add_action('admin_head', 'custom_logo');

/* LOGOTIPO DO LOGIN */
function custom_login_logo() {
  echo '<style type="text/css">
    #login{width:600px;}
    h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important;
    width:600px; height: 150px; }
    </style>';
}

add_action('login_head', 'custom_login_logo');

/* DESABILITAR AVISO DE ATUALIZAÇÃO */
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// add google analytics to footer
function add_google_analytics() {
	echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
	echo '<script type="text/javascript">';
	echo 'var pageTracker = _gat._getTracker("UA-' . get_option('google_analytics') . '");';
	echo 'pageTracker._trackPageview();';
	echo '</script>';
}
add_action('wp_footer', 'add_google_analytics');

function remove_admin_bar_links() {
	global $wp_admin_bar;
	//$wp_admin_bar->remove_menu('my-blogs');
	$wp_admin_bar->add_menu( array(
        'parent' => 'new-content',
        'id' => 'new_noticia',
        'title' => __('Notícia'),
        'href' => admin_url( 'post-new.php?post_type=post')
    ));
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-post');
	$wp_admin_bar->remove_menu('new-page');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Opções do Site', 'Opções do Site', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2>Opções do Site</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Código do Google Analytics:</strong></p>
	<p>
		<input type="text" name="google_analytics" id="google_analytics" value="<?php echo get_option('google_analytics');?>" />
	</p>
	<p><input type="submit" name="Submit" value="Salvar Alterações" /></p>
	
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="google_analytics" />

	</form>
	</div>
	<?php
}

/* Publicações Oficiais */
add_action( 'add_meta_boxes', 'add_meta_box_add' );  
function add_meta_box_add()  
{  
	add_meta_box( 'adds_pdfs', 'Arquivos de PDF', 'add_pdf_metabox', 'publicacao', 'normal', 'high' );
}

function add_pdf_metabox( $post ){
	$values = get_post_custom( $post->ID );
	$pdf_file = isset( $values['pdf_file'] ) ? esc_attr( $values['pdf_file'][0] ) : '';  
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
  ?>
	<p>
		<input id="pdf_file" type="text" size="36" name="pdf_file" value="<?=$pdf_file;?>" />
		<input id="upload_pdf_button" class="upload_pdf_button" type="button" value="Escolher Arquivo" />
		<label for="pdf_file">Arquivo PDF da publicação.</label>
	</p>
	<?php
}

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_bloginfo('template_url') . '/js/uploader_metabox.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts-post-new.php', 'my_admin_scripts');
add_action('admin_print_styles-post-new.php', 'my_admin_styles');

add_action( 'save_post', 'cd_meta_box_save' );  
function cd_meta_box_save( $post_id )  
{  
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;  
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;
      
    // Make sure your data is set before trying to save it  
    if( isset( $_POST['pdf_file'] ) )  
        update_post_meta( $post_id, 'pdf_file', esc_attr( $_POST['pdf_file'] ) );
}