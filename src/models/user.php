<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user';

    public function user_type() {
        return $this->belongsTo('user_type', 'user_type');
    }
    
    public function token() {
        return $this->belongsTo('token', 'token');
    }

    public function plan() {
        return $this->belongsTo('plan', 'plan');
    }
    
    public function user_term(){
        return $this->hasOne('user_term', 'user');
    }
}
