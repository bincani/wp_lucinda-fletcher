<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$oArgs = ThemeArguments::getInstance('rs_woo_products');
if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' || $oArgs -> get('disable_rating') === true)
	return;
?>

<?php if ( $rating_html = $product->get_rating_html() ) : ?>
	<div class="clearfix align-center">
		<?php echo $rating_html; ?>
	</div>
<?php endif; ?>
