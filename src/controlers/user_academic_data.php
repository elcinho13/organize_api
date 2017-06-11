<?php

$app->post('/user_academic_data/save', function () use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $user_academic_data = new user_academic_data();
            $user_academic_data->user = $app->request()->post('user_id');
            $user_academic_data->literacy = $app->request()->post('literacy_id');
            $user_academic_data->institution = $app->request()->post('institution');
            $user_academic_data->course = $app->request()->post('course');
            $user_academic_data->class = $app->request()->post('class');
            $user_academic_data->start_date = $app->request()->post('start_date');
            $user_academic_data->final_date = $app->request()->post('final_date');

            if ($user_academic_data->save()) {
                $data = user_academic_data::with(relations::getUserAcademicDataRelations())->find($user_academic_data->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/user_academic_data/:id', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $user_academic_data = user_academic_data::with(relations::getUserAcademicDataRelations())->find($id);
            $fields = $app->request()->post();

            foreach ($fields as $key => $value) {
                $user_academic_data->$key = $value;
            }

            if ($user_academic_data->update()) {
                $data = user_academic_data::with(relations::getUserAcademicDataRelations())->find($user_academic_data->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

