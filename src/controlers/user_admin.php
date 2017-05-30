<?php

$app->get('/users_admin', function() {
    try {
        $data = user_admin::all();
        $error = new custonError(false, 0);
        helpers::jsonResponse($error, $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/user_admin/:id', function($id) {
    try {
        $data = user_admin::find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_admin/mail', function () use ($app) {
    try {
        $data = user_admin::where('mail', '=', $app->request()->post('mail'))->first();
        if(!is_null($data)){
            $error = new custonError(false, 0);
        }
        else{
            $error = new custonError(true, 2, 2, 'Nenhum usuário encontrado.');
        }
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_admin/save', function () use($app) {
    try {
        $user_admin = new user_admin();
        $user_admin->name = $app->request()->post('name');
        $user_admin->cpf = $app->request()->post('cpf');
        $user_admin->birth_date = $app->request()->post('birth_date');
        $user_admin->phone = $app->request()->post('phone');
        $user_admin->mail = $app->request()->post('mail');
        $user_admin->password = application::cryptPassword($app->request()->post('birth_date'), $app->request()->post('password'));

        if ($user_admin->save()) {
            $data = user_admin::find($user_admin->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

/*
 * caminho local: http://localhost/_uploads/organize/
 * caminho server: http://ec2-52-67-67-126.sa-east-1.compute.amazonaws.com/organize/upload/
 * 
 * pasta local: /home/marcelamelo/Documentos/Projetos/_uploads/organize/
 * pasta server: /var/www/html/organize/upload/
 */

$app->post('/user_admin/:id/photo', function ($id) {
    try {
        $way = 'http://ec2-52-67-67-126.sa-east-1.compute.amazonaws.com/organize/upload/';
        $folder = '/var/www/html/organize/upload/';
        $size = (1024 * 1024) + 1;
        $file_name = str_replace(array(' ', '.'), '', 'photo_' . $id . '_' . microtime());
        if (empty($_FILES)) {
            $error = new custonError(true, 1, 1, 'Nenhum arquivo enviado');
        } else if (!empty($_FILES['photo']) && $_FILES['photo']['error'] !== 4) {
            if ($_FILES['photo']['size'] < $size) {
                $tmp_name = $_FILES['photo']['name'];
                $tmp_extension = explode('.', $tmp_name);
                $extension = end($tmp_extension);
                $file_name .= '.' . $extension;

                if (move_uploaded_file($_FILES['photo']['tmp_name'], $folder . $file_name)) {
                    $user = user_admin::find($id);
                    $user->profile_picture = $way . $file_name;
                    if ($user->update()) {
                        $error = new custonError(false, 0, 0, 'Upload do arquivo realizado com sucesso.');
                    } else {
                        $error = new custonError(true, 4, 1, 'Não foi possível alterar o usuário.');
                    }
                } else {
                    $error = new custonError(true, 1, 1, 'Ocorreu um erro ao processar o arquivo. O Arquivo não foi salvo.');
                }
            } else {
                $error = new custonError(true, 1, 1, 'O tamanho do arquivo excede o permitido. Permido arquivos de até 1MB.');
            }
        } else {
            $error = new custonError(true, 1, $_FILES['photo']['error'], 'Nenhum arquivo foi enviado.');
        }
        return helpers::jsonResponse($error->parse_error(), null);
    } catch (Exception $ex) {
        $error = new custonError(true, 6, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_admin/:id', function ($id) use ($app) {
    try {
        $fields = $app->request()->post();
        $user = user_admin::find($id);

        foreach ($fields as $key => $value) {
            $user->$key = $value;
        }

        if ($user->update()) {
            $data = user_admin::find($user->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_admin/:id/edit_password', function ($id) use ($app) {
    try {
        $user = user_admin::find($id);
        $oldPassword = application::cryptPassword($user->birth_date, $app->request()->post('old_password'));
        if ($oldPassword !== $user->password) {
            $error = new custonError(true, 4, 0, 'Senha atual inválida.');
            $data = $error->parse_error();
        } else {
            $user->password = application::cryptPassword($user->birth_date, $app->request()->post('password'));
            if ($user->update()) {
                $error = new custonError(false, 99, 1, 'Senha alterada com sucesso.');
                $data = $error->parse_error();
            }
        }
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

