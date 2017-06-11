<?php

$app->post('/institution_course/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $institution_course = new institution_course();
            $institution_course->institution = $app->request()->post('institution_id');
            $institution_course->course = $app->request()->post('course_id');
            $institution_course->duration = $app->request()->post('duration');
            $institution_course->user_last_update = $app->request()->post('user_admin');

            if ($institution_course->save()) {
                $data = institution_course::with(relations::getInstitutionCourseRelations())->find($institution_course->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/institution_course/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $institution_course = institution_course::find($id);
            $institution_course->is_active = $app->request()->post('is_active');
            $institution_course->user_last_update = $app->request()->post('user_admin');

            if ($institution_course->update()) {
                $data = institution_course::with(relations::getInstitutionCourseRelations())->find($institution_course->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

