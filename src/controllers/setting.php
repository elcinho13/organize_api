<?php

$app->get('/settings/:locale', function ($locale) {
    try {
        $data = settings::query()
                ->where('locale', '=', $locale)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/settings/:locale/:id', function ($locale, $id) {
    try {
        $data = settings::query()
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

$app->post('/settings/save', function () use($app) {
    try {
        $settings = new settings();
        $settings->locale = $app->request()->post('locale');
        $settings->code_enum = $app->request()->post('code_enum');
        $settings->name = $app->request()->post('name');
        $settings->description = $app->request()->post('description');
        $settings->check_default = $app->request()->post('check_default');

        if ($settings->save()) {
            $data = settings::find($settings->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
