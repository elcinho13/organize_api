<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_address extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_address';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

    public function place() {
        return $this->belongsTo('place', 'place');
    }
}
