<?php
/**
 * Plugin Name: HVAC Sizing Calculator
 * Plugin URI: http://plugin-devs.com/
 * Description: HVAC Sizing Calculator for Greenleaf
 * Version: 1.0.0
 * Author: PluginDevs
 * Author URI: http://plugin-devs.com/
 * Text Domain: hvac-sizing-calculator
 * Domain Path: /languages/
 * Requires at least: 5.8
 * Requires PHP: 7.4
 *
 * @package PluginDevs
 **/

defined( 'ABSPATH' ) || exit;

/**
 * Main Class to intantiate the Calculator.
 */
final class PD_Fashion_Sizing_Calculator {

	/**
	 * Construct function.
	 */
	public function __construct() {
		$this->define_constants();
		$this->hooks();
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	public function hooks() {
		add_shortcode( 'hvac_calculator', array( $this, 'hvasc_calculator_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_n_styles' ) );
		add_action( 'wp_ajax_hvac_calculate_sizing', array( $this, 'calculate_sizing' ) );
		add_action( 'wp_ajax_nopriv_hvac_calculate_sizing', array( $this, 'calculate_sizing' ) );
	}

	/**
	 * Enqueue Scripts and Styles
	 */
	public function enqueue_scripts_n_styles() {
		wp_register_script(
			'fashion-sizing-calculator',
			HSC_FORM_URL . '/assets/js/sizing-calculator.js',
			array(),
			time(),
			true
		);

		wp_localize_script(
			'fashion-sizing-calculator',
			'fashion_sizing_calculator',
			array(
				'ajaxurl'  => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce( 'hvac-calculator-ajax-nonce' ),
				'json_url' => HSC_FORM_URL . '/assets/js/sizing-calculator-zip.json',
			)
		);

		wp_register_style(
			'fashion_sizing_calculator',
			HSC_FORM_URL . '/assets/css/sizing-calculator.css',
			array(),
			time()
		);
	}

	/**
	 * Define Constants.
	 *
	 * @since 1.0.0
	 */
	private function define_constants() {
		$this->define( 'HSC_FORM_PLUGIN_FILE', __FILE__ );
		$this->define( 'HSC_FORM_PATH', plugin_dir_path( HSC_FORM_PLUGIN_FILE ) );
		$this->define( 'HSC_FORM_URL', plugin_dir_url( HSC_FORM_PLUGIN_FILE ) );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Calculator Shortcode
	 *
	 * @param array $atts Shortcode Attributes.
	 */
	public function hvasc_calculator_shortcode( $atts ) {
		wp_enqueue_script( 'fashion-sizing-calculator' );
		wp_enqueue_style( 'fashion_sizing_calculator' );

		ob_start();
			require HSC_FORM_PATH . '/templates/shortcode.php';
		return ob_get_clean();
	}

	/**
	 * Ajax Sizing Calculation
	 */
	public function calculate_sizing() {
		if ( check_ajax_referer( 'hvac-calculator-ajax-nonce', 'nonce', false ) ) {
			$zip         = isset( $_POST['zipcode'] ) ? absint( $_POST['zipcode'] ) : 0;
			$filename    = HSC_FORM_URL . '/assets/js/sizing-calculator-zip.json';
			$request     = wp_remote_get(
				$filename,
				array(
					'headers' => array(
						'Accept'  => 'application/json',
						'timeout' => 60,
					),
				)
			);
			$data        = json_decode( $request['body'], true );
			$zip_details = $data[ $zip ];
			wp_send_json( $zip_details );
		} else {
			wp_send_json( array( 'no kiddy' ) );
			wp_die();
		}
	}
}

$pd_fashion_sizing_calculator = new PD_Fashion_Sizing_Calculator();
