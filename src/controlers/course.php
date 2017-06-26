<?php

$app->get('/courses/:locale', function ($locale) use ($app){
    try {
         if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = course::query()->where('locale', '=', $locale)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    }catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/course/:locale/:id', function ($locale, $id) use ($app){
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = course::query()->where('locale', '=', $locale)->where('code_enum', '=', $id)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/course/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
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
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/course/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $fields = $app->request()->post();
            $course = course::find($id);

            foreach ($fields as $key => $value) {
                $course->$key = $value;
            }

            if ($course->update()) {
                $data = course::find($course->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/course/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $course = course::find($id);
        $course->is_active = $app->request()->post('is_active');
        $course->user_last_update = $app->request()->post('user_admin');

        if ($course->update()) {
            $data = course::find($course->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
