<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_notifications extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_notifications';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

}
