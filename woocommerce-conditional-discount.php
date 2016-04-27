<?php
/*
Plugin Name: Woocommerce Conditional Discount ( Titan Edition )
Description: Gives conditional discount based on cart total.
Version: 1.0.0
*/


class WC_Conditional_Discount{


	public $computed_subtotal = 0;


	public $options = array();


	protected 
	//	methods
		$interface, 
		$settings;


	public function __construct() {


		include_once( plugin_dir_path( __FILE__ ) . '/includes/class-wcd-interface.php' );

		include_once( plugin_dir_path( __FILE__ ) . '/includes/class-wcd-settings.php' );

		include_once( plugin_dir_path( __FILE__ ) . '/includes/class-wcd-hooks.php' );

		// include_once( plugin_dir_path( __FILE__ ) . '/includes/class-wcd-filters.php' );


		// 	Global
		$this->settings = new WCD_settings( $this );


		// 	Admin
		if ( is_admin() ) {

			$this->interface = new WCD_Interface( 'admin', $this );

		} 


		// 	Front
		else {

			$this->hooks = new WCD_Hooks( 'front', $this );
			
			// $this->filters = new WCD_Filters( 'front', $this );

		}


	}
	

}


new WC_Conditional_Discount();