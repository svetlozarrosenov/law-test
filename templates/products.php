<?php
/**
 * Template Name: Products
 */

use LawtestManager\TestPackage\Loader;

get_header(); the_post(); ?>

<?php
$selectedProducts = carbon_get_the_post_meta( 'crb_products_selected' );
$ids = [];
$type = 'post';
foreach ( $selectedProducts as $product ) {
	$type = $product['subtype'];
	$ids[] = $product['id']; 
}

$productsLoop = new WP_Query( array(
	'post_type' => $type,
	'post__in' => $ids,
	'posts_per_page' => -1,
	'orderby' => 'post__in'
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