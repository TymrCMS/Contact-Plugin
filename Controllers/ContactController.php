<?php

namespace Tymr\Plugins\Contact\Controllers;

use Tymr\Plugins\Contact\Notifications\InboxMessage;
use Tymr\Plugins\Contact\Requests\ContactFormRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;

use TymrSetting;
use Tymr\Http\Controllers\PublicController;
use Tymr\Plugins\Contact\Models\SystemContact;



class ContactController extends PublicController
{

	public function __construct( \Tymr\Plugins\Contact\ContactPlugin $p )
	{
		parent::__construct( $p );
	}

	/**
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// you can ommit "public" in the view if you wish, it can be nice to have it there so we can see whwre the file comes from
		return view("public.modules.contact.index");
		//return view("modules.contact.index");
	}


	public function sendContactRequest( ContactFormRequest $request, SystemContact $contact )
	{
		




		#$secret = '6LfjqqkZAAAAAL_ahkgtZGgnfExBy7LItpzVcUXi';
		#$response = $_POST['g-recaptcha-response'];
		#$ip = $_SERVER['REMOTE_ADDR'];
		#
		#$dav = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$ip);
		#
		#$res = json_decode($dav,true);
		#
		#if($res['success']) {
		#	die(json_encode(0));
		#} else {
		#	die(json_encode(1));
		#}
		
		

		#$url = "https://www.google.com/recaptcha/api/siteverify";
		#$data = [
		#	'secret' => '6LfjqqkZAAAAAL_ahkgtZGgnfExBy7LItpzVcUXi',
		#	'response' => request('recaptcha')
		#];
#
		#$options = [
		#	'http' => [
		#		'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		#		'method' => 'POST',
		#		'content' => \http_build_query($data)
		#	]
		#];
#
		#$context = \stream_context_create($options);
		#$result = \file_get_contents($url,false,$context);
		#$resultsJson = \json_decode($result);
#
		#dd($resultsJson);
#
		#if($resultsJson->success == false) return back()->with('message', 'Captcha Error');



		// these are the fields in the DB
		// and the form on the page
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		// perhaps a settings can determin if we check/validate with recapatcha
		$validate = Validator::make(\Illuminate\Support\Facades\Input::all(), [
			'g-recaptcha-response' => 'required|captcha'
		]);


		// Lets check whatr setting we need //"dbonly" "emailonly", "both"
		$method = TymrSetting::value('contact_method');


		// Store the response in the databse
		if(($method == "dbonly") || ($method == "both"))
			\Tymr\Plugins\Contact\Models\Contact::create( $request->all() );


		// Send the admin an Email notification
		if(($method == "emailonly") || ($method == "both"))
			$contact->notify(new InboxMessage($request));


		// Did something go wrong?
		if($method == NULL)
			return redirect()->back()->with('message', 'Oops something went wrong!');


		// redirect the user back
		return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');

	}

}

