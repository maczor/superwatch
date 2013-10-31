<?php

class Brand extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function watches()
	{
		return $this->hasMany('Watch');
	}

	public function models()
    {
        return $this->hasMany('Model');
    }
}
