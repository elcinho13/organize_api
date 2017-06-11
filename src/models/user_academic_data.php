<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_academic_data extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_academic_data';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

    public function literacy() {
        return $this->belongsTo('literacy', 'literacy');
    }

    public function institution() {
        return $this->belongsTo('institution', 'institution');
    }

    public function course() {
        return $this->belongsTo('course', 'course');
    }

    public function academic_class() {
        return $this->belongsTo('academic_class', 'academic_class');
    }

}
