<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class notification extends Eloquent
{
	public $timestamps = true;
	protected $table = 'org_notification';	

	public function user(){
    return $this->belongsTo('user','user');
    }

}