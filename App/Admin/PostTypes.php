<?php
namespace LawtestManager\AdminPackage;

class PostTypes {

	public function __construct() {
		register_post_type( 'crb_test', array(
			'labels' => array(
				'name' => __( 'Test', 'crb' ),
				'singular_name' => __( 'Test', 'crb' ),
				'add_new' => __( 'Add New', 'crb' ),
				'add_new_item' => __( 'Add new Test', 'crb' ),
				'view_item' => __( 'View Test', 'crb' ),
				'edit_item' => __( 'Edit Test', 'crb' ),
				'new_item' => __( 'New Test', 'crb' ),
				'view_item' => __( 'View Test', 'crb' ),
				'search_items' => __( 'Search Test', 'crb' ),
				'not_found' =>  __( 'No tests found', 'crb' ),
				'not_found_in_trash' => __( 'No tests found in trash', 'crb' ),
			),
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'_edit_link' => 'post.php?post=%d',
			'rewrite' => array(
				'slug' => 'test',
				'with_front' => false,
			),
			'query_var' => true,
			'menu_icon' => 'dashicons-plus',
			'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
		) );

		register_post_type( 'crb_juridical_q', array(
			'labels' => array(
				'name' => __( 'Juridical Question', 'crb' ),
				'singular_name' => __( 'Juridical Question', 'crb' ),
				'add_new' => __( 'Add New', 'crb' ),
				'add_new_item' => __( 'Add new Juridical Question', 'crb' ),
				'view_item' => __( 'View Juridical Question', 'crb' ),
				'edit_item' => __( 'Edit Juridical Question', 'crb' ),
				'new_item' => __( 'New Juridical Question', 'crb' ),
				'view_item' => __( 'View Juridical Question', 'crb' ),
				'search_items' => __( 'Search Juridical Question', 'crb' ),
				'not_found' =>  __( 'No juridical Questions found', 'crb' ),
				'not_found_in_trash' => __( 'No juridical Questions found in trash', 'crb' ),
			),
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'_edit_link' => 'post.php?post=%d',
			'rewrite' => array(
				'slug' => 'juridical-question',
				'with_front' => false,
			),
			'query_var' => true,
			'menu_icon' => 'dashicons-plus',
			'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
		) );
	}
}
