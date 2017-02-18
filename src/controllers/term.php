<?php

$app->get('/term', function(){
    try{
        $data = term::query()->where('is_active', '=', 1)->first();
        if(empty($data) || is_null($data)){
            $error = new custonError(3, 0, 'Não há nenhum termo disponível');
            $data = $error->parse_error();
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(0, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/term/save', function () use($app){
    try {
        $term = new term();
        $term->locale = $app->request()->post('locale');
        $term->version_name = $app->request()->post('version_name');
        $term->title = $app->request()->post('title');
        $term->content = $app->request()->post('content');
        $term->publication_date = $app->request()->post('publication_date');
        $term->is_active = 1;
        
        if($term->save()){
            $data = term::find($term->id);
            return helpers::jsonResponse($data);
        }
        
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/term/:id', function ($id) use($app){
    try{
        $term = term::find($id);
        $term->locale = $app->request()->post('locale');
        $term->version_name = $app->request()->post('version_name');
        $term->title = $app->request()->post('title');
        $term->content = $app->request()->post('content');
        $term->publication_date = $app->request()->post('publication_date');
        $term->is_active = $app->request()->post('is_active');

        if($term->update()){
            return helpers::jsonResponse($term);
        } 
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
