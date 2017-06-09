<?php

$app->get('/setting/:locale', function ($locale) {
    try {
        $data = setting::query()
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

$app->get('/setting/:locale/:id', function ($locale, $id) {
    try {
        $data = setting::query()
                ->where('locale', '=', $locale)
                ->where('code_enum', '=', $id)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/setting/save', function () use($app) {
    try {
        $setting = new setting();
        $setting->locale = $app->request()->post('locale');
        $setting->code_enum = $app->request()->post('code_enum');
        $setting->name = $app->request()->post('name');
        $setting->description = $app->request()->post('description');
        $setting->check_default = $app->request()->post('check_default');
        $setting->user_last_update = $app->request()->post('user_admin');

        if ($setting->save()) {
            $data = setting::find($setting->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/setting/:id/active', function ($id) use($app) {
    try {
        $setting = setting::find($id);
        $setting->is_active = $app->request()->post('is_active');
        $setting->user_last_update = $app->request()->post('user_admin');

        if ($setting->update()) {
            $data = setting::find($setting->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
