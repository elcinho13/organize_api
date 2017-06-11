<?php

$app->post('/user_address/save', function () use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $user_address = new user_address();
            $user_address->user = $app->request()->post('user_id');
            $user_address->place = $app->request()->post('place_id');
            $user_address->complement = $app->request()->post('complement');
            $user_address->user_last_update = $app->request()->post('user_admin');

            if ($user_address->save()) {
                $data = user_address::with(relations::getUserAddressRelations())->find($user_address->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_address/:id', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $user_address = user_address::with(relations::getUserAddressRelations())->find($id);
            $fields = $app->request()->post();

            foreach ($fields as $key => $value) {
                $user_address->$key = $value;
            }

            if ($user_address->update()) {
                $data = user_address::with(relations::getUserAddressRelations())->find($user_address->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

