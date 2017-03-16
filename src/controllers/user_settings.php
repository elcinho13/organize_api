<?php

$app->get('/user_settings/:id', function($id) {
    try {
        $data = user_settings::with('user', 'settings')->find($id);
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


$app->get('/user_settings/user/:user', function($user_id) {

    try {
        $data = user_settings::with('user', 'settings')
                ->where('user', '=', $user_id)
                ->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


$app->post('/user_settings/save', function() use($app) {
    try {
        $user_settings = new user_settings();
        $user_settings->user = $app->request()->post('user');
        $user_settings->settings = $app->request()->post('settings');
        $user_settings->checking = true;
        $user_settings->value = $app->request()->post('value');

        if ($user_settings->save()) {
            $data = user_settings::with('user', 'settings')->find($user_settings->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user_settings/:id/checking', function($id) use ($app) {
    try {

        $user_settings = user_settings::find($id);
        $user_settings->checking = $app->request()->post('checking');

        if ($user_settings->update()) {
            $data = user_settings::with('user', 'settings')->find($user_settings->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


