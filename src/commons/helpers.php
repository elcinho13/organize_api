<?php

use Slim\Slim;

class helpers {

    static function jsonResponse($error, $data) {
        $app = Slim::getInstance();
        $response = [
            'has_error' => $error['has_error'],
            'type' => $error['type'],
            'code' => $error['code'],
            'message' => $error['message'],
            'exception' => $error['exception'],
            'data' => $data
        ];

        return $app->response()->body(json_encode($response));
    }

    static function authenticate($token) {
        if (is_null($token)) {
            return false;
        } else {
            $is_authenticate = token::query()->where('access_token', '=', $token)->first();
            if (is_null($is_authenticate)) {
                $is_authenticate = user_admin::query()->where('access_token', '=', $token)->first();
                if (is_null($is_authenticate)) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        }
    }

}
