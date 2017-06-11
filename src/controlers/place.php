<?php

$app->get('/places', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $data = place::query()
                    ->where('is_active', '=', true)
                    ->get();
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/place/:id', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $data = place::find($id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/place/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $place = new place();
            $place->place_id = $app->request()->post('place_id');
            $place->name = $app->request()->post('name');
            $place->icon = $app->request()->post('icon');
            $place->web_site_uri = $app->request()->post('web_site_uri');
            $place->formatted_address = $app->request()->post('formatted_address');
            $place->lat = $app->request()->post('lat');
            $place->long = $app->request()->post('long');
            $place->type = $app->request()->post('type');
            $place->price_level = $app->request()->post('price_level');
            $place->rating = $app->request()->post('rating');
            $place->references = $app->request()->post('references');
            $place->permanently_closed = $app->request()->post('permanently_closed');
            $place->vicinity = $app->request()->post('vicinity');
            $place->user_last_update = $app->request()->post('user_admin');

            if ($place->save()) {
                $data = place::find($place->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/place/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $place = place::find($id);
            $place->is_active = $app->request()->post('is_active');
            $place->user_last_update = $app->request()->post('user_admin');

            if ($place->update()) {
                $data = place::find($place->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/place/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $fields = $app->request()->post();
            $place = place::find($id);

            foreach ($fields as $key => $value) {
                $place->$key = $value;
            }

            if ($place->update()) {
                $data = place::find($place->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
