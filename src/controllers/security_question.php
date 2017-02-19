<?php

$app->get('/security_questions/:user_id', function ($user_id){
    try{
        $data = array();
        $security_questions = security_question::all();
        foreach ($security_questions as $security_question){
            if ($security_question->private == 0 || $security_question->org_user_id == $user_id){
                $data[] = $security_question;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(5, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/security_question/save', function () use ($app){
    try{
        $security_question = new security_question();
        $security_question->org_user_id = $app->request()->post('org_user_id');
        $security_question->locale = $app->request()->post('locale');
        $security_question->security_question = $app->request()->post('security_question');
        $security_question->private = $app->request()->post('private');
        if($security_question->save()){
            return helpers::jsonResponse($security_question);
        }
        
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
