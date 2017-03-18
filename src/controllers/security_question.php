<?php

$app->get('/security_questions/:user_id', function ($user_id) {
    try {
        $questions = security_question::with('user')->get();

        foreach ($questions as $question) {
            if (!$question->private_use) {
                $data[] = $question;
            } elseif ($question->private_use && $question->user == $user_id) {
                $data[] = $question;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(5, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/security_question/save', function () use ($app) {
    try {
        $security_question = new security_question();
        $security_question->user = $app->request()->post('user');
        $security_question->locale = $app->request()->post('locale');
        $security_question->security_question = $app->request()->post('security_question');
        $security_question->private_use = $app->request()->post('private_use');
        if ($security_question->save()) {
            $data = security_question::with('user')->find($security_question->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

