<?php

$app->get('/privacy/:locale', function ($locale) {
    try {
        $data = privacy::query()->where('locale', '=', $locale)->get();
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->get('/privacy/:locale/:id', function ($locale, $id) {
    try {
        $privacys = privacy::query()->where('locale', '=', $locale)->get();
        foreach ($privacys as $privacy) {
            if ($privacy->code_enum == $id) {
                $data = $privacy;
            }
        }
        return helpers::jsonResponse($data);
    } catch (Exception $ex) {
        $error = new custonError(3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});

$app->post('/privacy/save', function () use($app) {
    try {
        $privacy = new privacy();
        $privacy->locale = $app->request()->post('locale');
        $privacy->code_enum = $app->request()->post('code_enum');
        $privacy->name = $app->request()->post('name');
        $privacy->description = $app->request()->post('description');
        $privacy->check_default = $app->request()->post('check_default');

        if ($privacy->save()) {
            $data = privacy::find($privacy->id);
            return helpers::jsonResponse($data);
        }
    } catch (Exception $ex) {
        $error = new custonError(2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error());
    }
});
