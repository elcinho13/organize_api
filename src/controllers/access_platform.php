<?php

$app->get('/access_platform/:locale', function ($locale) {
    try {
        $data = access_platform::query()->where('locale', '=', $locale)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/access_platform/:locale/:id', function ($locale, $id) {
    try {
        $access_platforms = access_platform::query()->where('locale', '=', $locale)->get();
        foreach ($access_platforms as $access_platform) {
            if ($access_platform->code_enum == $id) {
                $data = $access_platform;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});



$app->post('/access_platform/save', function () use($app) {
    try {
        $access_platform = new access_platform();
        $access_platform->locale = $app->request()->post('locale');
        $access_platform->code_enum = $app->request()->post('code_enum');
        $access_platform->name = $app->request()->post('name');

        if ($access_platform->save()) {
            $data = access_platform::find($access_platform->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
