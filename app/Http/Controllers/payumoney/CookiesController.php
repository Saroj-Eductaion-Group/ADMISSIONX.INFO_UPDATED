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

class CookiesController extends Controller
{
	private $cookies;

	function __construct ()
	{}

	function __destruct ()
	{}

	public function add ( $cookie )
	{
		list ( $data, $etc ) = explode( ";", $cookie, 2 );
		list ( $name, $value ) = explode( "=", $data );
		$this->cookies[trim( $name )] = trim( $value );
	}

	public function createHeader ()
	{
		if ( 0 == count( $this->cookies ) || ! is_array( $this->cookies ) ) return "";
		$output = "";
		foreach ( $this->cookies as $name => $value )
			$output .= "$name=$value; ";
		return "Cookies: $output\r\n";
	}

}