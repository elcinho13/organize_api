<?php

$app->get('/academic_classes', function() {
    try {
        $data = academic_class::with(relations::getAcademicClassRelations())->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/academic_class/:id', function($id) {
    try {
        $data = academic_class::with(relations::getAcademicClassRelations())->find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->parse_error(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/institution/:institution_id/course/:course_id/academic_classes', function($institution_id, $course_id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $academic_classes = academic_class::with(relations::getAcademicClassRelations())
                    ->where('is_active', '=', true)
                    ->get();
            $institution_courses = institution_course::query()
                    ->where('is_active', '=', true)
                    ->where('institution', '=', $institution_id)
                    ->where('course', '=', $course_id)
                    ->get();
            $data = [];
            foreach ($institution_courses as $institution_course) {
                foreach ($academic_classes as $academic_class) {
                    if ($institution_course->id === $academic_class->institution_course) {
                        array_push($data, $academic_class);
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

$app->post('/academic_class/save', function() use($app) {
    try {
        $academic_class = new academic_class();
        $academic_class->institution_course = $app->request()->post('institution_course_id');
        $academic_class->shift = $app->request()->post('shift_id');
        $academic_class->identify = $app->request()->post('identify');
        $academic_class->start_year = $app->request()->post('start_year');
        $academic_class->start_semester = $app->request()->post('start_semester');
        $academic_class->user_last_update = $app->request()->post('user_admin');

        if ($academic_class->save()) {
            $data = academic_class::with(relations::getAcademicClassRelations())->find($academic_class->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/academic_class/:id/active', function ($id) use($app) {
    try {
        $academic_class = academic_class::find($id);
        $academic_class->is_active = $app->request()->post('is_active');
        $academic_class->user_last_update = $app->request()->post('user_admin');

        if ($academic_class->update()) {
            $data = academic_class::with(relations::getAcademicClassRelations())->find($academic_class->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
