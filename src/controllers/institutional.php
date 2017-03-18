<?php

$app->get('/institutional/:locale', function ($locale) {
    try {
        $data = institutional::query()
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

$app->post('/institutional/save', function () use($app) {
    try {
        $institutional = new institutional();
        $institutional->locale = $app->request()->post('locale');
        $institutional->code_enum = $app->request()->post('code_enum');
        $institutional->site_url = $app->request()->post('site_url');
        $institutional->description = $app->request()->post('description');
        $institutional->mission = $app->request()->post('mission');
        $institutional->vision = $app->request()->post('vision');
        $institutional->values = $app->request()->post('values');
        $institutional->is_active = true;

        if ($institutional->save()) {
            $data = institutional::find($institutional->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/institutional/:id/edit', function ($id) use($app) {
    try {
        $institutional = institutional::find($id);
        $institutional->locale = $app->request()->post('locale');
        $institutional->code_enum = $app->request()->post('code_enum');
        $institutional->site_url = $app->request()->post('site_url');
        $institutional->description = $app->request()->post('description');
        $institutional->mission = $app->request()->post('mission');
        $institutional->vision = $app->request()->post('vision');
        $institutional->values = $app->request()->post('values');
        $institutional->is_active = $app->request()->post('is_active');

        if ($institutional->update()) {
            $data = institutional::find($institutional->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/institutional/:id/active', function ($id) use($app) {
    try {
        $institutional = institutional::find($id);
        $institutional->is_active = $app->request()->post('is_active');

        if ($institutional->update()) {
            $data = institutional::find($institutional->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
