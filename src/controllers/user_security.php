<?php
$app->post('/user_security/save', function () use($app){
    try{
        $user_security = new user_security();
        $user_security->org_user_id = $app->request()->post('user_id');
        $user_security->org_security_question_id = $app->request()->post('security_question_id');
        $user_security->security_answer = $app->request()->post('security_answer');
        $user_security->last_update_date = $app->request()->post('last_update_date');
        $user_security->last_update_platform = $app->request()->post('last_update_platform');
        $user_security->last_update_identifier = $app->request()->post('last_update_identifier');
        
        if($user_security->save()){
            $user_security = user_security::with('org_user_id', 'org_security_question_id')->get()->find($user_security->id);
            return helpers::jsonResponse($user_security);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/user_security/:user_id', function ($user_id) {
    try{
        $data = user_security::query()->where('org_user_id', '=', $user_id)->first();
        $user_security = user_security::with('org_user_id', 'org_security_question_id')->get()->find($data->id);
        
        return helpers::jsonResponse($user_security);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

