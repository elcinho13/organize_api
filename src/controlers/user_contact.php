<?php

$app->get('/user_contact/user/:user', function($user_id) {
	try{
		$data = user_contact::where('user', '=', $user_id)->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}

});



$app->get('/user_contact/:id', function($id) {

	try{
        $data = user_contact::find($id);
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(),$ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});



$app->post('/user_contact/save', function() use($app){
	try{
		$user_contact = new user_contact();
		$user_contact->contact_type = $app->request()->post('contact_type');
		$user_contact->user = $app->request()->post('user');
		$user_contact->contact = $app->request()->post('contact');
		$user_contact->user_last_update = $app->request()->post('user_admin');

		if($user_contact->save()){
			$data = user_contact::with(relations::getContactRelations())->find($user_contact->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch (Exception $ex) {
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}


});


$app->post('/user_contact/:id/active', function ($id) use($app) {
    try {
        $user_contact = user_contact::find($id);
        $user_contact->is_active = $app->request()->post('is_active');

        if ($user_contact->update()) {
            $data = user_contact::with(relations::getContactRelations())->find($user_contact->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});


