<?php

$app->get('/user_social_networks/user/:user', function($user_id) {
    try {
        $data = user_social_network::with(relations::getSocialNetworkRelations())
                ->where('user', '=', $user_id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/user_social_network/:id', function($id) {
    try {
        $data = user_social_network::find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});



$app->post('/user_social_network/save', function() use($app) {
    try {
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
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/user_social_network/:id/active', function ($id) use($app) {
    try {
        $user_social_network = user_social_network::find($id);
        $user_social_network->is_active = $app->request()->post('is_active');
        $user_social_network->user_last_update = $app->request()->post('user_admin');

        if ($user_social_network->update()) {
            $data = user_social_network::with(relations::getSocialNetworkRelations())
                    ->find($user_social_network->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

