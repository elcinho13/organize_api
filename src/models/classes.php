<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class classes extends Eloquent{

	public $timestamp = true;
	protected $table = 'org_class';

	public function institution(){
        return $this->belongsTo('institution', 'institution');
    }

    public function course(){
    	return $this->belongsTo('course', 'course');
    }

    public function shift(){
    	return $this->belongsTo('shift', 'shift');
    }
}