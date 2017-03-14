<?php

$app->get('/plan_advantages/:locale', function ($locale) {
    try {
        $plan_advantages = plan_advantages::with('plan')->get();
        foreach ($plan_advantages as $advantage){
            if($advantage->locale == $locale){
                $data[] = $advantage;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/plan_advantages/:locale/:id', function ($locale, $id) {
    try {
        $plan_advantages = plan_advantages::with('plan')->get();
        foreach ($plan_advantages as $advantage) {
            if ($advantage->code_enum == $id && $advantage->locale == $locale) {
                $data = $advantage;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/plan_advantages/save', function () use($app) {
    try {
        $plan_advantages = new plan_advantages();
        $plan_advantages->locale = $app->request()->post('locale');
        $plan_advantages->code_enum = $app->request()->post('code_enum');
        $plan_advantages->plan = $app->request()->post('plan');
        $plan_advantages->advantage = $app->request()->post('advantage');

        if ($plan_advantages->save()) {
            $data = plan_advantages::with('plan')->find($plan_advantages->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/plan_advantages/:id/edit', function ($id) use($app) {
    try {
        $plan_advantages = plan_advantages::find($id);
        $plan_advantages->locale = $app->request()->post('locale');
        $plan_advantages->code_enum = $app->request()->post('code_enum');
        $plan_advantages->plan = $app->request()->post('plan');
        $plan_advantages->advantage = $app->request()->post('advantage');

        if ($plan_advantages->update()) {
            $data = plan_advantages::with('plan')->find($plan_advantages->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

