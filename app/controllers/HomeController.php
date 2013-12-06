<?php

class HomeController extends BaseController {

		/**
	 * Show the watches
	 *
	 * @return Response
	 */
	public function getWatches() {
		// set vars
		$brand_id = (Session::get("brand_id")) ? Session::get("brand_id") : false;
		$model_id = (Session::get("model_id")) ? Session::get("model_id") : false;
		$orderby_dir = (Session::get('orderby_dir')) ? Session::get('orderby_dir') : 'created_at-desc';
		$kind = (Session::get('kind'))? Session::get('kind') : 'all';

		// set main defaults
		// set kind
		Session::set('kind', $kind); // all / brand / model / search
		// set order
		Session::set('orderby_dir', $orderby_dir);
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
		if($brand_id) {
			if($brand_id!='all') $q->where('brand_id', '=', $brand_id);
		}
		// kind model
		if($model_id) {
			$q->where('brand_id', '=', $brand_id);
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

		Session::set('watchesall', $watchesall);

		// return Request::url();
		return View::make('home', $data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 */
	public function index()
	{
		if(!Session::get('watches_url')) Session::set('watches_url','/watch/all');
		$url = Session::get('watches_url');
		$brands = Brand::with(array('watches' => function($query){
			$query->where('status_id', '=', '2');
		}))->orderBy('name')->get();
		$brandslist = Brand::all()->lists('name','id');
		$modelslist = Model::orderBy('name')->lists('name','id');
		$movements = Movement::all()->lists('name','id');
		$caseboxes = Casebox::all()->lists('name','id');
		$bands = Band::all()->lists('name','id');
		$buckles = Buckle::all()->lists('name','id');
		$papers = Paper::all()->lists('name','id');

		if($url=='/watch/all' || Input::get('watches')=='all') {
			$watches = Watch::with(array('images' => function($query)
			{
			    $query->where('order', '=', '1');
			}))
			->where('status_id', '=', '2')
			->orderBy('created_at')->paginate(8);
			$watchesall = Watch::where('status_id', '=', '2')
			->join('brands', 'brands.id', '=', 'watches.brand_id')
			->join('models', 'models.id', '=', 'watches.model_id')
			->select(
				'watches.id',
				'brands.name as brandname',
				'models.name as modelname',
				'watches.created_at')
			->orderBy('created_at')
			->get();
			Session::set('watches_url', '/watch/all');
			Session::set('watchesall', $watchesall);
		} else {
			$vars = explode('/', $url);
			if($vars[1]=='brand') {
				$brand_id = $vars[2];
				$watches = Watch::with(array('images' => function($query)
				{
					$query->where('order', '=', '1');
				}))
				->where('status_id', '=', '2')
				->where('brand_id', '=', $brand_id)
				->orderBy('created_at')->paginate(8);
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
			}
		}
		if(!isset($brand_id)) $brand_id = 'all';
		$data = array(
			'watches' => $watches,
			'brands' => $brands,
			'brandslist' => $brandslist,
			'modelslist' => $modelslist,
			'movements' => $movements,
			'caseboxes' => $caseboxes,
			'bands' => $bands,
			'buckles' => $buckles,
			'papers' => $papers,
			'selected_brand' => $brand_id
		);
		return View::make('home', $data);
	}

	/**
	 *
	 */
	public function logos()
	{
		$brands = Brand::all();
		$data = array(
			'brands' => $brands
		);
		return View::make('logos', $data);
	}

	public function sellmywatch()
	{
		// tmp lang
		$thankyou = Lang::get('home.Thank you. I will contact you as soon as possible.');
		$error = Lang::get('home.Message was not sent.');
		$destinationPath = public_path().'/attachments/'.str_random(8);
		$upload_success = true;
		$hasFile = false;
		$files = Input::file('filesToUpload');
		foreach ($files as $file) {
			if($file) {
				$hasFile = true;
				$filename = $file->getClientOriginalName();
				if($upload_success) $upload_success = $file->move($destinationPath, $filename);
			}
		}
		if($upload_success) {
			// send email and on success
			$data = Input::all();
			$data['hasFile'] = $hasFile;
			$data['destinationPath'] = $destinationPath;
			Mail::send('emails.sellwatch', $data, function($message) use ($data)
			{
				$message->to('maczor@maczor.com', 'ME')->subject('Sell my watch');
				if($data['hasFile']) {
					foreach ($data['filesToUpload'] as $file) {
						$filename = $file->getClientOriginalName();
						$message->attach($data['destinationPath'].'/'.$filename);
					}
				}
			});
			// delete files
			if($hasFile) {
				File::deleteDirectory($destinationPath);
			}
			return '
			<script language="javascript" type="text/javascript">
				window.top.window.stopSell("'.
					$thankyou
				.'");
			</script>
			';
		} else {
			return '
			<script language="javascript" type="text/javascript">
				window.top.window.stopSell("'.
					$error
				.'");
			</script>
			';
		}
	}

}
