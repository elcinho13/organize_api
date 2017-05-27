<?php

$app->get('/term', function() {
    try {
        $data = term::query()
                ->where('is_active', '=', true)
                ->first();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/term/save', function () use($app) {
    try {
        $term = new term();
        $term->locale = $app->request()->post('locale');
        $term->version_name = $app->request()->post('version_name');
        $term->title = $app->request()->post('title');
        $term->content = $app->request()->post('content');
        $term->publication_date = $app->request()->post('publication_date');
        $term->is_active = true;

        if ($term->save()) {
            $data = term::find($term->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/term/:id/active', function ($id) use($app) {
    try {
        $term = term::find($id);
        $term->is_active = $app->request()->post('is_active');

        if ($term->update()) {
            $data = $term::find($term->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
