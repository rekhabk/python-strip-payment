<?php

use Illuminate\Http\Request;
Route::get ( '/', function () {
	return view ( 'welcome' );
} );  
Route::post ( '/', function (Request $request) {
	\Stripe\Stripe::setApiKey ( 'sk_test_9YUbMJv9Yw1q3UE9Bb6cGcdQ00UlvhKZnS' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => 300 * 100,
				"currency" => "usd",
				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
				"description" => "Test payment." 
		) );
		Session::flash ( 'success-message', 'Payment done successfully !' );
		return Redirect::back ();
	} catch ( \Exception $e ) {
		Session::flash ( 'fail-message', "Error! Please Try again." );
		return Redirect::back ();
	}
} );