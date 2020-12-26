<?php
/**
 * Template Name: Paywall Products
 */

use App\Paywall\Subscription;

get_header(); the_post();

$user = wp_get_current_user();
$product = 5;
$plans = [2];

$subscription = new Subscription( $user, $product, $plans );

get_footer();