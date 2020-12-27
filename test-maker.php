<?php
/**
* @package Test Maker
*/
/*
Plugin Name: Test Maker 
Description: This plugin helps you to create tests.
Version 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die;
}
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use App\Test\Admin;

class TestMaker {
	public function __construct() {
		require 'vendor/autoload.php';

		add_action('after_setup_theme', function() {
			new App\Test\Paywall();
		} );

		$admin = new App\Test\Admin();

		add_action( 'wp_ajax_crb_ajax_get_questions', 'crb_ajax_get_questions' );
		add_action( 'wp_ajax_nopriv_crb_ajax_get_questions', 'crb_ajax_get_questions' );

		function crb_ajax_get_questions() {  

			$testID = isset( $_POST['postID'] ) ? $_POST['postID'] : false;

			$numberOfQuestions = carbon_get_post_meta( $testID, 'crb_test_of_questions' );

			$testTime = carbon_get_post_meta( $testID, 'crb_test_time' );

			$terms = carbon_get_post_meta( $testID, 'crb_test_categories' );

			if ( empty( $terms ) ) {
				return false;
			}

			$termIDs = [];
			foreach ( $terms as $term ) {
				$termIDs[] = $term['id'];
			}


			$questions_loop = new WP_Query( array(
				'post_type' => 'crb_juridical_q',
				'posts_per_page' => $numberOfQuestions,
				'orderby' => 'rand',
				'tax_query' => array(
			        array(
			            'taxonomy' => 'crb_juridical_q_category',
			            'field'    => 'term_id',
			            'terms'    => $termIDs
			        )
			    )
			) );			

			$questions = [];

			$index = 0;
			while ( $questions_loop->have_posts() ) {
				$questions_loop->the_post();
				
				$show = false;
				if ( $index === 0 ) {
					$firstIteration = false;
					$show = true;
				}

				$questions[ $index ] = [
					'question' => get_the_title(),
					'info' => get_the_content(),
					'answers' => carbon_get_the_post_meta('crb_juridical_q_answers'),
					'answered' => false,
					'show' => $show,
				];

				foreach ( $questions[ $index ]['answers'] as $key => &$answer ) {
					$answer['answer_class'] = false;
				}

				$index++;
			}

			wp_reset_postdata();

			wp_send_json_success( [
        		'questions' => $questions,
        		'domain' => get_site_url() . DIRECTORY_SEPARATOR,
        		'time' => $testTime,
  			] );
		}
	}

	public function activate() {

	}

	public function deactivate() {}
}

$testMaker = new TestMaker();


register_activation_hook( __FILE__, array( $testMaker, 'activate' ) );

register_deactivation_hook( __FILE__, array( $testMaker, 'deactivate' ) );