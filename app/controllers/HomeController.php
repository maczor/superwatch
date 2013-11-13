<?php

class HomeController extends BaseController {

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
