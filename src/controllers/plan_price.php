<?php

$app->get('/price/:planId', function ($planId){
    try{
        $data = planPrice::query()->where('plan', '=', $planId)->first();
        if(empty($data) || is_null($data) || $data->is_active != 1){
            $error = new custonError(3, 0, 'Não há preço disponível para este plano');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(0, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
