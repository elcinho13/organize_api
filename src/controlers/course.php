<?php

$app->get('/courses/:locale', function ($locale) {
    try {
        $data = course::query()->where('locale', '=', $locale)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/institution/:id/courses', function($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $courses = course::query()
                    ->where('is_active', '=', true)
                    ->get();
            $institution_courses = institution_course::query()
                    ->where('is_active', '=', true)
                    ->where('institution', '=', $id)
                    ->get();
            $data = [];
            foreach ($institution_courses as $institution_course) {
                foreach ($courses as $course) {
                    if ($institution_course->course === $course->id) {
                        array_push($data, $course);
                    }
                }
            }

            if (count($data) > 0) {
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            } else {
                $error = new custonError(true, 1, 0, 'Nenhum dado para ser retornado');
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/course/:locale/:id', function ($locale, $id) {
    try {
        $data = course::query()->where('locale', '=', $locale)->where('code_enum', '=', $id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/course/save', function() use($app) {
    try {
        $course = new course();
        $course->locale = $app->request()->post('locale');
        $course->code_enum = $app->request()->post('code_enum');
        $course->name = $app->request()->post('name');
        $course->user_last_update = $app->request()->post('user_admin');

        if ($course->save()) {
            $data = course::find($course->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/course/:id/active', function ($id) use($app) {
    try {
        $course = course::find($id);
        $course->is_active = $app->request()->post('is_active');
        $course->user_last_update = $app->request()->post('user_admin');

        if ($course->update()) {
            $data = course::find($course->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
