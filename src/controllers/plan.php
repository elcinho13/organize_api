<?php

$app->get('/plan/:locale', function ($locale) {
    try {
        $data = plan::with('price', 'advantages')
                ->where('locale', '=', $locale)
                ->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/plan/:locale/:id', function ($locale, $id) {
    try {
        $data = plan::with('price', 'advantages')
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

$app->post('/plan/save', function () use($app) {
    try {
        $plan = new plan();
        $plan->locale = $app->request()->post('locale');
        $plan->code_enum = $app->request()->post('code_enum');
        $plan->name = $app->request()->post('name');
        $plan->description = $app->request()->post('description');
        $plan->security_code = application::generate_code(10, 'plan');
        $plan->is_active = true;

        if ($plan->save()) {
            $data = plan::with('price', 'advantages')->find($plan->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/plan/:id/active', function ($id) use($app) {
    try {
        $plan = plan::find($id);
        $plan->is_active = $app->request()->post('is_active');

        if ($plan->update()) {
            $data = plan::with('price', 'advantages')->find($plan->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
