<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_privacy extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_privacy';

    public function user() {
        return $this->belongsTo('user', 'user');
    }
    
    public function privacy() {
        return $this->belongsTo('privacy', 'privacy');
    }

}
