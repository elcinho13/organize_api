<?php

$app->get('/contact/:locale', function ($locale) {
    try {
        $contacts = contact::with('contact_type')->get();
        foreach ($contacts as $contact) {
            if ($contact->locale == $locale) {
                $data[] = $contact;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/contact/:locale/:id', function ($locale, $id) {
    try {
        $contacts = contact::with('contact_type')->get();
        foreach ($contacts as $contact) {
            if ($contact->code_enum == $id && $contact->locale == $locale) {
                $data = $contact;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
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
        $contact->is_active = true;

        if ($contact->save()) {
            $data = contact::with('contact_type')->find($contact->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/contact/:id/edit', function ($id) use($app) {
    try {
        $contact = contact::find($id);
        $contact->locale = $app->request()->post('locale');
        $contact->code_enum = $app->request()->post('code_enum');
        $contact->description = $app->request()->post('description');
        $contact->contact_type = $app->request()->post('contact_type');
        $contact->contact = $app->request()->post('contact');
        $contact->is_active = $app->request()->post('is_active');

        if ($contact->update()) {
            $data = contact::with('contact_type')->find($contact->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/contact/:id/active', function ($id) use($app) {
    try {
        $contact = contact::find($id);
        $contact->is_active = $app->request()->post('is_active');

        if ($contact->update()) {
            $data = contact::with('contact_type')->find($contact->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
