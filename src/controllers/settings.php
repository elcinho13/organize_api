<?php

$app->get('/settings/:locale', function ($locale) {
    try {
        $data = settings::query()->where('locale', '=', $locale)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/settings/:locale/:id', function ($locale, $id) {
    try {
        $settingss = settings::query()->where('locale', '=', $locale)->get();
        foreach ($settingss as $settings) {
            if ($settings->code_enum == $id) {
                $data = $settings;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
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
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
