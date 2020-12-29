<?php
/**
 * Template Name: Products
 */

use App\Test\Loader;

get_header(); the_post(); ?>

<?php
$productsLoop = new WP_Query( array(
	'post_type' => 'crb_product',
	'posts_per_page' => 3,
) );
?>
<div class="main">
	<div class="container">
		<div class="shell">
			<div class="products">
				<?php
				Loader::render( 'products/product', array(
					'productsLoop' => $productsLoop
				) );
				?>
			</div><!-- products -->
		</div><!-- shell -->
	</div><!-- container -->
</div><!-- main -->

<?php get_footer();