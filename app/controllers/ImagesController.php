<?php

class ImagesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return Watch::find($id)->images;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$filename = Input::get('name');
		$id = Input::get('watch_id');
		$lastorder = Watch::find($id)->images()->orderBy('order', 'DESC')->take(1)->get(array('order'));
		if ($lastorder->count()>0) {
	        $order = $lastorder[0]->order;
	    } else {
	        $order = 0;
	    }
		$order++;
		$image = new Image();
		$image->watch_id = $id;
		$image->filename = $filename;
		$image->order = $order;
		$image->save();
		$all4watch = Watch::find($id)->images()->get();
		return $all4watch;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Image::find($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$image = Image::find($id);
		$path = public_path().'/uploaded/files/';
		File::delete($path.'xs/'.$image->filename);
		File::delete($path.'thumbnail/'.$image->filename);
		File::delete($path.$image->filename);
		$image->delete();
	}

	public function reorder($id)
	{
		$input = Input::get();
		$order = 0;
		foreach ($input as $key => $imageid) {
			$order++;
			$image = Image::find($imageid);
			$image->order = $order;
			$image->save();
		}
		// return $imageid;
	}

}
