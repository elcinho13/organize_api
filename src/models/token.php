<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class token extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_token';

    public function login_type() {
        return $this->belongsTo('login_type', 'login_type');
    }

    public function access_platform() {
        return $this->belongsTo('access_platform', 'access_platform');
    }

}
