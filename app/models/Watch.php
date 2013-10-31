<?php

class Watch extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function images()
	{
		return $this->hasMany('Image');
	}

	public function keywords()
	{
		return $this->hasOne('Keyword');
	}

	public function descriptions()
	{
		return $this->hasOne('Description');
	}

	public function brands()
    {
        return $this->belongsTo('Brand');
    }

    public function models()
    {
        return $this->belongsTo('Model');
    }

    public function movements()
    {
        return $this->belongsTo('Movement');
    }

    public function cases()
    {
        return $this->belongsTo('Case');
    }

    public function bands()
    {
        return $this->belongsTo('Band');
    }

    public function buckles()
    {
        return $this->belongsTo('Buckle');
    }

    public function papers()
    {
        return $this->belongsTo('Paper');
    }

    public function boxes()
    {
        return $this->belongsTo('Box');
    }

    public function statuses()
    {
        return $this->belongsTo('Status');
    }

    public function payments()
    {
        return $this->belongsTo('Payment');
    }
}
