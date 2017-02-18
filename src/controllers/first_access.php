<?php

$app->get('/first_access/:device_id', function ($device_id){
    try{
        $data = firstAccess::query()->where('device_id', '=', $device_id)->first();
        if(empty($data)){
            $error = new custonError(5, 0, 'Erro ao carregar os dados.');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/first_access/save', function () use($app){
    try{
        $first_access = new firstAccess();
        $first_access->device_id = $app->request()->post('device_id');
        $first_access->instalation_date = $app->request()->post('instalation_date');
        $first_access->locale = $app->request()->post('locale');
        
        if($first_access->save()){
            $data = firstAccess::find($first_access->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
