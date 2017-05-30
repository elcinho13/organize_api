<?php

$app->get('/security_questions/:user_id', function ($user_id) {
    try {
        $data = security_question::query()->where('private_use', '=', 0)->orWhere('user', '=', $user_id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/security_question/save', function () use ($app) {
    try {
        $security_question = new security_question();
        $security_question->user = $app->request()->post('user');
        $security_question->locale = $app->request()->post('locale');
        $security_question->security_question = $app->request()->post('security_question');
        $security_question->private_use = $app->request()->post('private_use');
        $security_question->user_last_update = $app->request()->post('user_admin');
        
        if ($security_question->save()) {
            $data = security_question::find($security_question->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
