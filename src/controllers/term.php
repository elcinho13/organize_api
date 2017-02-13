<?php

$app->get('/term', function(){
    try{
        $data = term::query()->where('is_active', '=', 'Y')->first();
        if(empty($data)){
            $error = new custonError(5, 0, 'Não há nenhum termo disponível');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(0, $ex->getCode(), $ex->getMessage());
        $data = $error->parse_error();
        return helpers::jsonResponse($data);
    }
});

$app->post('/term/save', function () use($app){
    try {
        $term = new term();
        $term->version_name = $app->request()->post('version_name');
        $term->title = $app->request()->post('title');
        $term->content = $app->request()->post('content');
        $term->publiction_date = $app->request()->post('publication_date');
        $term->is_active = $app->request()->post('Y');
        
        if($term->save()){
            $data = term::find($term->id);
            return helpers::jsonResponse($data);
        }
        
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        $data = $error->parse_error();
        return helpers::jsonResponse($data);
    }
});
