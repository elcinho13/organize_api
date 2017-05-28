<?php

$app->get('/notification/user/:user', function($user_id) {
    try {
        $data = user_notifications::where('user', '=', $user_id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/notification/:id', function($id) {
    try {
        $data = user_notifications::find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/notification/:save', function() use ($app) {
    try {
        $user_notifications = new user_notifications();
        $user_notifications->user = $app->request()->post('user');
        $user_notifications->brief_description = $app->request()->post('brief_description');
        $user_notifications->description = $app->request()->post('description');
        $user_notifications->notification_date = $app->request()->post('notification_date');
        $user_notifications->is_read = false;
        $user_notifications->user_last_update = $app->request()->post('user_admin');

        if ($user_notifications->save()) {
            $data = user_notifications::find($user_notifications->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/notification/:id/read', function($id) use ($app) {
    try {
        $user_notifications = user_notifications::find($id);
        $user_notifications->is_read = $app->request->post('is_read');

        if ($user_notifications->update()) {
            $data = user_notifications::find($user_notifications->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

