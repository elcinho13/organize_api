<?php

$app->post('/token/save', function () use($app) {
    try {
        $token = new token();
        $token->user = $app->request()->post('user');
        $token->first_access = $app->request()->post('first_access');
        $token->login_type = $app->request()->post('login_type');
        $token->access_token = generate_token($app->request()->post('user_id'));
        $token->access_platform = $app->request()->post('access_platform');
        $token->access_date = $app->request()->post('access_date');
        $token->keep_logged = $app->request()->post('keep_logged');


        if ($token->save()) {
            $data = token::with('user.user_type','user.term','user.plan', 'login_type', 'first_access', 'access_platform')
                    ->find($token->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/token/:id', function ($id) use($app) {
    try {
        $token = token::find($id);
        $token->user = $app->request()->post('user');
        $token->login_type = $app->request()->post('login_type');
        $token->access_token = generate_token($app->request()->post('user_id'));
        $token->access_platform = $app->request()->post('access_platform');
        $token->access_date = $app->request()->post('access_date');
        $token->keep_logged = $app->request()->post('keep_logged');

        if ($token->update()) {
            $data = token::with('user.user_type','user.term','user.plan', 'login_type', 'first_access', 'access_platform')
                    ->find($token->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/token/:first_access_id', function ($first_access_id) {
    try {
        $data = token::with('user.user_type','user.term','user.plan', 'login_type', 'first_access', 'access_platform')
                ->where('first_access', '=', $first_access_id)
                ->first();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/login', function () use($app) {
    try {
        $user = user::query()
                ->where('mail', '=', $app->request()->post('mail'))
                ->first();
        if (!is_null($user) && $user->password == application::cryptPassword($user->birth_date, $app->request()->post('password'))) {
            $error = new custonError(false, 0);
            $data = user::with('user_type', 'term', 'plan')->find($user->id);
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

function generate_token($user_id) {
    return $user_id . microtime() . $user_id . mt_getrandmax();
}
