<?php

/**
* Theme for gravity_form_include
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/

$custom_args = array(
	'form_id' => false,
	'class' => false,
);

/**
* gravity_form_include
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

if (!function_exists('gravity_form_include')) {
	function gravity_form_include(array $args) {
		$id = $args['form_id'];
		$class = $args['class'];
		$tab_index = rand(1,100);
		ob_start(); ?>
			<div class="gravity-form-include <?php echo $class; ?>">
				<?php if ($id): ?>
					<?php gravity_form($id, false, false, false, '', true, $tab_index); ?>
				<?php endif; ?>
			</div>
		<?php return ob_get_clean();
	}
}
