<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_settings extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_settings';

    public function user() {
        return $this->belongsTo('user', 'user');
    }
    
    public function settings() {
        return $this->belongsTo('settings', 'settings');
    }

}
