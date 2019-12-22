<?php

namespace Wicool\BimerApi\Services;

abstract class RequestAlterdataService
{
    /**
     * Get
     *
     * @param $endpoint
     * @param $params
     * @return bool|mixed
     */
    public static function get($endpoint, $params)
    {
        try {
            return app()->make('ApiClientAlterdata')->get($endpoint, $params);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Create
     * @param $endpoint
     * @param $data
     * @return bool|mixed
     */
    public static function create($endpoint, $data)
    {
        try {
            return app()->make('ApiClientAlterdata')->get($endpoint, $data);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update
     *
     * @param $endpoint
     * @param $data
     * @param $model
     * @param $id_alterdata
     * @return bool|mixed
     */
    public static function update($endpoint, $data, $model, $id_alterdata)
    {
        try {
            $findModel = $model::query()
                ->where('id', '=', $data->id)
                ->first();

            if (isset($findModel)) {
                return app()->make('ApiClientAlterdata')->get($endpoint, $id_alterdata);
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}