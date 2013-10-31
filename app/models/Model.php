<?php

class Model extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function watches()
	{
		return $this->hasMany('Watch');
	}

	public function brands()
	{
		return $this->belongsTo('Brand');
	}

}