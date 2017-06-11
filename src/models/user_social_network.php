<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_social_network extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_social_network';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

    public function social_network_type() {
        return $this->belongsTo('social_network_type', 'social_network_type');
    }

}
