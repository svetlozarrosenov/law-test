<?php
namespace LawtestManager\TestPackage;

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class Admin {
	
	public function __construct() {
		add_filter( 'body_class', function( $classes, $class ) {
			$classes[] = 'products-page';

			return $classes;
		}, 10, 2 );

		$this->bootCarbonfields();
		$this->createCustomPostTypeTemplate();
		$this->loadAssets();
		$this->addCustomTemplates();
	}	

	public function bootCarbonfields() {
		add_action( 'after_setup_theme', function(){
			
			\Carbon_Fields\Carbon_Fields::boot();			
			
			$this->createPostTypes()
				->createTaxonomies()
				->createTestMeta()
				->createUserMeta();
		} );
	}

	public function loadAssets() {
		add_action('wp_enqueue_scripts', function() {
    		wp_enqueue_style('test-maker-css', plugins_url('assets/dist/css/all.min.css',dirname(__FILE__)));

			wp_enqueue_script('test-maker-stripe', 'https://js.stripe.com/v3/', [], false, true);

    		wp_enqueue_script('test-maker-js', plugins_url('assets/dist/js/main.js',dirname(__FILE__)), ['test-maker-stripe'], false, true);

    		wp_localize_script( 'test-maker-js', 'crb_site_utils', [
				'ajaxurl' => admin_url( 'admin-ajax.php'),
				'postID' => get_the_ID(),
			] );
		} );
	}

	public function createPostTypes() {

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

		register_post_type( 'crb_product', array(
			'labels' => array(
				'name' => __( 'Product', 'crb' ),
				'singular_name' => __( 'Product', 'crb' ),
				'add_new' => __( 'Add New', 'crb' ),
				'add_new_item' => __( 'Add new Product', 'crb' ),
				'view_item' => __( 'View Product', 'crb' ),
				'edit_item' => __( 'Edit Product', 'crb' ),
				'new_item' => __( 'New Product', 'crb' ),
				'view_item' => __( 'View Product', 'crb' ),
				'search_items' => __( 'Search Product', 'crb' ),
				'not_found' =>  __( 'No products found', 'crb' ),
				'not_found_in_trash' => __( 'No products found in trash', 'crb' ),
			),
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'_edit_link' => 'post.php?post=%d',
			'rewrite' => array(
				'slug' => 'product',
				'with_front' => false,
			),
			'query_var' => true,
			'menu_icon' => 'dashicons-plus',
			'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
		) );

		return $this;
	}

	public function createTaxonomies() {
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

		return $this;
	}

	public function createCustomPostTypeTemplate() {
		add_filter('template_include', function( $template ) {
		    $post_types = array('crb_test');
		    
		    if ( is_singular( $post_types ) ) {
		        $template = Loader::render('single-test-page');
		    }

		    return $template;			
		});
	}

	public function createTestMeta() {
		Container::make( 'post_meta', __( 'Test Custom Settings', 'crb' ) )
			->where( 'post_type', '=', 'crb_test' )
			->add_fields( array(
				Field::make( 'association', 'crb_test_categories', __( 'Categories', 'crb' ) )
					->set_types( array( 
						array(
				            'type' => 'term',
				            'taxonomy' => 'crb_juridical_q_category',
				        ),
					) ),
				Field::make( 'text', 'crb_test_of_questions', __( 'Number of Questions', 'crb' ) ),
				Field::make( 'text', 'crb_test_time', __( 'Time', 'crb' ) )
					->set_help_text('Should be in minutes', 'crb')
					->set_default_value(60),
			) );

		Container::make( 'post_meta', __( 'Juridical Question Settings', 'crb' ) )
			->where( 'post_type', '=', 'crb_juridical_q' )
			->add_fields( array(
				Field::make( 'complex', 'crb_juridical_q_answers', __( 'Answers', 'crb' ) )
					->add_fields( array( 
						Field::make( 'text', 'answer', __( 'Answer', 'crb' ) ),
						Field::make( 'checkbox', 'right_answer', __( 'It\'s the right answer', 'crb' ) ),
					) )
					->set_header_template('<%- answer %>')
					->set_layout('tabbed-vertical'),
			) );

			Container::make( 'post_meta', __( 'Product Settings', 'crb' ) )
				->where( 'post_type', '=', 'crb_product' )
				->add_fields( array(
					Field::make( 'text', 'crb_product_price', __( 'Price', 'crb' ) ),
					Field::make( 'complex', 'crb_product_features', __( 'Features', 'crb' ) )
						->add_fields( array(
							Field::make( 'text', 'title', __( 'Title', 'crb' ) ),
						) )
						->set_layout('tabbed-vertical')
						->set_header_template('<%- title %>')
				) );

		return $this;
	}
	public function createUserMeta() {
		Container::make( 'user_meta', 'Order Settings' )
		    ->add_fields( array(
		        Field::make( 'text', 'crb_user_order_id', __( 'Order ID', 'crb' ) ),
		        Field::make( 'text', 'crb_user_start_date', __( 'Start Date', 'crb' ) ),
		        Field::make( 'text', 'crb_user_end_date', __( 'End Date', 'crb' ) ),
		        Field::make( 'text', 'crb_user_order_status', __( 'Order Status', 'crb' ) ),
		        Field::make( 'checkbox', 'crb_user_subscription_status', __( 'Active Subscription', 'crb' ) ),
		    ) );
		    
		return $this;
	}
	public function addCustomTemplates() {
		add_filter( 'page_template', function( $page_template ) {
		    if ( get_page_template_slug() == 'test-checkout.php' ) {
		        $page_template = dirname( __FILE__ ) . '../../templates/checkout.php';
		    }

		    if ( get_page_template_slug() == 'products.php' ) {
		        $page_template = dirname( __FILE__ ) . '../../templates/products.php';
		    }

		    return $page_template;
		} );

		add_filter( 'theme_page_templates', function( $post_templates, $wp_theme, $post, $post_type ) {
		    // Add custom template named template-custom.php to select dropdown 
		    $post_templates['test-checkout.php'] = __( 'Test Checkout Page', 'crb' );

		    $post_templates['products.php'] = __( 'Products', 'crb' );

		    return $post_templates;
		}, 10, 4 );
	}
}
