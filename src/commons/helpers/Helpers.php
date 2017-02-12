<?php

/**
 * Author:  marcelamelo
 * Created: 12/02/2017
 * 
 * Class: helpers
 */

use Slim\Slim;

class Helpers{
    static function jsonResponse($data){
        $app = Slim::getInstance();
        $app->response()->header('Content-Type', 'application/json');
        return $app->response()->body(json_encode($data));
    }
}
