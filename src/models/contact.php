<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class contact extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_contact';

    public function contact_type() {
        return $this->belongsTo('contact_type', 'contact_type');
    }

}
