<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Coffins.
	 */

	$labels = array(
		"name" => __( 'Coffins', '' ),
		"singular_name" => __( 'Coffin', '' ),
	);

	$args = array(
		"label" => __( 'Coffins', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "coffin", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "dashicons-archive",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "coffin", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_cpts_coffin() {

	/**
	 * Post Type: Coffins.
	 */

	$labels = array(
		"name" => __( 'Coffins', '' ),
		"singular_name" => __( 'Coffin', '' ),
	);

	$args = array(
		"label" => __( 'Coffins', '' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => true,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "coffin", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "dashicons-archive",
		"supports" => array( "title", "editor", "thumbnail" ),
	);

	register_post_type( "coffin", $args );
}

add_action( 'init', 'cptui_register_my_cpts_coffin' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Coffin Categories.
	 */

	$labels = array(
		"name" => __( 'Coffin Categories', '' ),
		"singular_name" => __( 'Coffin Category', '' ),
	);

	$args = array(
		"label" => __( 'Coffin Categories', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Coffin Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'coffin_categories', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "coffin_categories", array( "coffin" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes' );

function cptui_register_my_taxes_coffin_categories() {

	/**
	 * Taxonomy: Coffin Categories.
	 */

	$labels = array(
		"name" => __( 'Coffin Categories', '' ),
		"singular_name" => __( 'Coffin Category', '' ),
	);

	$args = array(
		"label" => __( 'Coffin Categories', '' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Coffin Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'coffin_categories', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "coffin_categories", array( "coffin" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_coffin_categories' );
