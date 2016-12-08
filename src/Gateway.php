<?php

namespace Omnipay\ShareIt;

use Omnipay\Extend\Common\AbstractGateway;
use Omnipay\Two2Checkout\Message\CompletePurchaseRequest;
use Omnipay\Two2Checkout\Message\PurchaseRequest;

class Gateway extends AbstractGateway {

	/**
	 * Get gateway display name
	 *
	 * This can be used by carts to get the display name for each gateway.
	 */
	public function getName() {
		return 'ShareIt';
	}

	/**
	 * Get gateway default parameters .
	 *
	 * @return array
	 */
	public function getDefaultParameters() {
		return array(

		);
	}

	/**
	 * Implement purchase request method .
	 *
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function purchase(array $options = array()) {
		return $this->createRequest(PurchaseRequest::class, $options);
	}

	/**
	 * Complete purchase request .
	 *
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function completePurchase(array $options = array()) {
		return $this->createRequest(CompletePurchaseRequest::class, $options);
	}
}
