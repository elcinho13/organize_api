<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class plan extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_plan';

    public function advantages() {
        return $this->hasMany('plan_advantages', 'plan');
    }

    public function price() {
        return $this->hasMany('plan_price', 'plan');
    }

}
