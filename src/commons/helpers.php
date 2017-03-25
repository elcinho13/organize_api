<?php

use Slim\Slim;

class helpers {

    static function jsonResponse($error, $data) {
        $app = Slim::getInstance();
        
        if(is_null($data)){
            if(!$error['has_error']){
                $error['is_new'] = 1;
            }
            $response = $error;
        }
        else{
            $response = $data;
        }
        
        $app->response()->header('Content-Type', 'application/json');
        return $app->response()->body(json_encode($response));
    }
}
