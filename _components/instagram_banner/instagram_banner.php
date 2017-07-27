<?php

/**
* Theme for instagram_banner
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
	'picture_count' => 10,
	'username' => ''
);

/**
* Instagram_banner
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/



if (!function_exists('instagram_banner')) {
	function instagram_banner(array $args) {
		if (empty($args['username'])) $args['username'] = 'instagram'; // default username to get always a response
		$instagram = explode('/', $args['username']);
		$account = $instagram[count($instagram) - 1];
		$i = 0;
		ob_start(); ?>
		<div <?= $args['id'] ?> class="instagram-banner--wrap <?= $args['classes'] ?>">
			<div class="title center relative wrap">
				<?php if(get_field('instagram_title', 3)): while(has_sub_field('instagram_title', 3)): ?>
					<?php if(get_sub_field('bold')): ?>
						<h2><?php the_sub_field('bold'); ?></h2>
					<?php endif; ?>
					<?php if(get_sub_field('light')): ?>
						<h3><?php the_sub_field('light'); ?></h3>
					<?php endif; ?>
				<?php endwhile; endif; ?>
			</div>
			<div class="instagram-banner--row">
				<?php foreach (scrape_insta($account) as $item) : $i++; ?>
					<a target="_blank" class="instagram-banner--item" href="<?= $item['link'] ?>"><img src="<?= $item['images']['standard_resolution']['url'] ?>"></a>
					<?php
					if($i === $args['picture_count']) break;
				endforeach; ?>
			</div>
		</div>
		<?php return ob_get_clean();
	}
}

/**
* Scrape_insta
*
* Gets a json array from instagram containing images
*
* @param    (string)      the username of the instagram user to pull the images form
* @return   (array)       all images and data
*/
if (!function_exists('scrape_insta')) {
	function scrape_insta($username) {
		require_once(get_stylesheet_directory() . '/_functions/cache.php');
		$cache = new cache(WP_CONTENT_DIR . '/cache');
		if (!($insta_source = $cache->get('insta_source'))) {
			$insta_source = file_get_contents('http://instagram.com/' . $username . '/media');
			$cache->set('insta_source', $insta_source);
		}
		$insta_array = json_decode($insta_source, TRUE);
		return $insta_array['items'];
	}
}
