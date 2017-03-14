<?php

$app->get('/settings/user/:id', function($id)
{
	try{
		$data = settings::find($id);
		return helpers::jsonResponse($data);
	}catch (Exception $ex){
		$error = new custonError(3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());
	}
});


$app->get('/settings/user/user/:user', function($user_id)
{

	try{
		$data = settings::query()->where('user', '=', $user_id)->get();
		return helpers::jsonResponse($data);
	}catch (Exception $ex){
		$error = new custonError(3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());
	}

});


$app->post('/settings/user/save', function() use($app)
{
	try{
		$settings = new settings();
		$settings->user = $app->request()->post('user');
		$settings->settings = $app->request()->post('settings');
		$settings->checking = true;
		$settings->value = $app->request()->post('value');

		if($settings->save())
		{
			$data = settings::find($settings->id);
			return helpers::jsonResponse($data);
		}


	}catch(Exception $ex){
		$error = new custonError(2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());

	}
});

$app->post('/settings/user/:id/checking', function($id) use ($app)
{
  try
  {

    $settings = settings::find($id);
    $settings->checking = $app->request()->post('checking');

    if($settings->update())
    {
      $data = settings::with('user')->get()->find($settings->id);
      return helpers::jsonResponse($data);
    }
  
  } catch (Exception $ex){
    $error = new custonError(4, $ex->getCode(), $ex->getMessage());
    return helpers::jsonResponse($error->parse_error());
  }
});


