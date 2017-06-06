<?php

$app->get('/course/:locale', function ($locale){
	try {
		$data = course::with(relations::getCourseRelations())
			->where('locale', '=', $locale)
			->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2 , $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}

});

$app->get('/course/:locale/:id', function ($locale, $id){
	try{
		$data = course::with(relations::getCourseRelations())
			->where('locale', '=', $locale)
            ->where('code_enum', '=', $id)
            ->first();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), null);	
	}catch (Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});

$app->post('/course/save', function() use($app){
	try{
		$course = new course();
		$course->locale = $app->request()->post('locale');
		$course->code_enum = $app->request()->post('code_enum');
		$course->name = $app->request->post('name');
		$course->user_last_update = $app->request()->post('user_admin');

		if($course->save()){
			$data = plan::with(relations::getCourseRelations())->find($course->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error, $data);
		}
	}catch (Exception $ex) {
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(),null);
	}

});

$app->post('/course/:id/active', function ($id) use($app){
	try{
		$course = course::find($id);
		$plan->is_active = $app->request()->post('is_active');

		if($plan->update()) {
			$data = course::with(relations::getCourseRelations())->find($course->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), null);
		}
	}catch (Exception $ex){
			$error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
			return helpers::jsonResponse($error->parse_error(), null);
		}
});
