<?php

namespace App\Http\Controllers\payumoney;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use PHPMailer;
use Session;
use DateTime;
use Config;
use Illuminate\Database\QueryException as QueryException;

//PAYU MONEY CONTROLLERS
use App\Http\Controllers\payumoney\CurlController as Curl;
use App\Http\Controllers\payumoney\CookiesController as Cookies;
use App\Http\Controllers\payumoney\ResponseController as ResponsePayu;
use App\Http\Controllers\payumoney\MiscController as Misc;
use App\Http\Controllers\payumoney\PaymentController as Payment;

class PaymentController extends Controller
{
	private $url;
	private $salt;
	private $params = array ();

	public function __construct ( $salt, $env = 'prod' )
	{
		$this->salt = $salt;
		
		switch ( $env ) {
		case 'test' :
			$this->url = 'https://test.payu.in/';
			break;
		case 'prod' :
			$this->url = 'https://secure.payu.in/';
			break;
		default :
			$this->url = 'https://test.payu.in/';
		}
	}

	public function __destruct ()
	{
		unset( $this->url );
		unset( $this->salt );
		unset( $this->params );
	}

	public function __set ( $key, $value )
	{
		$this->params[$key] = $value;
	}

	public function __get ( $key )
	{
		return $this->params[$key];
	}

	public function pay ( $params = null )
	{
		if ( is_array( $params ) ) foreach ( $params as $key => $value )
			$this->params[$key] = $value;
		
		$error = $this->check_params();
		
		if ( $error === true ) {
			$this->params['hash'] = Misc::get_hash( $this->params, $this->salt );
			$result = Misc::curl_call( $this->url . '_payment?type=merchant_txn', http_build_query( $this->params ) );
			$transaction_id = ($result['curl_status'] === Misc::SUCCESS) ? $result['result'] : null;
			
			if ( empty( $transaction_id ) ) return array ( 
				'status' => Misc::FAILURE, 
				'data' => $result['error'] );
			
			return array ( 
				'status' => Misc::SUCCESS, 
				'data' => $this->url . '_payment_options?mihpayid=' . $transaction_id );
		} else {
			return array ( 'status' => Misc::FAILURE, 'data' => $error );
		}
	}

	private function check_params ()
	{
		if ( empty( $this->params['key'] ) ) return $this->error( 'key' );
		if ( empty( $this->params['txnid'] ) ) return $this->error( 'txnid' );
		if ( empty( $this->params['amount'] ) ) return $this->error( 'amount' );
		if ( empty( $this->params['firstname'] ) ) return $this->error( 'firstname' );
		if ( empty( $this->params['email'] ) ) return $this->error( 'email' );
		if ( empty( $this->params['phone'] ) ) return $this->error( 'phone' );
		if ( empty( $this->params['productinfo'] ) ) return $this->error( 'productinfo' );
		if ( empty( $this->params['surl'] ) ) return $this->error( 'surl' );
		if ( empty( $this->params['furl'] ) ) return $this->error( 'furl' );
		
		return true;
	}

	private function error ( $key )
	{
		return 'Mandatory parameter ' . $key . ' is empty';
	}

}