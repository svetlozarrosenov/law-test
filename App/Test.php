<?php
namespace App\Test;

class Test {

	public function __construct() {
		add_action('wp_footer', function() {
			if ( ! get_page_template_slug() == 'products.php' && ! is_singular('crb_test') ) {
				echo '<div id="app"></div>';
			}
		});
	}

	public static function isTestPage() {
		return is_singular( 'crb_test' );
	}

	public static function getQuestions() {  
		if ( ! self::isTestPage() ) {
			wp_send_json_success( [
    			'error' => 'not a test page',
			] );

			return;
		}

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