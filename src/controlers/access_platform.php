<?php

$app->get('/access_platform/:locale', function ($locale) {
    try {
        $data = access_platform::query()
                ->where('locale', '=', $locale)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/access_platform/:locale/:id', function ($locale, $id) {
    try {
        $data = access_platform::query()
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



$app->post('/access_platform/save', function () use($app) {
    try {
        $access_platform = new access_platform();
        $access_platform->locale = $app->request()->post('locale');
        $access_platform->code_enum = $app->request()->post('code_enum');
        $access_platform->name = $app->request()->post('name');
        $access_platform->user_last_update = $app->request()->post('user_admin');

        if ($access_platform->save()) {
            $data = access_platform::find($access_platform->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
