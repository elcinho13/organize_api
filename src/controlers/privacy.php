<?php

$app->get('/privacy/:locale', function ($locale) {
    try {
        $data = privacy::query()
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

$app->get('/privacy/:locale/:id', function ($locale, $id) {
    try {
        $data = privacy::query()
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

$app->post('/privacy/save', function () use($app) {
    try {
        $privacy = new privacy();
        $privacy->locale = $app->request()->post('locale');
        $privacy->code_enum = $app->request()->post('code_enum');
        $privacy->name = $app->request()->post('name');
        $privacy->description = $app->request()->post('description');
        $privacy->check_default = $app->request()->post('check_default');
        $privacy->user_last_update = $app->request()->post('user_admin');

        if ($privacy->save()) {
            $data = privacy::find($privacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/privacy/:id/active', function ($id) use($app) {
    try {
        $privacy = privacy::find($id);
        $privacy->is_active = $app->request()->post('is_active');
        $privacy->user_last_update = $app->request()->post('user_admin');

        if ($privacy->update()) {
            $data = privacy::find($privacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

