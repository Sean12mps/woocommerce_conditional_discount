<?php 

class WCD_settings {


	public function __construct( $parent ) {


		$parent->options['wcd_enabled'] 	= get_option( 'wcd_enabled' );

		$parent->options['wcd_minimum'] 	= get_option( 'wcd_minimum' );

		$parent->options['wcd_discount'] 	= get_option( 'wcd_discount' );

		$parent->options['wcd_title'] 		= get_option( 'wcd_title' );


	}


}