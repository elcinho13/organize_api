<?php

$app->get('/first_access/:device_id', function ($device_id) {
    try {
        $data = first_access::query()
                ->where('device_id', '=', $device_id)
                ->first();
        $error = new custonError(false, 0);
        return helpers::jsonResponse($error->parse_error(), $data);
    } catch (Exception $ex) {
        $error = new custonError(true, 2, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/first_access/save', function () use($app) {
    try {
        $first_access = new first_access();
        $first_access->device_id = $app->request()->post('device_id');
        $first_access->instalation_date = $app->request()->post('instalation_date');
        $first_access->locale = $app->request()->post('locale');

        if ($first_access->save()) {
            $data = first_access::find($first_access->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/first_access/:id/edit', function ($id) use($app) {
    try {
        $first_access = first_access::find($id);
        $first_access->locale = $app->request()->post('locale');

        if ($first_access->update()) {
            $data = first_access::find($first_access->id);
            $error = new custonError(false, 0);
            return helpers::jsonResponse($error->parse_error(), $data);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 4, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});
