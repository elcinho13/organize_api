<?php

$app->get('/user_settings/:id', function($id) {
    try {
        $data = user_settings::with(relations::getUserSettingsRelations())->find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/user_settings/user/:user', function($user_id) {

    try {
        $data = user_settings::with(relations::getUserSettingsRelations())
                ->where('user', '=', $user_id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/user_settings/save', function() use($app) {
    try {
        $user_settings = new user_settings();
        $user_settings->user = $app->request()->post('user');
        $user_settings->setting = $app->request()->post('setting');
        $user_settings->checking = true;
        $user_settings->value = $app->request()->post('value');
        $user_settings->user_last_update = $app->request()->post('user_admin');

        if ($user_settings->save()) {
            $data = user_settings::with(relations::getUserSettingsRelations())->find($user_settings->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_settings/:id/checking', function($id) use ($app) {
    try {

        $user_settings = user_settings::find($id);
        $user_settings->checking = $app->request()->post('checking');

        if ($user_settings->update()) {
            $data = user_settings::with(relations::getUserSettingsRelations())->find($user_settings->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


