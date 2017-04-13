<?php

$app->post('/user_term/accept', function () use ($app){
    try{
        $user_term = new user_term();
        $user_term->user = $app->request()->post('user_id');
        $user_term->term = $app->request()->post('term_id');
        $user_term->term_accept = $app->request()->post('term_accept');
        $user_term->term_accept_date = $app->request()->post('term_accept_date');
        if($user_term->save()){
            $data = user_term::with('user.user_type','user.first_access','user.token','user.plan', 'term')->find($user_term->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

