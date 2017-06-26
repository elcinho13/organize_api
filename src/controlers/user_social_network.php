<?php

$app->get('/user_social_networks/user/:user', function($user_id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = user_social_network::with(relations::getSocialNetworkRelations())
                ->where('user', '=', $user_id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/user_social_network/:id', function($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = user_social_network::find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/social_network/:social_network_id/user/:user_id/social_network', function($social_network_type_id) use($app) {
   try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
            $user_social_network = user_social_network::with(relations::getSocialNetworkRelations())
                    ->where('is_active', '=', true)
                    ->get();
            $social_network_type = social_network_type::query()
                    ->where('is_active', '=', true)
                    ->where('id', '=', $social_network_type_id)
                    ->get();
            $data = [];
            foreach ($social_network_type as $social_network_type) {
                foreach ($user_social_network as $user_social_network) {
                    if ($social_network_type->id === $user_social_network->social_network_type) {
                        array_push($data, $user_social_network);
                    }
                }
            }

            if (count($data) > 0) {
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            } else {
                $error = new custonError(true, 1, 0, 'Nenhum dado para ser retornado');
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }    
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});




$app->post('/user_social_network/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $user_social_network = new user_social_network();
        $user_social_network->social_network_type = $app->request()->post('social_network_type');
        $user_social_network->user = $app->request()->post('user');
        $user_social_network->url = $app->request()->post('url');
        $user_social_network->user_last_update = $app->request()->post('user_admin');

        if ($user_social_network->save()) {
            $data = user_social_network::with(relations::getSocialNetworkRelations())
                    ->find($user_social_network->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_social_network/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
            $fields = $app->request()->post();
            $user_social_network = user_social_network::find($id);

            foreach ($fields as $key => $value) {
                $user_social_network->$key = $value;
            }

            if ($user_social_network->update()) {
                $data = user_social_network::with(relations::getSocialNetworkRelations())->find($user_social_network->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/user_social_network/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $user_social_network = user_social_network::find($id);
        $user_social_network->is_active = $app->request()->post('is_active');
        $user_social_network->user_last_update = $app->request()->post('user_admin');

        if ($user_social_network->update()) {
            $data = user_social_network::with(relations::getSocialNetworkRelations())
                    ->find($user_social_network->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

