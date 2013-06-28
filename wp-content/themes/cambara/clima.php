<?php
/**
 * Template Name: Clima Page
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
<div id="content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h2><?php the_title(); ?></h2>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h3>Previsão do tempo</h3>
		<div class="grid_4 alpha fullbox" id="weather">
		<?php include_once('weather.php');?>
			<div id="today_weather">
				<?php if($xml){
					echo getWeatherImage($xml->previsao[0]->tempo, false); ?>
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
				<?php } else { echo '<span id="week_day">Previsão do tempo temporariamente indisponível</span>';};?>
			</div>
		</div>
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>