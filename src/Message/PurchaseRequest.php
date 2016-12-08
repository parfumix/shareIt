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
		$this->validate('sid', 'items', 'paymentMethod');

		$data = array();
		$data['sid'] = $this->getParameter('sid');
		$data['mode'] = '2CO';
		$data['paymentMethod'] = $this->getPaymentMethod();

		if( $transaction_id = $this->getTransactionId() )
			$data['merchant_order_id'] = $transaction_id;
		
		if( $currency = $this->getCurrency() )
			$data['currency_code'] = $currency;

		if( $returnUrl = $this->getReturnUrl() )
			$data['x_receipt_link_url'] = $returnUrl;

		if ( $language = $this->getLanguage() )
			$data['lang'] = $language;

		if ( $coupon = $this->getCoupon() )
			$data['coupon'] = $coupon;

		$i = 0;

		// Setup Products information
		foreach ($this->getItems() as $item) {
			if(! isset($item->getParameters()['name']) )
				continue;

			if(! isset($item->getParameters()['price']) )
				continue;

			if(! isset($item->getParameters()['quantity']) )
				continue;

			$data['li_'.$i.'_name'] = $item->getParameters()['name'];
			$data['li_'.$i.'_price'] = $item->getParameters()['price'];
			$data['li_'.$i.'_quantity'] = $item->getParameters()['quantity'];

			if( isset( $item->getParameters()['type'] ) )
				$data['li_'.$i.'_type'] = $item->getParameters()['type'];

			if ( isset( $item->getParameters()['tangible'] ) )
				$data['li_'.$i.'_tangible'] = $item->getParameters()['tangible'];

			if ( isset( $item->getParameters()['product_id'] ) )
				$data['li_'.$i.'_product_id'] = $item->getParameters()['product_id'];

			if ( isset( $item->getParameters()['description'] ) )
				$data['li_'.$i.'_description'] = $item->getParameters()['description'];

			if ( isset( $item->getParameters()['recurrence'] ) )
				$data['li_'.$i.'_recurrence'] = $item->getParameters()['recurrence'];

			if ( isset( $item->getParameters()['duration'] ) )
				$data['li_'.$i.'_duration'] = $item->getParameters()['duration'];

			if ( isset( $item->getParameters()['startup_fee'] ) )
				$data['li_'.$i.'_startup_fee'] = $item->getParameters()['startup_fee'];

			++$i;
		}

		if ( $card = $this->getCard() ) {
			$data['card_holder_name'] = $card->getName();
			$data['street_address'] = $card->getAddress1();
			$data['street_address2'] = $card->getAddress2();
			$data['city'] = $card->getCity();
			$data['state'] = $card->getState();
			$data['zip'] = $card->getPostcode();
			$data['country'] = $card->getCountry();
			$data['phone'] = $card->getPhone();
			$data['phone_extension'] = $card->getPhoneExtension();
			$data['email'] = $card->getEmail();
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
