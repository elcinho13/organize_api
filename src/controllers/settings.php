<?php

$app->get('/settings/user', function()
{
	try{
		$data = settings::with('user')->get();
		return helpers::jsonResponse($data);
	}catch (Exception $ex){
		$error = new custonError(0, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());
	}
});

$app->get('/settings/:id', function($id)
{
	try{
		$data = settings::with('user')->get()->find($id);
		return helpers::jsonResponse($data);
	}catch (Exception $ex){
		$error = new custonError(3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());
	}
});


$app->get('/settings/user/id', function($user)
{

	try{
		$data = settings::with('user')->get()->find($id);
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
		$settings->checking = $app->request()->post('checking');
		$settings->value = $app->request()->post('value');

		if($settings->save())
		{
			$data = setting::with('user')->get()->find($settings->id);
			return helpers::jsonResponse($data);
		}


	}catch(Exception $ex){
		$error = new custonError(2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error());

	}
});

$app->patch('/settings/:id/checking', function($id) use ($app)
{
  try
  {

    $settings = settings::find($id);
    $settings->checking = $app->request()->params('checking');

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


