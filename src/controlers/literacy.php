<?php

$app->get('/literacies/:locale', function($locale) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = literacy::query()->where('locale', '=', $locale)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/literacy/:locale/:id', function ($locale, $id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = literacy::query()->where('locale', '=', $locale)->where('code_enum', '=', $id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/literacy/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $literacy = new literacy();
        $literacy->locale = $app->request()->post('locale');
        $literacy->locale = $app->request()->post('locale');
        $literacy->code_enum = $app->request()->post('code_enum');
        $literacy->name = $app->request->post('name');
        $literacy->user_last_update = $app->request()->post('user_admin');

        if ($literacy->save()) {
            $data = literacy::find($literacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/literacy/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $fields = $app->request()->post();
            $literacy = literacy::find($id);

            foreach ($fields as $key => $value) {
                $literacy->$key = $value;
            }

            if ($literacy->update()) {
                $data = literacy::find($literacy->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/literacy/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $literacy = literacy::find($id);
        $literacy->is_active = $app->request()->post('is_active');
        $literacy->user_last_update = $app->request()->post('user_admin');

        if ($literacy->update()) {
            $data = literacy::find($literacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

