<?php

$app->get('/shift/:locale', function($locale){
	try {
		$data = shift::query()->where('locale', '=', $locale)->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2 , $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->get('/shift/:locale/:id', function ($locale, $id){
	try{
		$data = shift::query()->where('locale','=',$locale)->where('code_enum','=',$id)->get();
		$error = new custonError(false,0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch(Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->post('/shift/save', function() use($app){
	try{
		$shift = new shift();
		$shift->locale = $app->request()->post('locale');
		$shift->locale = $app->request()->post('locale');
		$shift->code_enum = $app->request()->post('code_enum');
		$shift->name = $app->request->post('name');

		if($shift->save()){
			$data = shift::find($shift->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch (Exception $ex) {
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(),null);
	}
});

$app->post('/shift/:id/user_last_update', function ($id) use($app){
	try{
		$shift = shift::find($id);
		$shift->user_last_update = $app->request()->post('user_admin');	

		if ($shift->update()) {
            $data = shift::find($shift->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/shift/:id/active', function ($id) use($app){
	try{
		$shift = shift::find($id);
		$shift->is_active = $app->request()->post('is_active');	

		if ($shift->update()) {
            $data = shift::find($shift->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

