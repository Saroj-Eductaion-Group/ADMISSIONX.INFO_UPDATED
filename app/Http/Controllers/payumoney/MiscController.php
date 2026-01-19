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

class MiscController extends Controller
{
	const SUCCESS = 1;
	const FAILURE = 0;

	public static function get_hash ( $params, $salt )
	{
		$posted = array ();
		
		if ( ! empty( $params ) ) foreach ( $params as $key => $value )
			$posted[$key] = htmlentities( $value, ENT_QUOTES );
		
		$hash_sequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		
		$hash_vars_seq = explode( '|', $hash_sequence );
		$hash_string = null;
		
		foreach ( $hash_vars_seq as $hash_var ) {
			$hash_string .= isset( $posted[$hash_var] ) ? $posted[$hash_var] : '';
			$hash_string .= '|';
		}
		
		$hash_string .= $salt;
		return strtolower( hash( 'sha512', $hash_string ) );
	}

	public static function reverse_hash ( $params, $salt, $status )
	{
		$posted = array ();
		$hash_string = null;
		
		if ( ! empty( $params ) ) foreach ( $params as $key => $value )
			$posted[$key] = htmlentities( $value, ENT_QUOTES );
		
		$additional_hash_sequence = 'base_merchantid|base_payuid|miles|additional_charges';
		$hash_vars_seq = explode( '|', $additional_hash_sequence );
		
		foreach ( $hash_vars_seq as $hash_var )
			$hash_string .= isset( $posted[$hash_var] ) ? $posted[$hash_var] . '|' : '';
		
		$hash_sequence = "udf10|udf9|udf8|udf7|udf6|udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key";
		$hash_vars_seq = explode( '|', $hash_sequence );
		$hash_string .= $salt . '|' . $status;
		
		foreach ( $hash_vars_seq as $hash_var ) {
			$hash_string .= '|';
			$hash_string .= isset( $posted[$hash_var] ) ? $posted[$hash_var] : '';
		}
		
		return strtolower( hash( 'sha512', $hash_string ) );
	}

	public static function curl_call ( $url, $data )
	{
		$ch = curl_init();
		
		curl_setopt_array( $ch, array ( 
			CURLOPT_URL => $url, 
			CURLOPT_POSTFIELDS => $data, 
			CURLOPT_POST => true, 
			CURLOPT_RETURNTRANSFER => true, 
			CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36', 
			CURLOPT_SSL_VERIFYHOST => 0, 
			CURLOPT_SSL_VERIFYPEER => 0 ) );
		
		$o = curl_exec( $ch );
		
		if ( curl_errno( $ch ) ) {
			$c_error = curl_error( $ch );
			
			if ( empty( $c_error ) ) $c_error = 'Server Error';
			
			return array ( 'curl_status' => Misc::FAILURE, 'error' => $c_error );
		}
		
		$o = trim( $o );
		return array ( 'curl_status' => Misc::SUCCESS, 'result' => $o );
	}

	public static function show_page( $result )
	{
		if ( $result['status'] === Misc::SUCCESS ):
			header('Location:'.$result['data']);
		else:
			throw new Exception( $result['data'] );
		endif;
		
	}

	public static function show_reponse ( $result )
	{		
		//$explodeMethod = explode('#', $result['data']);
		//$mainMethodName = $explodeMethod[0].'('.$explodeMethod[1].')';	
		if ( $result['status'] === Misc::SUCCESS )
			//Get The Method
			// $redirectURL = app('App\Http\Controllers\student\studentApplyCourseController')->$explodeMethod[0]($explodeMethod[1]);			
			//Get The Method
			$redirectURL = app('App\Http\Controllers\student\studentApplyCourseController')->$result['data'];	
		else
			return $result['data'];

		return $redirectURL;
	}


	public static function show_exam_page ( $result )
	{
		if ( $result['status'] === Misc::SUCCESS ):
			header( 'Location:' . $result['data'] );			
		else:
			throw new Exception( $result['data'] );
		endif;
		
	}

	public static function show_exam_reponse ( $result )
	{		
		//$explodeMethod = explode('#', $result['data']);
		//$mainMethodName = $explodeMethod[0].'('.$explodeMethod[1].')';	
		if ( $result['status'] === Misc::SUCCESS )
			//Get The Method
			//$redirectURL = app('App\Http\Controllers\administrator\EngineeringExamController')->$explodeMethod[0]($explodeMethod[1]);			
			$redirectURL = app('App\Http\Controllers\administrator\EngineeringExamController')->$result['data'];			
		else
			return $result['data'];

		return $redirectURL;
	}
}