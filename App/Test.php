<?php
namespace LawtestManager\TestPackage;

class Test {

	public function __construct() {
		add_action('wp_footer', function() {
			if ( ! get_page_template_slug() == 'products.php' && ! is_singular('crb_test') ) {
				echo '<div id="app"></div>';
			}
		});

		add_action('wp_loaded', function() {
			add_action( 'wp_ajax_crb_ajax_start_app', array('LawtestManager\TestPackage\Test', 'startApp') );
			add_action( 'wp_ajax_nopriv_crb_ajax_start_app', array('LawtestManager\TestPackage\Test', 'startApp') );
		} );
	}

	public static function startApp() {
		$postType = get_post_type( $_POST['postID'] );

		$test = self::getTest();

		wp_send_json_success( [
    		'showTest' => $postType === 'crb_test',
    		'isProductPage' => false, 
    		'isLoggedIn' => false,
    		'test' => [
    			'questions' => $test['questions'],
    			'domain' => $test['domain'],
    			'testTime' => absint( $test['testTime'] ),
    		],
		] );
	}

	public static function getTest() {  

		$testID = isset( $_POST['postID'] ) ? $_POST['postID'] : false;

		$numberOfQuestions = \carbon_get_post_meta( $testID, 'crb_test_of_questions' );

		$testTime = \carbon_get_post_meta( $testID, 'crb_test_time' );

		$terms = \carbon_get_post_meta( $testID, 'crb_test_categories' );

		if ( empty( $terms ) ) {
			return false;
		}

		$termIDs = [];
		foreach ( $terms as $term ) {
			$termIDs[] = $term['id'];
		}

		$questions_loop = new \WP_Query( array(
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

		return [
    		'questions' => $questions,
    		'testTime' => $testTime,
		];
	}
}