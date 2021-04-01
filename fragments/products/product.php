<?php
get_header();

if ( ! $productsLoop->have_posts() ) {
	return;
}

$checkout = null;
$pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'test-checkout.php'
));
if(isset($pages[0])) {
    $checkout = get_page_link($pages[0]->ID);
}
?>

<?php while ( $productsLoop->have_posts() ) : $productsLoop->the_post(); ?>
	<?php
	$product = [
		'title' => get_the_title(),
		'price' => carbon_get_the_post_meta('crb_product_price'),
		'features' => carbon_get_the_post_meta('crb_product_features'),
		'checkout' => $checkout .= '?productID=' . get_the_ID()
	];
	?>
	<div class="product">
		<div class="product__head" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
			<?php if ( ! empty( $product['title'] ) ) : ?>
				<h3 class="product__title"><?php echo $product['title']; ?></h3><!-- product__title -->
			<?php endif; ?>

			<?php if ( ! empty( $product['price'] ) ) : ?>
				<h2 class="product__price"><?php ?><?php echo esc_html( $product['price'] . 'лв.' ); ?></h2><!-- product__price -->
			<?php endif; ?>

			<a href="<?php echo $product['checkout']; ?>">Поръчай</a>
		</div><!-- product__head -->

		<div class="product__body">
			<ul class="product__features">
				<?php foreach ( $product['features'] as $feature ) : ?>
					<li><?php echo $feature['title']; ?></li>
				<?php endforeach; ?>
			</ul><!-- product__features -->
		</div><!-- product__body -->
	</div><!-- product -->
<?php endwhile; ?>

<?php wp_reset_postdata();