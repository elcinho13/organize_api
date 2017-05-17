<?php

$app->post('/password_recovery', function() use($app) {
    try {
        $format = 'Y-m-d H:i:s';
        $current_date = new DateTime();
        $validate_date = new DateTime();
        $validate_date->add(new DateInterval('P1D'));

        $user_mail = $app->request()->post('mail');
        $user_security_id = $app->request()->post('user_security_id');
        $user_anwser = $app->request()->post('user_anwser');

        $user = user::query()->where('mail', '=', $user_mail)->first();
        $user_id = $user->id;
        $user_security = user_security::query()->where('user', '=', $user_id)->first();
        
        if (trim($user_security->security_question) == trim($user_security_id) 
                && strcasecmp(trim($user_security->security_answer), trim($user_anwser) == 0)) {
            $password_recovery = new password_recovery();
            $password_recovery->user = $user_id;
            $password_recovery->token = generate_password_token($user_id, $user_security_id, $user_anwser);
            $password_recovery->send_date = $current_date->format($format);
            $password_recovery->validate_date = $validate_date->format($format);

            if ($password_recovery->save()) {
                $data = $password_recovery;
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
        else{
            $error = new custonError(true, 1, 1, 'Validação de segurança violada.');
            return helpers::jsonResponse($error->parse_error(), null);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

function generate_password_token($user_id, $user_security_id, $user_anwser) {
    $token = $user_id . microtime() . $user_security_id . $user_anwser;
    return md5($token);
}

function send_mail($mail){
    
}
