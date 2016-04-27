<?php 

class WCD_Hooks {


	protected $parent;


	public function __construct( $target, $parent ) {


		$this->parent = $parent;

		if ( $target == 'front' ) {

			add_action( 'woocommerce_cart_calculate_fees', array( $this, 'custom_wc_add_fee' ), 20 );

		}


	}


	public function custom_wc_add_fee() {


		$options = $this->parent->options;

		if ( $options['wcd_enabled'] === 'yes' ) {

			global $woocommerce;

			$subtotal = absint( WC()->cart->subtotal );

			$condition = absint( $options['wcd_minimum'] );

			$discount = -1 * absint( $options['wcd_discount'] );

			$title = $options['wcd_title'];

			if ( $subtotal >= $condition ) {

				WC()->cart->add_fee( apply_filters( 'wcd_fee_name', $title ), apply_filters( 'wcd_fee_ammount', $discount ) );

			}

		}



	} 


}