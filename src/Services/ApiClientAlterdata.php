<?php

namespace Wicool\BimerApi\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class ApiClientAlterdata
{
    /*
     * @var $token
     */
    protected $token = null;

    /**
     * @var Client
     */
    private $client;

    /**
     * ApiClientAlterdata constructor.
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * Faz o login na API do Alterdata e seta o token
     *
     * @throws GuzzleException
     */
    public function prepare_access_token()
    {
        try {
            $url = self::getEnvirolment() . 'oauth/token';

            $response = $this->client->request('POST', $url, [
                'form_params' => config('bimer-api.login_params')
            ]);

            $result = $response->getBody();
            $result = json_decode($result);
            $this->token = $result->access_token;

        } catch (RequestException $e) {
            $response = $this->statusCodeHandling($e);

            return $response;
        }
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return mixed
     * @throws GuzzleException
     */
    public function get($endpoint, $params = null)
    {
        if ($endpoint !== 'oauth/token') {
            $endpoint = 'api/'.$endpoint;
        }

        if (is_null($this->token)) {
            $this->prepare_access_token();
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];

        $client = new Client([
            'base_uri' => self::getEnvirolment(),
        ]);

        if (is_array($params)) {
            $array_params = $params;
        } else {
            $endpoint .= '/'.$params;
        }

        $request = $client->get($endpoint,[
            'query'     =>  $array_params ?? null,
            'headers'   =>  $headers
        ]);

        $response = $request->getBody();

        return $response ?? false;
    }

    /**
     * @param string $endpoint
     * @param null $data
     * @param null $params
     * @param string $type
     * @return array|mixed|null
     * @throws GuzzleException
     */
    public function send(string $endpoint, $data = null, $params = null, $type = 'post')
    {
        $type = strtolower($type);

        if ($endpoint !== 'oauth/token') {
            $endpoint = 'api/'.$endpoint;
        }

        if (is_null($this->token)) {
            $this->prepare_access_token();
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept'        => 'application/json',
        ];

        $client = new Client([
            'base_uri' => self::getEnvirolment(),
        ]);

        switch ($type) {
            case 'put':
                $request = $client->put($endpoint,[
                    'query'         =>  $params,
                    'headers'       =>  $headers ?? null,
                    'form_params'   =>  $data
                ]);
                break;
            case 'delete':
                $request = $client->delete($endpoint . $data,[
                    'headers'   =>  $headers ?? null,
                ]);
                break;
            case 'post':
                $request = $client->post($endpoint,[
                    'headers'       =>  $headers,
                    'form_params'   =>  $data
                ]);
                break;
            default:
                $request = $client->post($endpoint,[
                    'query'         =>  $params,
                    'headers'       =>  $headers ?? null,
                    'form_params'   =>  $data
                ]);
        }

        $response = $request->getBody();

        return $response ?? null;
    }

    /**
     * Get Envirolment
     *
     * @param null $value
     * @return mixed
     */
    protected static function getEnvirolment($value = null)
    {
        if (is_null($value)) {
            if (config('app.env') == 'production') {
                return config('bimer-api.api_url_production');
            }
            return config('bimer-api.api_url_sandbox');
        }
        if ($value === 'production') {
            return config('bimer-api.api_url_production');
        }
        return config('bimer-api.api_url_sandbox');
    }

    /**
     * Normalize Response Data so it will return an array for "all" method
     * and a single object for all other methods
     * @param $response
     * @param bool $single
     * @return array|mixed|null
     */
    public static function normalizeData($response, $single = true)
    {
        $isArray    = isset($response->ListaObjetos) && is_array($response->ListaObjetos);
        $array      = $isArray ? $response->ListaObjetos : [];
        $item       = reset($array) ? reset($array) : null;

        return $single ? $item : $array;
    }

    /**
     * @param $e
     * @return mixed
     * @throws GuzzleException
     */
    public function statusCodeHandling($e)
    {
        switch ($e->getResponse()->getStatusCode()) {
            case 400 :
                $this->prepare_access_token();
                break;
            case 422 :
                return json_decode($e->getResponse()
                    ->getBody(true)
                    ->getContents());
            case 500 :
                return json_decode($e->getResponse()
                    ->getBody(true)
                    ->getContents());
            case 401 :
                return json_decode($e->getResponse()
                    ->getBody(true)
                    ->getContents());
            case 403 :
                return json_decode($e->getResponse()
                    ->getBody(true)
                    ->getContents());
            default :
                return json_decode($e->getResponse()
                    ->getBody(true)
                    ->getContents());
        }
    }
}
