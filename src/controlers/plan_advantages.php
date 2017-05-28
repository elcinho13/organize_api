<?php

$app->post('/plan_advantages/save', function () use($app) {
    try {
        $plan_advantages = new plan_advantages();
        $plan_advantages->locale = $app->request()->post('locale');
        $plan_advantages->code_enum = $app->request()->post('code_enum');
        $plan_advantages->plan = $app->request()->post('plan_id');
        $plan_advantages->advantage = $app->request()->post('advantage');
        $plan_advantages->user_last_update = $app->request()->post('user_admin');

        if ($plan_advantages->save()) {
            $data = plan::with(relations::getPlanRelations())->find($app->request()->post('plan_id'));
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/plan_advantages/:id/edit', function ($id) use($app) {
    try {
        $fields = $app->request()->post();
        $plan_advantages = plan_advantages::find($id);
        
        foreach ($fields as $key => $value){
            $plan_advantages->$key = $value;
        }

        if ($plan_advantages->update()) {
            $data = plan::with(relations::getPlanRelations())->find($app->request()->post('plan_id'));;
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

