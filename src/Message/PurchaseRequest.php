<?php

namespace Omnipay\ShareIt\Message;

use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Extend\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest {

	/**
	 * Get the raw data array for this message. The format of this varies from gateway to
	 * gateway, but will usually be either an associative array, or a SimpleXMLElement.
	 *
	 * @return mixed
	 */
	public function getData() {
		$this->validate('paymentMethod', 'PRODUCT');

		$data = array();
		$data['cartcoupon']     = 1;
		$data['showcart']       = 1;
		$data['paymentMethod']  = $this->getPaymentMethod();

		//#@todo setup product .

		if ( $card = $this->getCard() ) {
			$data['FIRSTNAME'] = $card->getName();
			$data['D_STREET1'] = $card->getAddress1();
			$data['D_CITY'] = $card->getCity();
			$data['D_POSTALCODE'] = $card->getPostcode();
			$data['D_COUNTRY'] = $card->getCountry();
			$data['PHONE'] = $card->getPhone();
			$data['EMAIL'] = $card->getEmail();
		}

		return $data;
	}

	/**
	 * Send the request with specified data
	 *
	 * @param  mixed $data The data to send
	 * @return ResponseInterface
	 */
	public function sendData($data) {
		return new PurchaseResponse($this, $data);
	}

}
