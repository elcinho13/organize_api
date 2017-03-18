<?php

$app->post('/plan_price/save', function () use($app) {
    try {
        $plan_price = new plan_price();
        $plan_price->locale = $app->request()->post('locale');
        $plan_price->code_enum = $app->request()->post('code_enum');
        $plan_price->plan = $app->request()->post('plan');
        $plan_price->price = $app->request()->post('price');
        $plan_price->is_active = true;

        if ($plan_price->save()) {
            $data = plan_price::with('plan')->find($plan_price->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/plan_price/:id/active', function ($id) use($app) {
    try {
        $plan_price = plan_price::find($id);
        $plan_price->is_active = $app->request()->post('is_active');

        if ($plan_price->update()) {
            $data = plan_price::with('plan')->find($plan_price->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

