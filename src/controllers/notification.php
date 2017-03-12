<?php

$app->get('/notification/user/:user', function($user_id) {
    try {
        $data = notification::query()->where('user', '=', $user_id)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/notification/:id', function($id) {
    try {
        $data = notification::find($id);
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/notification/:save', function() use ($app) {
    try {
        $notification = new notification();
        $notification->user = $app->request()->post('user');
        $notification->brief_description = $app->request()->post('brief_description');
        $notification->description = $app->request()->post('description');
        $notification->read = $app->request->post('read');

        if ($notification->save()) {
            $data = notification::with('user')->find($notification->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/notification/:id/read', function($id) use ($app) {
    try {
        $notification = notification::find($id);
        $notification->read = $app->request->post('read');

        if ($notification->update()) {
            $data = notification::with('user')->find($notification->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

