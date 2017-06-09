<?php 

$app->get('/institution', function() {
	try{
		$data = institution::with(relations::getInstitutionRelations())->get();
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	} catch (Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->get('/institution/:id', function($id){
	try{
		$data = institution::with(relations::getInstitutionRelations())->find($id);
		$error = new custonError(false, 0);
		return helpers::jsonResponse($error->parse_error(), $data);
	}catch (Exception $ex){
		$error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});


$app->post('/institution/save', function() use($app){
	try{
		$institution = new institution();
		$institution->institution_type = $app->request()->post('institution_type');
		$institution->place = $app->request()->post('place');
		$institution->name = $app->request()->post('name');
		$institution->unit = $app->request()->post('unit');

		if($institution->save()){
			$data = institution::with(relations::getInstitutionRelations())->find($institution->id);
			$error = new custonError(false, 0);
			return helpers::jsonResponse($error->parse_error(), $data);
		}
	}catch (Exception $ex){
		$error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
		return helpers::jsonResponse($error->parse_error(), null);
	}
});

	
$app->post('/institution/:id/active', function ($id) use($app) {
    try {
        $institution = institution::find($id);
        $institution->is_active = $app->request()->post('is_active');

        if ($institution->update()) {
            $data = institution::with(relations::getInstitutionRelations())->find($institution->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

