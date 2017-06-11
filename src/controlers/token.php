<?php

$app->post('/token/save', function () use($app) {
    try {
        $salt = $app->request()->post('user_id') . $app->request()->post('login_type') . $app->request()->post('access_platform') . $app->request()->post('access_date');

        $token = new token();
        $token->login_type = $app->request()->post('login_type');
        $token->access_platform = $app->request()->post('access_platform');
        $token->access_token = application::generate_code(50, $salt);
        $token->access_date = $app->request()->post('access_date');
        $token->keep_logged = $app->request()->post('keep_logged');
        $token->user_last_update = $app->request()->post('user_admin');

        if ($token->save()) {
            $user = user::find($app->request()->post('user_id'));
            $old_token = $user->token;
            if ($old_token == null) {
                set_new_token($user, $token->id);
            } else {
                $user->token = null;
                if ($user->update()) {
                    delete_old_token($user, $old_token, $token->id);
                }
            }
            $error = new custonError(false, 0);
            $data = token::with(relations::getTokenRelations())->find($token->id);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

function delete_old_token($user, $old_token, $new_token_id) {
    try {
        $token = token::find($old_token);
        if ($token->delete()) {
            set_new_token($user, $new_token_id);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 1, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
}

function set_new_token($user, $token_id) {
    try {
        $user->token = $token_id;
        if ($user->update()) {
            return;
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
}

$app->post('/login', function () use($app) {
    try {
        $user = user::query()
                ->where('mail', '=', $app->request()->post('mail'))
                ->first();
        if (!is_null($user) && $user->password == application::cryptPassword($user->birth_date, $app->request()->post('password'))) {
            $error = new custonError(false, 0);
            $data = user::with(relations::getUserRelations())->find($user->id);
        } else {
            $error = new custonError(true, 7);
            $data = null;
        }
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 1, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/login/admin', function () use($app) {
    try {
        $user = user_admin::query()
                ->where('mail', '=', $app->request()->post('mail'))
                ->first();
        if (!is_null($user) && $user->password == application::cryptPassword($user->birth_date, $app->request()->post('password'))) {
            $user_admin = updateLoginAdmin($user->id);
            
            if (!is_null($user_admin)) {
                $error = new custonError(false, 0);
                $data = user_admin::find($user_admin->id);
            } else {
                $error = new custonError(true, 7);
                $data = null;
            }
        } else {
            $error = new custonError(true, 7);
            $data = null;
        }
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 1, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

function updateLoginAdmin($user_id) {
    $user_admin = user_admin::find($user_id);
    $current_date = date('Y-m-d H:i:s');
    $salt = $user_admin->id . $user_admin->birth_date . $user_admin->cpf . microtime();
    $token = application::generate_code(100, $salt);
    $user_admin->token = $token;
    $user_admin->last_access = $current_date;
   
    if ($user_admin->update()) {
        $user = user_admin::find($user_admin->id);
        
        return $user;
    } else {
        return null;
    }
}
