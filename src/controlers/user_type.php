<?php

$app->get('/user_types/:locale', function ($locale) {
    try {
        $data = user_type::query()
                ->where('locale', '=', $locale)
                ->where('is_active', '=', true)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/user_type/:locale/:id', function ($locale, $id) {
    try {
        $data = user_type::query()
                ->where('locale', '=', $locale)
                ->where('code_enum', '=', $id)
                ->first();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_type/save', function () use($app) {
    try {
        $user_type = new user_type();
        $user_type->locale = $app->request()->post('locale');
        $user_type->code_enum = $app->request()->post('code_enum');
        $user_type->name = $app->request()->post('name');
        $user_type->user_last_update = $app->request()->post('user_admin');

        if ($user_type->save()) {
            $data = user_type::find($user_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_type/:id/active', function ($id) use($app) {
    try {
        $user_type = user_type::find($id);
        $user_type->is_active = $app->request()->post('is_active');
        $user_type->user_last_update = $app->request()->post('user_admin');

        if ($user_type->update()) {
            $data = user_type::find($user_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
