<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class plan_price extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_plan_price';

    public function plan() {
        return $this->belongsTo('plan', 'plan');
    }

}
