<?php

class Payment extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function watches()
	{
		return $this->hasMany('Watch');
	}
}
