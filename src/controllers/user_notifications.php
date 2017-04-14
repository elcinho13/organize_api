<?php

$app->get('/notification/user/:user', function($user_id) {
    try {
        $data = notification::with('user.user_type','user.first_access','user.token','user.plan')
                ->where('user', '=', $user_id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/notification/:id', function($id) {
    try {
        $data = notification::with('user.user_type','user.first_access','user.token','user.plan')->find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/notification/:save', function() use ($app) {
    try {
        $notification = new notification();
        $notification->user = $app->request()->post('user');
        $notification->brief_description = $app->request()->post('brief_description');
        $notification->description = $app->request()->post('description');
        $notification->read = false;

        if ($notification->save()) {
            $data = notification::with('user.user_type','user.first_access','user.token','user.plan')->find($notification->id);
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
        $notification = notification::find($id);
        $notification->read = $app->request->post('read');

        if ($notification->update()) {
            $data = notification::with('user.user_type','user.first_access','user.token','user.plan')->find($notification->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

