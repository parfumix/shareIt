<?php

namespace Omnipay\ShareIt\Message;

use Omnipay\Extend\Common\Message\AbstractResponse;

/**
 * 2Checkout Complete Purchase Response.
 */
class CompletePurchaseResponse extends AbstractResponse {

	/**
	 * Check if successfully request .
	 *
	 * @return bool
	 */
	public function isSuccessful() {
		return $this->isCardProcessed();
	}

	/**
	 * Check if card is processed
	 *
	 * @return bool
	 */
	public function isCardProcessed() {
		return $this->data['credit_card_processed'] == 'Y';
	}

	/**
	 * Get total amount
	 *
	 * @return null
	 */
	public function getTotal() {
		return isset($this->data['total'])
			? $this->data['total']
			: null;
	}

	/**
	 * Transaction ference returned by 2checkout or null on payment failure.
	 *
	 * @return mixed|null
	 */
	public function getTransactionReference() {
		return isset($this->data['order_number'])
			? $this->data['order_number']
			: null;
	}

	/**
	 * Transaction ID.
	 *
	 * @return mixed|null
	 */
	public function getTransactionId() {
		return isset($this->data['merchant_order_id'])
			? $this->data['merchant_order_id']
			: null;
	}
}
