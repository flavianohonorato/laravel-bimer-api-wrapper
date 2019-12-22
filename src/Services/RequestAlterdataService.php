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
            return app()->make('ApiClientAlterdata')->send($endpoint, $data);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update
     *
     * @param $endpoint
     * @param $data
     * @param $params
     * @param $type
     * @return bool|mixed
     */
    public static function update($endpoint, $data, $params, $type = 'put')
    {
        try {
            return app()->make('ApiClientAlterdata')
                ->send($endpoint, $data, $params, $type);
        } catch (\Exception $e) {
            return false;
        }
    }
}