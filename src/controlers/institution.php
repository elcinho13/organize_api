<?php

$app->get('/institutions', function() use ($app){
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = institution::with(relations::getInstitutionRelations())->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    }catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->get('/institution/:id', function($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $data = institution::with(relations::getInstitutionRelations())->find($id);
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->get('/institution/:institution_id/institution_type/:institution_type/institution', function($institution_type_id) use($app) {
   try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
           $institution = institution::with(relations::getInstitutionRelations())
                    ->where('is_active', '=', true)
                    ->get();
            $institution_type = institution_type::query()
                    ->where('is_active', '=', true)
                    ->where('id', '=', $institution_type_id)
                    ->get();
            $data = [];
            foreach ($institution_type as $institution_type) {
                foreach ($institution as $institution) {
                    if ($institution_type->id === $institution->institution_type) {
                        array_push($data, $institution);
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
    
$app->post('/institution/save', function() use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
          $error = new custonError(true, 8, 401);
          return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $institution = new institution();
        $institution->institution_type = $app->request()->post('institution_type');
        $institution->place = $app->request()->post('place');
        $institution->name = $app->request()->post('name');
        $institution->unit = $app->request()->post('unit');
        $institution->user_last_update = $app->request()->post('user_admin');

        if ($institution->save()) {
            $data = institution::with(relations::getInstitutionRelations())->find($institution->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/institution/:id', function ($id) use ($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
            $error = new custonError(true, 8, 401);
            return helpers::jsonResponse($error->parse_error(), null);
        } else {
            $fields = $app->request()->post();
            $institution = institution::find($id);

            foreach ($fields as $key => $value) {
                $institution->$key = $value;
            }

            if ($institution->update()) {
                $data = institution::with(relations::getInstitutionRelations())->find($institution->id);
                $error = new custonError(false, 0);
                return helpers::jsonResponse($error->parse_error(), $data);
            }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/institution/:id/active', function ($id) use($app) {
    try {
        if (!helpers::authenticate($app->request()->params('token'))) {
         $error = new custonError(true, 8, 401);
         return helpers::jsonResponse($error->parse_error(), null);
        }else{
        $institution = institution::find($id);
        $institution->is_active = $app->request()->post('is_active');
        $institution->user_last_update = $app->request()->post('user_admin');

        if ($institution->update()) {
            $data = institution::with(relations::getInstitutionRelations())->find($institution->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

