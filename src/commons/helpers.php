<?php

use Slim\Slim;

class helpers {

    static function jsonResponse($data) {
        $app = Slim::getInstance();
        $app->response()->header('Content-Type', 'application/json');
        return $app->response()->body(json_encode($data));
    }

}
