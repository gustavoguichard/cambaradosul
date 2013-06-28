<?php
/**
 * Template Name: Home Page
 *
 * A custom page template for the Home.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Cambará do Sul  pp Possibilidade de pancadas, pc Pancadas de Chuva, pn Parcialmente nublado, vn Variação de Nebulosidade, np Nublado e Pancadas
 * @since Starkers 1.0
 */

get_header(); ?>

<div id="foto360">
	<?php
		$swfs = array("fortaleza", "itaimbezinho");
		shuffle($swfs);
	?>
	<div id="bannerFlash"><img src="<?php bloginfo('template_url');?>/images/canions.jpg" alt="Foto dos Cânions" /></div>
</div>
<div id="home_content" class="grid_12">
	
	<div id="experimente" class="grid_9 alpha fullbox">
		<h2 class="grid_9 alpha">Experimente Cambará</h2>
		<ul class="experimente_list">
			<?php $page_id = get_page_by_title('contemplacao'); $page_id = $page_id->ID; $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'experimente_thumb');?>
			<li><a href="<?php echo get_permalink($page_id);?>" id="contemplacao" style="background-image: url(<?=$thumb[0]?>);"><strong>Contemplação</strong></a></li>
			<?php $page_id = get_page_by_title('aventura'); $page_id = $page_id->ID; $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'experimente_thumb');?>
			<li><a href="<?php echo get_permalink($page_id);?>" id="aventura" style="background-image: url(<?=$thumb[0]?>);"><strong>Aventura</strong></a></li>
			<?php $page_id = get_page_by_title('gastronomia'); $page_id = $page_id->ID; $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'experimente_thumb');?>
			<li><a href="<?php echo get_permalink($page_id);?>" id="gastronomia" style="background-image: url(<?=$thumb[0]?>);"><strong>Gastronomia</strong></a></li>
		</ul>
	</div>
	
	<div id="poll" class="grid_3 omega fullbox">
		<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
		    <h3>Enquete</h3>
			<?php get_poll();?>
		<?php endif; ?>
	</div>
	
	<div class="grid_4 alpha">
		
		<a id="cambaraonline" href="http://turismocambara.wordpress.com/" title="Ir para o blog de notícias" class="box">
			<h3>Em dia com o Turísmo <small>Acesse o Blog de Notícias</small></h3>
		</a>
		
		<div class="box" id="curiosidades">
			<h3>Você sabia que:</h3>
			<?php $my_query = new WP_Query("post_type=curiosidade&showposts=1&orderby=rand"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
				<p><?php the_title();?></p>
			<?php endwhile; wp_reset_query(); ?>
			<a class="more_link" href="<?php echo get_permalink_by_name('curiosidades'); ?>">ver mais curiosidades</a>
		</div>
		
	</div>
	
	<div class="grid_4 fullbox" id="news">
		<h3>Notícias</h3>
		<?php $my_query = new WP_Query("post_type=post&showposts=2"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<div class="new">
				<p><?php the_post_thumbnail('news_thumb');?><?php the_title();?></p>
				<a class="more_link" href="<?php the_permalink();?>">ir para notícia</a>
			</div>
		<?php endwhile; wp_reset_query(); ?>		
	</div>
	
	<?php include_once('weather.php');?>
	<?php if($xml){?>
	<div class="grid_4 omega fullbox" id="weather">
	
	
		<h3>Previsão do tempo</h3>
		<div id="today_weather">
		<?php echo getWeatherImage($xml->previsao[0]->tempo, false); ?>
			<span id="week_day"><?php echo $array_days_full[$week_day]; ?></span>
			<span id="max_temp" class="temp">max: <strong><?php echo $xml->previsao[0]->maxima; ?>°</strong></span>
			<span id="min_temp" class="temp">min: <strong><?php echo $xml->previsao[0]->minima; ?>°</strong></span>
			<span id="actual_temp"><?php echo $actual_grad; ?></span>
		</div>
		<div id="other_days_weather">
			<?php $i = 1 ; while($i<=3){ ?>
			<div class="next_days_weather">
				<?php $day_min = $week_day + $i > 6 ? $week_day + $i - 7 : $week_day + $i;?>
				<span class="week_day"><?php echo $array_days[$day_min]; ?></span>
				<?php echo getWeatherImage($xml->previsao[$i]->tempo, true); ?>
				<span class="temp">max: <strong><?php echo $xml->previsao[$i]->maxima;?>°</strong></span>
				<span class="temp">min: <strong><?php echo $xml->previsao[$i]->minima;?>°</strong></span>
			</div>
			<?php $i++;?>
			<?php } ?>
		</div>
	</div>
	<?php } else {?>
	<div class="grid_4 omega fullbox" id="news">
		<h3>Notícias</h3>
		<?php $my_query = new WP_Query("post_type=post&showposts=2&offset=2"); while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<div class="new">
				<p><?php the_post_thumbnail('news_thumb');?><?php the_title();?></p>
				<a class="more_link" href="<?php the_permalink();?>">ir para notícia</a>
			</div>
		<?php endwhile; wp_reset_query(); ?>		
	</div>
	<?php } ?>
</div>

<?php get_footer(); ?>
