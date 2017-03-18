<?php

use Slim\Slim;

class helpers {

    static function jsonResponse($error, $data) {
        $app = Slim::getInstance();
        
        if(is_null($data)){
            $response = $error;
        }
        else{
            $response = $data;
        }
        
        $app->response()->header('Content-Type', 'application/json');
        return $app->response()->body(json_encode($response));
    }
}
