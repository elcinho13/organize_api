<?php
$app->post('/token/save', function () use($app){
    try{
        $token = new token();
        $token->org_first_access_id = $app->request()->post('first_access_id');
        

        if($token->save()){
            return helpers::jsonResponse($token);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/token/:id', function ($id) use($app){
    try{
        $token = token::find($id);
        $token->org_user_id = $app->request()->post('user_id');
        $token->login_type = $app->request()->post('login_type');
        $token->access_token = generate_token($app->request()->post('user_id'));
        $token->access_platform = $app->request()->post('access_platform');
        $token->access_date = $app->request()->post('access_date');
        $token->keep_logged = $app->request()->post('keep_logged');
        
        if($token->update()){
            return helpers::jsonResponse($token);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/token/:first_access_id', function ($first_access_id){
    try{
        $data = token::query()->where('org_first_access_id', '=', $first_access_id)->first();
        if(empty($data) || is_null($data)){
            $error = new custonError(3, 0, 'Nenhum dado encontrado');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/login', function () use($app){
    try{
        $user = user::query()->where('mail', '=', $app->request()->post('mail'))->first();
        if($user->password == application::cryptPassword($user->birth_date, $app->request()->post('password'))){
            $data = $user;
        }
        else{
            $error = new custonError(5, 0, 'Usuário ou senha inválidos.');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(5, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

function generate_token($user_id){
    return $user_id . microtime() . $user_id. mt_getrandmax();
}
   