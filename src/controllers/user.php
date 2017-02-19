<?php

$app->get('/users', function(){
    try{
        $data = user::all();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(0, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/user/:id', function($id){
    try{
        $data = user::find($id);
        if(empty($data)){
            $error = new custonError(3, 0, 'Não foi possível localizar este usuário');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(0, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user/save', function () use ($app){
    try{
        $user = new user();
        $user->full_name = $app->request()->post('full_name');
        $user->mail = $app->request()->post('mail');
        $user->password = application::cryptPassword($app->request()->post('birth_date'), $app->request()->post('password'));
        $user->cpf = $app->request()->post('cpf');
        $user->rg_number = $app->request()->post('rg_number');
        $user->rg_emitter_uf = $app->request()->post('rg_emitter_uf');
        $user->rg_emitter_organ = $app->request()->post('rg_emitter_organ');
        $user->rg_emitter_date = $app->request()->post('rg_emitter_date');
        $user->birth_date = $app->request()->post('birth_date');
        $user->responsible_name = $app->request()->post('responsible_name');
        $user->responsible_cpf = $app->request()->post('responsible_cpf');
        $user->org_term_id = $app->request()->post('term_id');
        $user->term_accept = $app->request()->post('term_accept');
        $user->term_accept_date = $app->request()->post('term_accept_date');
        $user->plan = $app->request()->post('plan');
        
        if($user->save()){
            $data = user::find($user->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user/:id/photo', function ($id){
    try{
        $upload = application::upload_photo($_FILES['profile_picture'], $id);
        if($upload['success']){
            $url = $upload['message'];
            $user = user::find($id);
            if(empty($user)){
                $error = new custonError(3, 0, 'Não foi possível localizar este usuário');
                $data = $error->parse_error();
            }
            $user->profile_picture = $url;
            if($user->update()){
                $data = user::find($user->id);
            }
        }
        else{
            $error = new custonError(5, 1, $upload['message']);
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user/:id', function ($id) use ($app){
    try{
        $user = user::find($id);
        $user->full_name = $app->request()->post('full_name');
        $user->mail = $app->request()->post('mail');
        $user->cpf = $app->request()->post('cpf');
        $user->rg_number = $app->request()->post('rg_number');
        $user->rg_emitter_uf = $app->request()->post('rg_emitter_uf');
        $user->rg_emitter_organ = $app->request()->post('rg_emitter_organ');
        $user->rg_emitter_date = $app->request()->post('rg_emitter_date');
        $user->birth_date = $app->request()->post('birth_date');
        $user->responsible_name = $app->request()->post('responsible_name');
        $user->responsible_cpf = $app->request()->post('responsible_cpf');
        $user->org_term_id = $app->request()->post('term_id');
        $user->term_accept = $app->request()->post('term_accept');
        $user->term_accept_date = $app->request()->post('term_accept_date');
        $user->plan = $app->request()->post('plan');
        
        if($user->update()){
            return helpers::jsonResponse($user);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user/:id/edit_password', function ($id) use ($app){
    try{
        $user = user::find($id);
        $oldPassword = application::cryptPassword($user->birth_date, $app->request()->post('old_password'));
        if($oldPassword !== $user->password){
            $error = new custonError(4, 0, 'Senha atual inválida.');
            $data = $error->parse_error();
        }
        else{
            $user->password = application::cryptPassword($user->birth_date, $app->request()->post('password'));
            if($user->update()){
                $error = new custonError(99, 1, 'Senha alterada com sucesso.');
                $data = $error->parse_error();
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
