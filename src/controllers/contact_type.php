<?php

$app->get('/contact_type/:locale', function ($locale) {
    try {
        $data = contact_type::query()->where('locale', '=', $locale)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/contact_type/:locale/:id', function ($locale, $id) {
    try {
        $contact_types = contact_type::query()->where('locale', '=', $locale)->get();
        foreach ($contact_types as $contact_type) {
            if ($contact_type->code_enum == $id) {
                $data = $contact_type;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/contact_type/save', function () use($app) {
    try {
        $contact_type = new contact_type();
        $contact_type->locale = $app->request()->post('locale');
        $contact_type->code_enum = $app->request()->post('code_enum');
        $contact_type->name = $app->request()->post('name');

        if ($contact_type->save()) {
            $data = contact_type::find($contact_type->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
