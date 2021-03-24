<?php
namespace LawtestManager\AdminPackage;

class Taxonomies {

	public function __construct() {
		register_taxonomy(
			'crb_juridical_q_category', # Taxonomy name
			array( 'crb_juridical_q' ), # Post Types
			array( # Arguments
				'labels'            => array(
					'name'                       => __( 'Categories', 'crb' ),
					'singular_name'              => __( 'category', 'crb' ),
					'search_items'               => __( 'Search Categories', 'crb' ),
					'popular_items'              => __( 'Popular Categories', 'crb' ),
					'all_items'                  => __( 'All Categories', 'crb' ),
					'view_item'                  => __( 'View category', 'crb' ),
					'edit_item'                  => __( 'Edit category', 'crb' ),
					'update_item'                => __( 'Update category', 'crb' ),
					'add_new_item'               => __( 'Add New category', 'crb' ),
					'new_item_name'              => __( 'New category Name', 'crb' ),
					'separate_items_with_commas' => __( 'Separate Categories with commas', 'crb' ),
					'add_or_remove_items'        => __( 'Add or remove Categories', 'crb' ),
					'choose_from_most_used'      => __( 'Choose from the most used Categories', 'crb' ),
					'not_found'                  => __( 'No Categories found.', 'crb' ),
					'menu_name'                  => __( 'Categories', 'crb' ),
				),
				'show_in_rest' => true,
				'hierarchical'          => true,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var'             => true,
				'rewrite'               => array( 'slug' => 'juridical-question-category' ),
			)
		);
	}
}
