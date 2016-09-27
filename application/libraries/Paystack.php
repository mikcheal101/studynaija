<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paystack {
	protected $CI;
	protected $curl;
	
	protected $INITIALIZE_PAYMENT_URL 			= "https://api.paystack.co/transaction/initialize";
	protected $VERIFICATION_PAYMENT_URL 		= "https://api.paystack.co/transaction/verify";
	protected $LIST_TRANSACTIONS_PAYMENT_URL 	= "";
	protected $FETCH_TRANSACTION_PAYMENT_URL 	= "";
	protected $CHARGE_AUTHORIZATION_URL 		= "https://api.paystack.co/transaction/charge_authorization";
	protected $CHARGE_TOKEN_URL 				= "";
	protected $EXPORT_TRANSACTIONS_URL 			= "";
	
	protected $TEST_SECRET_KEY					= "sk_test_d0c547a9d5b1eb9f9c43dad6b853fa668ac04fe8";
	protected $TEST_PUBLIC_KEY					= "pk_test_a9430b354403cab0d787e94df5edd1b4a5bf586c";
	
	
	protected $LIVE_SECRET_KEY					= "";
	protected $LIVE_PUBLIC_KEY					= "";
	

	public function __construct () {
		$this->CI =& get_instance();
		$this->curl = null;
	}
	
	public function loadCurl ($url) {
		//  Setting URL To Fetch Data From
		$this->curl = curl_init($url);
		curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($this->curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)");
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
		#curl_setopt($this->curl, CURLOPT_TIMEOUT, 600);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	} 
	
	public function initializePayment ($object) {
		$this->loadCurl($this->INITIALIZE_PAYMENT_URL);
		$headers 	= array("Authorization: Bearer {$this->TEST_SECRET_KEY}", "Content-Type: application/json");
		$postdata 	= json_encode($object);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($this->curl, CURLOPT_POST, 1);
		return curl_exec($this->curl);
	}
	
	public function verifyPayment ($object) {
		$this->loadCurl("{$this->VERIFICATION_PAYMENT_URL}/{$object->reference}");
		$headers 	= array("Authorization: Bearer {$this->TEST_SECRET_KEY}");
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
		return curl_exec($this->curl);
	}
	
	public function chargePayment ($object) {
		
		$this->loadCurl("{$this->CHARGE_AUTHORIZATION_URL}");
		$headers 	= array("Authorization: Bearer {$this->TEST_SECRET_KEY}", "Content-Type: application/json");
		$postdata 	= json_encode($object);
		
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($this->curl, CURLOPT_POST, 1);
		return curl_exec($this->curl);
	}
	 
	
}
?>