<?php

require __DIR__ . '../vendor/autoload.php';

use Wicool\BimerApi\Services\RequestAlterdataService as RequestBimer;

/**
 * Dados Usuário Logado
 */
$params = [
    'nomeLogin' => 'BimerAPI',
];

RequestBimer::get('usuarios', $params);

$response = json_decode($response, true);

if (isset($response->ListaObjetos)) {
    print_r($response->ListaObjetos);
}