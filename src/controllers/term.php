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
        $term->publication_date = $app->request()->post('publication_date');
        $term->is_active = 'Y';
        
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

$app->put('/term/:id', function ($id) use($app){
    try{
        $term = term::find($id);
        $term->version_name = $app->request()->params('version_name');
        $term->title = $app->request()->params('title');
        $term->content = $app->request()->params('content');
        $term->publication_date = $app->request()->params('publication_date');
        $term->is_active = $app->request()->params('is_active');

        if($term->update()){
            return helpers::jsonResponse($term);
        } 
    } catch (Exception $ex) {
        $error = new custonError(4, $ex->getCode(), $ex->getMessage());
        $data = $error->parse_error();
        return helpers::jsonResponse($data);
    }
});
