<?php

$app->post('/user_security/save', function () use($app) {
    try {
        $user_security = new user_security();
        $user_security->user = $app->request()->post('user_id');
        $user_security->security_question = $app->request()->post('security_question');
        $user_security->security_answer = $app->request()->post('security_answer');
        $user_security->last_update_date = $app->request()->post('last_update_date');
        $user_security->access_platform = $app->request()->post('access_platform');
        $user_security->last_update_identifier = $app->request()->post('last_update_identifier');
        $user_security->user_last_update = $app->request()->post('user_admin');

        if ($user_security->save()) {
            $data = user_security::with(relations::getUserSecurityRelations())->find($user_security->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_security/:id/edit', function ($id) use($app) {
    try {
        $user_security = user_security::with(relations::getUserSecurityRelations())->find($id);
        $fields = $app->request()->post();
              
        foreach ($fields as $key => $value){
            $user_security->$key = $value;
        }

        if ($user_security->update()) {
            $data = user_security::with(relations::getUserSecurityRelations())->find($user_security->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

