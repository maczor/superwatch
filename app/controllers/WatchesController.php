<?php

class WatchesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// all
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
	 * Search in Watches View for Admin
	 *
	 * @return View
	 */
	public function searchFullAdmin()
	{
		$input = Input::get('searchall');
		$searchinput = '1200';
		// sanitize searchinput
		$searchstrings = explode(' ',$searchinput);
		$searchfields = array('brandname','modelname', 'reference', 'statusname', 'sellingprice', 'buyingprice');
		foreach ($searchfields as $key => $columnname) {
			foreach ($searchstrings as $key => $searchstring) {
				$queries[] = 'SELECT id, modelname, brandname, reference, statusname, sellingprice, buyingprice FROM `watchesjoined` WHERE '.$columnname.' LIKE "%'.$searchstring.'%"';
			}
		}

		$query = implode(' UNION ', $queries);
		$foundwatches = DB::select(DB::raw($query));
		return $foundwatches;
	}

	/**
	 * Search in Watches View for User
	 *
	 * @return View
	 */
	public function searchFull()
	{
		$searchinput = Input::get('searchall');
		$order = Input::get('orderby');
		$searchinput = 'oak';
		$order = 'sellingprice';
		$direction = 'DESC';
		// sanitize searchinput
		$searchstrings = explode(' ',$searchinput);
		$searchfields = array('brandname','modelname','reference');
		foreach ($searchfields as $key => $columnname) {
			foreach ($searchstrings as $key => $searchstring) {
				$queries[] = 'SELECT id, modelname, brandname, reference, sellingprice FROM `watchesjoined` WHERE '.$columnname.' LIKE "%'.$searchstring.'%" AND `status_id` = "2"';
			}
		}

		$query = implode(' UNION ', $queries);
		if(isset($order)) $query = $query.' ORDER BY '.$order.' '.$direction;
		$foundwatches = DB::select(DB::raw($query));
		$watchesall = DB::select(DB::raw($query));
		// Session::set('watchesall', $watchesall);
		// Session::set('watches_url','/brand/'.$brand_id.'/'.$brandslist[$brand_id]);
		// Session::set('page',$watches->getCurrentPage());
		return $query;
	}

	/**
	 * Show the watches
	 *
	 * @return Response
	 */
	public function getWatches() {
		// kind = all / brand / model / search
		$orderby_dir = (Input::get('orderby_dir')) ? Input::get('orderby_dir') : Session::get('orderby_dir');
		$searchinput = (Input::get('fullsearch')) ? Input::get('fullsearch') : Session::get('fullsearch');
		$brand_id = (Input::get('brand_id')) ? Input::get('brand_id') : Session::get('brand_id');
		$model_id = (Input::get('model_id')) ? Input::get('model_id') : Session::get('model_id');		
		$kind = (Input::get('kind')) ? Input::get('kind') : Session::get('kind');

		// set order
		$orderby = explode('-', $orderby_dir)[0];
		$dir = explode('-', $orderby_dir)[1];

		// set search
		$searchinput = '1200';
		$searchstrings = explode(' ',$searchinput);
		$searchfields = array('brandname','modelname','reference');
		
		// get brands
		$brands = Brand::with(array('watches' => function($query){
			$query->where('status_id', '=', '2');
		}))->orderBy('name')->get();

		// main Query
		$q = Watch::with(array('images' => function($query) {
			$query->where('order', '=', '1');
		}))
		->where('status_id', '=', '2')
		->join('models', 'models.id', '=', 'watches.model_id')
		->join('brands', 'brands.id', '=', 'watches.brand_id')
		->join('bands', 'bands.id', '=', 'watches.band_id')
		->join('buckles', 'buckles.id', '=', 'watches.buckle_id')
		->join('caseboxes', 'caseboxes.id', '=', 'watches.casebox_id')
		->join('movements', 'movements.id', '=', 'watches.movement_id')
		->join('papers', 'papers.id', '=', 'watches.paper_id')
		->select(
			'watches.*',
			'models.name as modelname',
			'brands.name as brandname',
			'bands.name as bandname',
			'buckles.name as bucklename',
			'caseboxes.name as caseboxname',
			'movements.name as movementname',
			'papers.name as papername',
			'watches.created_at');

		// kind brand
		if($kind=='brand') {
			$q->where('brand_id', '=', $brand_id);
		}
		// kind model
		if($kind=='model') {
		}
		// order
		$q->orderBy($orderby,$dir);

		// finalize $watches
		$watches = $q->paginate(8);
		$watchesall = $q->get();

		// set data
		$data = array(
			'watches' => $watches,
			'brands' => $brands
		);

		Session::set('brand_id', $brand_id);
		Session::set('model_id', $model_id);
		if(isset($fullsearch)) Session::set('fullsearch', $fullsearch);
		Session::set('orderby_dir', $orderby_dir);
		Session::set('kind', $kind);
		Session::set('watchesall', $watchesall);
		Session::set('orderby_dir', $orderby.'-'.$dir);
		Session::set('page', $watches->getCurrentPage());

		// return Request::url();
		return View::make('watches.single', $data);
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
		if(!Session::get('watchesall')) {
			return Redirect::to(Config::get('application.language'));
		}
		foreach (Session::get('watchesall') as $key => $value) {
			if($value->id==$id) $current = $key;
		}
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
			'brands' => $brands,
			'current' => $current
		);
		return View::make('watches.show', $data);
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

	public function listWatches()
	{
		
	}

	public function watchesInBrand($brand_id)
	{
		// get order
		$orderby = Input::get('orderby');
		$dir = explode('-', $orderby);
		$orderby = explode('-', $orderby);
		// returns the watches list
		$q = Watch::with(array('images' => function($query)
		{
		    $query->where('order', '=', '1');
		}))
		->where('status_id', '=', '2')
		->where('brand_id', '=', $brand_id)
		->join('models', 'models.id', '=', 'watches.model_id')
		->join('brands', 'brands.id', '=', 'watches.brand_id')
		->select(
			'watches.*',
			'brands.name as brandname',
			'models.name as modelname',
			'watches.created_at');

		$q->orderBy('modelname');
		$watches = $q->paginate(8);

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
			'brands' => $brands,
			'selected_brand' => $brand_id
		);
		$watchesall = Watch::where('status_id', '=', '2')
		->where('brand_id', '=', $brand_id)
		->join('brands', 'brands.id', '=', 'watches.brand_id')
		->join('models', 'models.id', '=', 'watches.model_id')
		->select(
			'watches.id',
			'brands.name as brandname',
			'models.name as modelname',
			'watches.created_at')
		->orderBy('created_at')
		->get();
		Session::set('watchesall', $watchesall);
		Session::set('watches_url','/brand/'.$brand_id.'/'.$brandslist[$brand_id]);
		Session::set('page',$watches->getCurrentPage());
		return View::make('watches.single', $data);
	}

	public function allWatches()
	{
		// returns the watches list
		$watches = Watch::with(array('images' => function($query)
		{
		    $query->where('order', '=', '1');
		}))
		->where('status_id', '=', '2')
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
			'brands' => $brands,
			'selected_brand' => 'all'
		);
		Session::set('watches_url','/watch/all');
		Session::set('page',$watches->getCurrentPage());
		return View::make('watches.single', $data);
	}

	// public function searchBrand($str)
	// {
	// 	$brands = DB::table('watches')
	// 		->Join('brands', 'brands.id', '=', 'watches.brand_id')
	// 		->where('brands.name', 'LIKE', '%'.$str.'%')
	// 		->lists('name', 'brand_id');
	// 	return $brands;
	// }
	// public function searchModel($str)
	// {
	// 	$models = DB::table('watches')
	// 		->Join('models', 'models.id', '=', 'watches.model_id')
	// 		->where('models.name', 'LIKE', '%'.$str.'%')
	// 		->lists('name', 'model_id');
	// 	return $models;
	// }

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
