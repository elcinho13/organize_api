<?php

$app->get('/classes', function(){
	try{
		$data = classes::with(relations::getClassesRelations())->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch(Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});

$app->get('/classes/:id', function($id){
	try{
		$data = classes::with(relations::getClassesRelations())->find($id);
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2, $ex->parse_error(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});

$app->post('/classes/save', function() use($app){
	try{
		$classes = new classes();
		$classes->institution = $app->request()->post('institution');
		$classes->course = $app->request()->post('course');
		$classes->shift = $app->request()->post('shift');
		$classes->identify = $app->request()->post('identify');
		$classes->start_year = $app->request()->post('start_year');
		$classes->start_semester = $app->request()->post('start_semester');

		if($classes->save()){
			$data = classes::with(relations::getClassesRelations())->find($classes->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch(Exception $ex){
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}


});


$app->post('/classes/:id/active', function ($id) use($app) {
    try {
        $classes = classes::find($id);
        $classes->is_active = $app->request()->post('is_active');

        if ($classes->update()) {
            $data = classes::with(relations::getClassesRelations())->find($classes->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
