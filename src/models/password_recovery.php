<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class password_recovery extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_password_recovery';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

}
