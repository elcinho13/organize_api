<?php

$app->get('/contact/:locale', function ($locale) {
    try {
        $contacts = contact::with(relations::getContactRelations())->get();
        foreach ($contacts as $contact) {
            if ($contact->locale == $locale) {
                $data[] = $contact;
            }
        }
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/contact/:locale/:id', function ($locale, $id) {
    try {
        $data = contact::with(relations::getContactRelations())
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



$app->post('/contact/save', function () use($app) {
    try {
        $contact = new contact();
        $contact->locale = $app->request()->post('locale');
        $contact->code_enum = $app->request()->post('code_enum');
        $contact->description = $app->request()->post('description');
        $contact->contact_type = $app->request()->post('contact_type');
        $contact->contact = $app->request()->post('contact');
        $contact->user_last_update = $app->request()->post('user_admin');

        if ($contact->save()) {
            $data = contact::with(relations::getContactRelations())->find($contact->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/contact/:id/active', function ($id) use($app) {
    try {
        $contact = contact::find($id);
        $contact->is_active = $app->request()->post('is_active');

        if ($contact->update()) {
            $data = contact::with(relations::getContactRelations())->find($contact->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
