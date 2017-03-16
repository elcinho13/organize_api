<?php

$app->get('/user_privacy/:id', function($id) {
    try {
        $data = user_privacy::with('user', 'privacy')->find($id);
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


$app->get('/user_privacy/user/:user', function($user_id) {

    try {
        $data = user_privacy::with('user', 'privacy')
                ->where('user', '=', $user_id)
                ->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


$app->post('/user_privacy/save', function() use($app) {
    try {
        $user_privacy = new user_privacy();
        $user_privacy->user = $app->request()->post('user');
        $user_privacy->privacy = $app->request()->post('privacy');
        $user_privacy->checking = true;

        if ($user_privacy->save()) {
            $data = user_privacy::with('user', 'privacy')->find($user_privacy->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user_privacy/:id/checking', function($id) use ($app) {
    try {

        $user_privacy = user_privacy::find($id);
        $user_privacy->checking = $app->request()->post('checking');

        if ($user_privacy->update()) {
            $data = user_privacy::with('user', 'privacy')->find($user_privacy->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});


