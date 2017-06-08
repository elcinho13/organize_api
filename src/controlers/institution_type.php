<?php

$app->get('/institution_type/:locale', function ($locale){
	try{
		$data = institution_type::query()->where('locale', '=', $locale)->get();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});



$app->get('/institution_type/:locale/:id', function($locale, $id){
	try{
		$data = institution_type::query()->where('locale', '=', $locale)->where('code_enum', '=', $id)->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


$app->post('/institution_type/save', function() use ($app){
	try{
		$institution_type = new institution_type();
 		$institution_type->locale = $app->request()->post('locale');
        $institution_type->code_enum = $app->request()->post('code_enum');
        $institution_type->name = $app->request()->post('name');
        $institution_type->user_last_update = $app->request()->post('user_admin');

        if ($institution_type->save()) {
            $data = institution_type::find($institution_type->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }		

});
