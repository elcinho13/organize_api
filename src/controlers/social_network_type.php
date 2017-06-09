<?php

$app->get('/social_network_type/:locale', function($locale){
	try {
		$data = social_network_type::query()->where('locale', '=', $locale)->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2 , $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->get('/social_network_type/:locale/:id', function ($locale, $id){
	try{
		$data = social_network_type::query()->where('locale','=',$locale)->where('code_enum','=',$id)->get();
		$error = new custonError(false,0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch(Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->post('/social_network_type/save', function() use($app){
	try{
		$social_network_type = new social_network_type();
		$social_network_type->locale = $app->request()->post('locale');
		$social_network_type->code_enum = $app->request()->post('code_enum');
		$social_network_type->name = $app->request->post('name');

		if($social_network_type->save()){
			$data = social_network_type::find($social_network_type->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch (Exception $ex) {
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(),null);
	}
});


$app->post('/social_network_type/:id/active', function ($id) use($app) {
    try {
        $social_network_type = social_network_type::find($id);
        $social_network_type->is_active = $app->request()->post('is_active');

        if ($social_network_type->update()) {
            $data = social_network_type::find($social_network_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

