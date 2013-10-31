<?php

class WatchesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$watches = Watch::with(array('images' => function($query)
		{
		    $query->where('order', '=', '1');
		}))
		->get();
		$brand = Brand::orderBy('name')->lists('name','id');
		$model = Model::orderBy('name')->lists('name','id');
		$status = Status::all()->lists('name','id');
		$payment = Payment::all()->lists('name','id');
		$data = array (
			'watches' => $watches,
			'brand' => $brand,
			'model' => $model,
			'status' => $status,
			'payment' => $payment
		);
		// dd($watches->first());
		return View::make('watches.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$watch = Watch::with('keywords','descriptions');
		$brand = Brand::orderBy('name')->lists('name','id');
		$model = Model::orderBy('name')->lists('name','id');
		$movement = Movement::all()->lists('name','id');
		$casebox = Casebox::all()->lists('name','id');
		$band = Band::all()->lists('name','id');
		$buckle = Buckle::all()->lists('name','id');
		$paper = Paper::all()->lists('name','id');
		$status = Status::all()->lists('name','id');
		$payment = Payment::all()->lists('name','id');
		$data = array(
			'watch' => $watch,
			'brand' => $brand,
			'model' => $model,
			'movement' => $movement,
			'casebox' => $casebox,
			'band' => $band,
			'buckle' => $buckle,
			'paper' => $paper,
			'status' => $status,
			'payment' => $payment
			);
		return View::make('watches.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$watch = new Watch();
		$description = new Description();
		$keyword = new Keyword();
		$input = Input::get();
		$description->en = $input['descriptions_en'];
		$description->fr = $input['descriptions_fr'];
		$keyword->en = $input['keywords_en'];
		$keyword->fr = $input['keywords_fr'];

		unset($input['_method']);
		unset($input['_token']);
		unset($input['_token']);
		unset($input['keywords_en']);
		unset($input['keywords_fr']);
		unset($input['descriptions_en']);
		unset($input['descriptions_fr']);
		
		$watch->fill($input);
		$watch->save();

		$description->watch_id = $watch->id;
		$description->save();
		$keyword->watch_id = $watch->id;
		$keyword->save();
		return Redirect::to('watches/'.$watch->id.'/edit');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$watch = Watch::with(array('images' => function($query)
		{
		    $query->orderBy('order');
		}),'keywords','descriptions')->find($id);
		$brands = Brand::with('watches')->orderBy('name')->get();
		$modelslist = Model::orderBy('name')->lists('name','id');
		$brandslist = Brand::orderBy('name')->lists('name','id');
		$movements = Movement::all()->lists('name','id');
		$caseboxes = Casebox::all()->lists('name','id');
		$bands = Band::all()->lists('name','id');
		$buckles = Buckle::all()->lists('name','id');
		$papers = Paper::all()->lists('name','id');
		$data = array(
			'modelslist' => $modelslist,
			'brandslist' => $brandslist,
			'movements' => $movements,
			'caseboxes' => $caseboxes,
			'bands' => $bands,
			'buckles' => $buckles,
			'papers' => $papers,
			'watch' => $watch,
			'brands' => $brands
		);
		return View::make('watches.show', $data);
		// return $watch;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$watch = Watch::with('images','keywords','descriptions')->find($id);
		$images = Image::where('watch_id' ,'=', $id)->orderBy('order')->get();
		$brand = Brand::orderBy('name')->lists('name','id');
		$model = Model::orderBy('name')->lists('name','id');
		$movement = Movement::all()->lists('name','id');
		$casebox = Casebox::all()->lists('name','id');
		$band = Band::all()->lists('name','id');
		$buckle = Buckle::all()->lists('name','id');
		$paper = Paper::all()->lists('name','id');
		$status = Status::all()->lists('name','id');
		$payment = Payment::all()->lists('name','id');
		$data = array(
			'watch' => $watch,
			'images' => $images,
			'brand' => $brand,
			'model' => $model,
			'movement' => $movement,
			'casebox' => $casebox,
			'band' => $band,
			'buckle' => $buckle,
			'paper' => $paper,
			'status' => $status,
			'payment' => $payment
			);
		return View::make('watches.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$watch = Watch::find($id);
		$input = Input::get();
		$keyword_id = Keyword::where('watch_id', '=', $id)->pluck('id');
		$keyword = Keyword::find($keyword_id);
		$keyword->en = $input['keywords_en'];
		$keyword->fr = $input['keywords_fr'];
		$description_id = Description::where('watch_id', '=', $id)->pluck('id');
		$description = Description::find($description_id);
		$description->en = $input['descriptions_en'];
		$description->fr = $input['descriptions_fr'];
		if(!$input['sellingdate']) $input['sellingdate']=null;
		unset($input['watchid']);
		unset($input['_method']);
		unset($input['_token']);
		unset($input['_token']);
		unset($input['entrydate']);
		unset($input['keywords_en']);
		unset($input['keywords_fr']);
		unset($input['descriptions_en']);
		unset($input['descriptions_fr']);
		foreach ($input as $key => $value)
		{
		    $watch->$key = $value;
		}
		$watch->save();
		$keyword->save();
		$description->save();
		// dd($keyword);
	}

	/**
	* Update payment
	*/
	public function updatePayment($id)
	{
		$watch = Watch::find($id);
		$watch->payment_id = Input::get('payment_id');
		$watch->save();
	}

	/**
	* Update status
	*/
	public function updateStatus($id)
	{
		$watch = Watch::find($id);
		$watch->status_id = Input::get('status_id');
		$watch->save();
		return 'ok';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function watchesInBrand($brand_id)
	{
		// returns the watches list
		$watches = Watch::with(array('images' => function($query)
		{
		    $query->where('order', '=', '1');
		}))
		->where('brand_id', '=', $brand_id)
		->orderBy('created_at')->paginate(8);

		$brands = Brand::with('watches')->orderBy('name')->get();
		$modelslist = Model::orderBy('name')->lists('name','id');
		$brandslist = Brand::orderBy('name')->lists('name','id');
		$movements = Movement::all()->lists('name','id');
		$caseboxes = Casebox::all()->lists('name','id');
		$bands = Band::all()->lists('name','id');
		$buckles = Buckle::all()->lists('name','id');
		$papers = Paper::all()->lists('name','id');
		$data = array(
			'modelslist' => $modelslist,
			'brandslist' => $brandslist,
			'movements' => $movements,
			'caseboxes' => $caseboxes,
			'bands' => $bands,
			'buckles' => $buckles,
			'papers' => $papers,
			'watches' => $watches,
			'brands' => $brands
		);
		return View::make('watches.single', $data);
	}

	public function allWatches()
	{
		// returns the watches list
		$watches = Watch::with(array('images' => function($query)
		{
		    $query->where('order', '=', '1');
		}))
		->orderBy('created_at')->paginate(8);

		$brands = Brand::with('watches')->orderBy('name')->get();
		$modelslist = Model::orderBy('name')->lists('name','id');
		$brandslist = Brand::orderBy('name')->lists('name','id');
		$movements = Movement::all()->lists('name','id');
		$caseboxes = Casebox::all()->lists('name','id');
		$bands = Band::all()->lists('name','id');
		$buckles = Buckle::all()->lists('name','id');
		$papers = Paper::all()->lists('name','id');
		$data = array(
			'modelslist' => $modelslist,
			'brandslist' => $brandslist,
			'movements' => $movements,
			'caseboxes' => $caseboxes,
			'bands' => $bands,
			'buckles' => $buckles,
			'papers' => $papers,
			'watches' => $watches,
			'brands' => $brands
		);
		return View::make('watches.single', $data);
	}

	public function searchBrand($str)
	{
		$brands = DB::table('watches')
			->Join('brands', 'brands.id', '=', 'watches.brand_id')
			->where('brands.name', 'LIKE', '%'.$str.'%')
			->lists('name', 'brand_id');
		return $brands;
	}
	public function searchModel($str)
	{
		$models = DB::table('watches')
			->Join('models', 'models.id', '=', 'watches.model_id')
			->where('models.name', 'LIKE', '%'.$str.'%')
			->lists('name', 'model_id');
		return $models;
	}

	public function searchBrandModel($str)
	{
		$sql = 'SELECT * FROM (SELECT brands.name as brandname, brands.id as brand_id, models.name as modelname, models.id as model_id, "model" as matchedtype, models.name as textfound FROM watches 
				LEFT JOIN brands ON brands.id=watches.brand_id
				LEFT JOIN models ON models.id=watches.model_id
				WHERE models.name LIKE "%'.$str.'%"
				UNION
				SELECT brands.name as brandname, brands.id as brand_id, models.name as modelname, models.id as model_id, "brand" as matchedtype, brands.name as textfound FROM watches 
				LEFT JOIN brands ON brands.id=watches.brand_id
				LEFT JOIN models ON models.id=watches.model_id
				WHERE brands.name LIKE "%'.$str.'%") as t1 ORDER BY textfound';
		$found = DB::select($sql);
		return $found;
	}

	public function addToWishlist($id)
	{
		if(!Session::get('wishlist')) {
			$arrayid = FALSE;
		} else {
			$arrayid = array_search($id, Session::get('wishlist'));
		}
		Session::push('wishlist', $id);
		Session::set('wishlist', array_unique(Session::get('wishlist')));
		if(count(Session::get('wishlist'))) {
			return count(Session::get('wishlist'));
		} else {
			return 0;
		}
	}

	public function removeFromWishlist($id)
	{
		$wishlist = Session::get('wishlist');
		$arrayid = array_search($id, $wishlist);
		if($arrayid !== FALSE) {
			unset($wishlist[$arrayid]);
			Session::set('wishlist', $wishlist);
		}
		return Redirect::route('wishlist');
	}

	public function showWishlist()
	{
		if(Session::get('wishlist')) {
			$watches = Watch::with(array('images' => function($query)
			{
			    $query->where('order', '=', '1');
			}, 'descriptions'))
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
				'watches' => $watches
			);
			return View::make('watches.wishlist', $data);
		} else {
			return Redirect::route('home');
		}
	}
}
