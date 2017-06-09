<?php

$app->get('/literacy/:locale', function($locale){
	try {
		$data = literacy::query()->where('locale', '=', $locale)->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2 , $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->get('/literacy/:locale/:id', function ($locale, $id){
	try{
		$data = literacy::query()->where('locale','=',$locale)->where('code_enum','=',$id)->get();
		$error = new custonError(false,0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch(Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->post('/literacy/save', function() use($app){
	try{
		$literacy = new literacy();
		$literacy->locale = $app->request()->post('locale');
		$literacy->locale = $app->request()->post('locale');
		$literacy->code_enum = $app->request()->post('code_enum');
		$literacy->name = $app->request->post('name');

		if($literacy->save()){
			$data = literacy::find($literacy->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch (Exception $ex) {
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(),null);
	}
});


$app->post('/literacy/:id/active', function ($id) use($app) {
    try {
        $literacy = literacy::find($id);
        $literacy->is_active = $app->request()->post('is_active');

        if ($literacy->update()) {
            $data = literacy::find($literacy->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

