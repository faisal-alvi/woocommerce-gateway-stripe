<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Afterpay / Clearpay Payment Method class extending UPE base class
 */
class WC_Stripe_UPE_Payment_Method_Afterpay_Clearpay extends WC_Stripe_UPE_Payment_Method {

	const STRIPE_ID = 'afterpay_clearpay';

	/**
	 * Constructor for afterpay / clearpay payment method
	 */
	public function __construct() {
		parent::__construct();

		$this->stripe_id                    = self::STRIPE_ID;
		$this->title                        = __( 'Clearpay / Afterpay', 'woocommerce-gateway-stripe' );
		$this->is_reusable                  = false;
		$this->supported_currencies         = [ 'USD', 'CAD', 'GBP', 'AUD', 'NZD' ];
		$this->supported_countries          = [ 'AU', 'CA', 'GB', 'NZ', 'US' ];
		$this->accept_only_domestic_payment = true;
		$this->label                        = __( 'Clearpay / Afterpay', 'woocommerce-gateway-stripe' );
		$this->description                  = __(
			'Allow customers to pay over time with Clearpay / Afterpay.',
			'woocommerce-gateway-stripe'
		);
	}

	/**
	 * Returns payment method title
	 *
	 * @param array|bool $payment_details Optional payment details from charge object.
	 *
	 * @return string
	 */
	public function get_title( $payment_details = false ) {
		if ( $this->is_gb_country() ) {
			return __( 'Clearpay', 'woocommerce-gateway-stripe' );
		}
		return __( 'Afterpay', 'woocommerce-gateway-stripe' );
	}

	/**
	 * /**
	 *  Return the gateway's description.
	 *
	 * @return string
	 */
	public function get_description( $payment_details = false ) {
		if ( $this->is_gb_country() ) {
			return __(
				'Allow customers to pay over time with Clearpay.',
				'woocommerce-gateway-stripe'
			);
		}
		return __(
			'Allow customers to pay over time with Afterpay.',
			'woocommerce-gateway-stripe'
		);
	}

	/**
	 * Returns true if the Stripe account country is GB
	 *
	 * @return boolean
	 */
	private function is_gb_country() {
		$cached_account_data = WC_Stripe::get_instance()->account->get_cached_account_data();
		$account_country     = $cached_account_data['country'] ?? null;
		return 'GB' === $account_country;
	}
}
