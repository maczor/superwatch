<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => LaravelLocalization::setLanguage()), function() {
	Route::get('/', array('as'=>'home', 'uses'=>'HomeController@index'));
	Route::post('/sellmywatch', 'HomeController@sellmywatch');
	Route::get('/brand/{brand_id}/{name}', 'WatchesController@watchesInBrand');
	Route::get('/watch/all', 'WatchesController@allWatches');
	Route::get('/watch/{id}', 'WatchesController@show');
	Route::post('/newsletter', 'NewsletterController@store');
	Route::get('/newsletter/unsubscribe/{token}', 'NewsletterController@unsubscribe');
	Route::get('/searchbrand/{str}', 'WatchesController@searchBrand');
	Route::get('/searchmodel/{str}', 'WatchesController@searchModel');
	Route::get('/searchbrandmodel/{str}', 'WatchesController@searchBrandModel');
	Route::get('/addtowishlist/{str}', 'WatchesController@addToWishlist');
	Route::get('/removefromwishlist/{str}', 'WatchesController@removeFromWishlist');
	Route::get('/wishlist', array('as'=>'wishlist', 'uses'=>'WatchesController@showWishlist'));

	Route::get('/404', array('as'=>'404', function(){
		return View::make('errors.missing');
	}));

	// emails
	Route::post('/email/cbsent', function(){
		$data = Input::all();
		Mail::send('emails.notfound', $data, function($message)
		{
		    $message->to('maczor@maczor.com', 'ME')->subject('Customer contact');
		});
	});
	Route::post('/email/nsent', function(){
		$data = Input::all();
		Mail::send('emails.newsletter', $data, function($message)
		{
		    $message->to('maczor@maczor.com', 'ME')->subject('Newsletter subscription');
		});
	});
	Route::post('/email/aboutwatch', function(){
		$data = Input::all();
		Mail::send('emails.aboutwatch', $data, function($message)
		{
		    $message->to('maczor@maczor.com', 'ME')->subject('Customer contact about watch');
		});
		Mail::send('emails.thankyou_aboutwatch', $data, function($message) use ($data)
		{
		    $message->to($data['cemail'], $data['cname'])->subject(Lang::get('emails.Your request to SuperWatch'));
		});
	});
	Route::post('/email/wishlist', function(){
		$input = Input::all();
		$watches = DB::table('watches')
			->join('brands', 'brands.id', '=', 'watches.brand_id')
			->join('models', 'models.id', '=', 'watches.model_id')
			->whereIn('watches.id', Session::get('wishlist'))
			->select('watches.id',
			'watches.reference', 
			'watches.sellingprice', 
			'brands.name as brandname', 
			'brands.logo as logo', 
			'brands.width as width', 
			'brands.height as height', 
			'models.name as modelname')
			->get();
		$data = array(
			'watches' => $watches,
			'input' => $input
		);
		Mail::send('emails.wishlist', $data, function($message)
		{
		    $message->to('maczor@maczor.com', 'ME')->subject('Customer contact wishlist');
		});
		Mail::send('emails.thankyou_wl', $data, function($message) use ($data)
		{
		    $message->to($data['input']['wlemail'], $data['input']['wlname'])->subject(Lang::get('emails.Your request to SuperWatch'));
		});
	});
});

Route::get('/logos', 'HomeController@logos');

Route::get('login', array('as' => 'login', function () {
    return View::make('login');
}))->before('admin');

Route::post('login', function () {
        $user = array(
            'email' => Input::get('inputEmail'),
            'password' => Input::get('inputPassword')
        );
        
        if (Auth::attempt($user, (Input::get('inputRemember'))?true:false)) {
            return Redirect::intended('watches');
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::route('login')
            ->with('flash_error', 'Your email/password combination was incorrect.')
            ->withInput();
});

Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('login');
});

Route::group(array('before' => 'auth'), function(){
	Route::get('/jupload', function(){
	    return View::make('jupload');
	});

	Route::post('watches/payment/{id}', 'WatchesController@updatePayment');
	Route::post('watches/status/{id}', 'WatchesController@updateStatus');
	Route::get('watches', array('as'=>'watches', 'uses'=>'WatchesController@index'));
	Route::resource('watches', 'WatchesController');

	Route::post('images/reorder/{id}', 'ImagesController@reorder');
	Route::resource('images', 'ImagesController');

	Route::resource('models', 'ModelsController');

	Route::resource('brands', 'BrandsController');

	Route::resource('movements', 'MovementsController');

	Route::resource('cases', 'CasesController');

	Route::resource('bands', 'BandsController');

	Route::resource('buckles', 'BucklesController');

	Route::resource('papers', 'PapersController');

	Route::resource('boxes', 'BoxesController');

	Route::resource('keywords', 'KeywordsController');

	Route::resource('descriptions', 'DescriptionsController');

	Route::resource('statuses', 'StatusesController');

	Route::resource('papers', 'PapersController');
});
