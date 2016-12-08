<?php

namespace Omnipay\ShareIt\Message;

use Omnipay\Common\Exception\InvalidResponseException;

class CompletePurchaseRequest extends PurchaseRequest {

	/**
	 * Get data .
	 *
	 * @return mixed
	 * @throws InvalidResponseException
	 */
	public function getData() {

	}

	/**
	 * {@inheritdoc}
	 *
	 * @param mixed $data
	 *
	 * @return CompletePurchaseResponse
	 */
	public function sendData($data) {
		return $this->response = new CompletePurchaseResponse($this, $data);
	}
}
