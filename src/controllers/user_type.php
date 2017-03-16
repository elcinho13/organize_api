<?php

$app->get('/user_type/:locale', function ($locale) {
    try {
        $data = user_type::query()->where('locale', '=', $locale)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/user_type/:locale/:id', function ($locale, $id) {
    try {
        $data = user_type::query()
                ->where('locale', '=', $locale)
                ->where('code_enum', '=', $id)
                ->first();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/user_type/save', function () use($app) {
    try {
        $user_type = new user_type();
        $user_type->locale = $app->request()->post('locale');
        $user_type->code_enum = $app->request()->post('code_enum');
        $user_type->name = $app->request()->post('name');

        if ($user_type->save()) {
            $data = user_type::find($user_type->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
