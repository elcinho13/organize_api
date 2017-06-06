<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_contact extends Eloquent{

	public $timestamps = true;
	protected $table = 'org_user_contact';

	public function user() {
        return $this->belongsTo('user', 'user');
	} 

	public function contact_type() {
        return $this->belongsTo('contact_type', 'contact_type');
    }

    public function contact() {
    	return $this->belongsTo('contact', 'contact');
    }
}
