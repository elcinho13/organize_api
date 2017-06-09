<?php

$app->get('/login_type/:locale', function ($locale) {
    try {
        $data = login_type::query()
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

$app->get('/login_type/:locale/:id', function ($locale, $id) {
    try {
        $data = login_type::query()
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

$app->post('/login_type/save', function () use($app) {
    try {
        $login_type = new login_type();
        $login_type->locale = $app->request()->post('locale');
        $login_type->code_enum = $app->request()->post('code_enum');
        $login_type->name = $app->request()->post('name');
        $login_type->user_last_update = $app->request()->post('user_admin');

        if ($login_type->save()) {
            $data = login_type::find($login_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/login_type/:id/active', function ($id) use($app) {
    try {
        $login_type = login_type::find($id);
        $login_type->is_active = $app->request()->post('is_active');
        $login_type->user_last_update = $app->request()->post('user_admin');

        if ($login_type->update()) {
            $data = login_type::find($login_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
