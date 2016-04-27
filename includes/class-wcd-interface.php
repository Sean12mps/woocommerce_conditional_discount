<?php 
/*

options:
- wcd_enabled
- wcd_minimum
- wcd_discount

*/ 

class WCD_Interface {


	protected $parent;


	public function __construct( $target, $parent ) {


		$this->parent = $parent;

		if ( $target == 'admin' ) {

			add_filter( 'woocommerce_get_sections_products', array( $this, 'wcd_add_section' ) );

			add_filter( 'woocommerce_get_settings_products', array( $this, 'wcd_all_settings' ), 40, 2 );

			add_action( 'woocommerce_update_options_products', array( $this, 'process_admin_options') );

		}
		

	}


	public function wcd_add_section( $sections ) {
		

		$sections['conditional_discount'] = __( 'Conditional Discount', 'wcd' );

		return $sections;
		

	}


	public function wcd_all_settings( $settings, $current_section ) {


		if ( $current_section == 'conditional_discount' ) {

			$settings_wcd = array();

			// Add Title to the Settings
			$settings_wcd[] = array( 'name' => __( 'Conditional Discount Settings', 'wcd' ), 'type' => 'title', 'desc' => __( 'The following options are used to configure WC Conditional Discount', 'wcd' ), 'id' => 'wcdisc' );
			
			// Add first checkbox option
			$settings_wcd[] = array(
				'name'     => __( 'Enable Conditional Discount', 'wcd' ),
				'desc_tip' => __( 'This will enable conditional discount. Please enter the minimum subtotal ammount and discount ammount.', 'wcd' ),
				'id'       => 'wcd_enabled',
				'type'     => 'checkbox',
				'css'      => 'min-width:300px;',
				'desc'     => __( 'Enable Woocommerce Conditional Discount', 'wcd' ),
			);

			// Add Minimum Subtotal number field option
			$settings_wcd[] = array(
				'name' 		=> __( 'Discount Title', 'wcd' ),
				'desc_tip' 	=> __( 'The label for discount name.', 'wcd' ),
				'id' 		=> 'wcd_title',
				'type'		=> 'text',
				'default'	=> __( 'Fee', 'wcd' ),
			);
			
			// Add Minimum Subtotal number field option
			$settings_wcd[] = array(
				'name' 		=> __( 'Minimum Subtotal', 'wcd' ),
				'desc_tip' 	=> __( 'The subtotal that needs to be reached.', 'wcd' ),
				'id' 		=> 'wcd_minimum',
				'type'		=> 'number',
				'default'	=> 0,
			);

			// Add Discount Ammount number field option
			$settings_wcd[] = array(
				'name' 		=> __( 'Discount Ammount', 'wcd' ),
				'desc_tip' 	=> __( 'The discount to be applied.', 'wcd' ),
				'id' 		=> 'wcd_discount',
				'type'		=> 'number',
				'default'	=> 0,
			);

			$settings_wcd[] = array( 'type' => 'sectionend', 'id' => 'wcdisc' );

			return $settings_wcd;

		} else {

			return $settings;

		}
		

	}


	public function process_admin_options() {


		if ( isset( $_POST['wcd_enabled'] ) && $_POST['wcd_enabled'] == 0 ) return;

		if ( isset( $_POST['wcd_minimum'] ) && $_POST['wcd_minimum'] < 0 ) {

			update_option( 'wcd_minimum', 0 );

		}

		if ( isset( $_POST['wcd_discount'] ) && $_POST['wcd_discount'] < 0 ) {

			update_option( 'wcd_discount', 0 );

		}


	}


}