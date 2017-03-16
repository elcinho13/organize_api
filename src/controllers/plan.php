<?php

$app->get('/plan/:locale', function ($locale) {
    try {
        $data = plan::with('advantages', 'price')
                ->where('locale', '=', $locale)
                ->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/plan/:locale/:id', function ($locale, $id) {
    try {
        $data = plan::with('advantages', 'price')
                ->where('locale', '=', $locale)
                ->where('code_enum', '=', $id)
                ->first();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
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
            $data = plan::with('advantages', 'price')->find($plan->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/plan/:id/active', function ($id) use($app) {
    try {
        $plan = plan::find($id);
        $plan->is_active = $app->request()->post('is_active');

        if ($plan->update()) {
            $data = plan::with('advantages', 'price')->find($plan->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
