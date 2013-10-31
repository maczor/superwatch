<?php

class Image extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function watch()
    {
        return $this->belongsTo('Watch');
    }
}
