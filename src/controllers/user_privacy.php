<?php

$app->get('/user_privacy/:id', function($id) {
    try {
        $data = user_privacy::with('user.user_type','user.first_access','user.token','user.plan', 'privacy')->find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/user_privacy/user/:user', function($user_id) {

    try {
        $data = user_privacy::with('user.user_type','user.first_access','user.token','user.plan', 'privacy')
                ->where('user', '=', $user_id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/user_privacy/save', function() use($app) {
    try {
        $user_privacy = new user_privacy();
        $user_privacy->user = $app->request()->post('user');
        $user_privacy->privacy = $app->request()->post('privacy');
        $user_privacy->checking = true;

        if ($user_privacy->save()) {
            $data = user_privacy::with('user.user_type','user.first_access','user.token','user.plan', 'privacy')->find($user_privacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_privacy/:id/checking', function($id) use ($app) {
    try {

        $user_privacy = user_privacy::find($id);
        $user_privacy->checking = $app->request()->post('checking');

        if ($user_privacy->update()) {
            $data = user_privacy::with('user.user_type','user.first_access','user.token','user.plan', 'privacy')->find($user_privacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


