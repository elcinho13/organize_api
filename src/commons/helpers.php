<?php

use Slim\Slim;

class helpers {

    static function jsonResponse($error, $data) {
        $app = Slim::getInstance();

        $response = new stdClass();
        $response->error = $error['has_error'];
        $response->code = $error['code'];
        $response->message = $error['message'];
        $response->exception = $error['exception'];
        $response->data = $data;

        $app->response()->header('Content-Type', 'application/json');
        return $app->response()->body(json_encode($response));
    }

}
