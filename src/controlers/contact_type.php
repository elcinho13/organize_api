<?php

$app->get('/contact_type/:locale', function ($locale) {
    try {
        $data = contact_type::query()
                ->where('locale', '=', $locale)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/contact_type/:locale/:id', function ($locale, $id) {
    try {
        $data = contact_type::query()
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

$app->post('/contact_type/save', function () use($app) {
    try {
        $contact_type = new contact_type();
        $contact_type->locale = $app->request()->post('locale');
        $contact_type->code_enum = $app->request()->post('code_enum');
        $contact_type->name = $app->request()->post('name');
        $contact_type->user_last_update = $app->request()->post('user_admin');

        if ($contact_type->save()) {
            $data = contact_type::find($contact_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
