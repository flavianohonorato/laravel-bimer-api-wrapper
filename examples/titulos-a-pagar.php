<?php

require __DIR__ . '../vendor/autoload.php';

use Wicool\BimerApi\Services\RequestAlterdataService as RequestBimer;

/**
 * GET
 */
$params = [
    'codigoEmpresa'         => '',
    'identificadorPessoa'   => '',
    'dataCadastroInicial'   => '2019-01-01',
    'dataCadastroFinal'     => '2019-01-30',
    'limite'                => '10000',
    'pagina'                => '1',
];

RequestBimer::get('titulosAPagar', $params);

$response = json_decode($response, true);

if (isset($response->ListaObjetos)) {
    print_r($response->ListaObjetos);
}

if ($response['Erros'][0]) {
    foreach ($response['Erros'][0] as $erro) {
        print_r($erro->ErrorMessage);
    }
}

/**
 * CREATE
 */
$data = [
    'Valor'                 => '3.000',
    'CodigoEmpresa'         => '123abc',
    'DataCadastro'          => date("Y-m-d\TH:i:s", strtotime(date('Y-m-d'))),
    'DataVencimento'        => date("Y-m-d\TH:i:s", strtotime(date('Y-m-d'))),
    'DataReferencia'        => date("Y-m-d\TH:i:s", strtotime(date('Y-m-d'))),
    'IdentificadorPessoa'   => '1234ABCD',
    'Numero'                => 'ABC123',
];

$response = RequestBimer::create('titulosAPagar', $data);
$response = json_decode($response, true);

if (isset($response->ListaObjetos)) {
    print_r($response->ListaObjetos[0]);
}

/**
 * Update
 */
$data = [
    'Valor'                 => '',
    'CodigoEmpresa'         => '',
    'IdentificadorPessoa'   => '',
    'Numero'                => '',
    'DataCadastro'          => '',
    'DataVencimento'        => '',
    'DataReferencia'        => '',
];
$params = [
    'Identificador' => '1234ABCD', // id do registro na API
];

$response = RequestBimer::update('titulosAPagar', $data, $params, 'put');
$response = json_decode($response, true);

if (isset($response->ListaObjetos)) {
    print_r($response->ListaObjetos[0]);
}



