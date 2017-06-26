<?php

$app->get('/user_contacts/user/:user', function($user_id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = user_contact::where('user', '=', $user_id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});



$app->get('/user_contact/:id', function($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = user_contact::find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});



$app->post('/user_contact/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $user_contact = new user_contact();
        $user_contact->contact_type = $app->request()->post('contact_type');
        $user_contact->user = $app->request()->post('user');
        $user_contact->contact = $app->request()->post('contact');
        $user_contact->user_last_update = $app->request()->post('user_admin');

        if ($user_contact->save()) {
            $data = user_contact::with(relations::getContactRelations())->find($user_contact->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_contact/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $fields = $app->request()->post();
            $user_contact = user_contact::find($id);

            foreach ($fields as $key => $value) {
                $user_contact->$key = $value;
            }

            if ($user_contact->update()) {
                $data = user_contact::with(relations::getContactRelations())->find($user_contact->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_contact/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $user_contact = user_contact::find($id);
        $user_contact->is_active = $app->request()->post('is_active');
        $user_contact->user_last_update = $app->request()->post('user_admin');

        if ($user_contact->update()) {
            $data = user_contact::with(relations::getContactRelations())->find($user_contact->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


