<?php

$app->post('/user_security/save', function () use($app) {
    try {
        $user_security = new user_security();
        $user_security->user = $app->request()->post('user');
        $user_security->security_question = $app->request()->post('security_question');
        $user_security->security_answer = $app->request()->post('security_answer');
        $user_security->last_update_date = $app->request()->post('last_update_date');
        $user_security->access_platform = $app->request()->post('access_platform');
        $user_security->last_update_identifier = $app->request()->post('last_update_identifier');

        if ($user_security->save()) {
            $data = user_security::with('user', 'security_question', 'access_platform')
                    ->find($user_security->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/user_security/:user_id', function ($user_id) {
    try {
        $user_security = user_security::query()
                ->where('user', '=', $user_id)
                ->first();
        $data = user_security::with('user', 'security_question', 'access_platform')
                ->find($user_security->id);

        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user_security/:id', function ($id) use($app) {
    try {
        $user_security = user_security::with('user', 'security_question')
                ->find($id);
        $user_security->security_question = $app->request()->post('security_question');
        $user_security->security_answer = $app->request()->post('security_answer');
        $user_security->last_update_date = $app->request()->post('last_update_date');
        $user_security->access_platform = $app->request()->post('access_platform');
        $user_security->last_update_identifier = $app->request()->post('last_update_identifier');

        if ($user_security->update()) {
            $data = user_security::with('user', 'security_question', 'access_platform')
                    ->find($user_security->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user_security/:id/edit', function ($id) use($app) {
    try {
        $user_security = user_security::with('user', 'security_question')
                ->find($id);
        $user_security->last_update_date = $app->request()->post('last_update_date');
        $user_security->access_platform = $app->request()->post('access_platform');
        $user_security->last_update_identifier = $app->request()->post('last_update_identifier');

        if ($user_security->update()) {
            $data = user_security::with('user', 'security_question', 'access_platform')
                    ->find($user_security->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

