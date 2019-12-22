<?php

require __DIR__.'../vendor/autoload.php';

use Wicool\BimerApi\Services\RequestAlterdataService as RequestBimer;

/**
 * CREATE
 */
$data = [
    'Identificador' => 'string',
    'Enderecos' => [
        'CEP' => 'string',
        'CodigoSuframa' => 'string',
        'Complemento' => 'string',
        'IdentificadorBairro' => 'string',
        'IdentificadorCidade' => 'string',
        'IdentificadorTipoLogradouro' => 'string',
        'InscricaoEstadual' => 'string',
        'NomeLogradouro' => 'string',
        'NumeroLogradouro' => 'string',
        'Observacao' => 'string',
        'PessoasContato' => [
            'ContatoPrincipal' => true,
            'Fax' => 'string',
            'Email' => 'string',
            'EmailNfEletronica' => 'string',
            'EmailCobranca' => 'string',
            'EmailBoleto' => 'string',
            'Identificador' => 'string',
            'Nome' => 'string',
            'PaginaInternet' => 'string',
            'TipoCadastro' => 'string',
            'TelefoneCelular' => 'string',
            'TelefoneFixo' => 'string',
            'Suporte' => 'string'
        ],
        'SiglaUnidadeFederativa' => 'string',
        'TipoCadastro' => 'string',
        'Tipos' => [
            'Cobranca' => true,
            'Comercial' => true,
            'Correspondencia' => true,
            'Entrega' => true,
            'Principal' => true,
            'Residencial' => true
        ]
        ,
        'TipoContribuicaoICMS' => 'string',
        'Codigo' => 'string'
    ],
    'IdentificadorRepresentantePrincipal' => 'string',
    'Tipo' => 'string',
    'Codigo' => 'string',
    'CpfCnpj' => 'string',
    'DataNascimento' => '2019-08-09T17:20:58.352Z',
    'Nome' => 'string',
    'NomeCurto' => 'string'
];

RequestBimer::send('clientes', $data);

$response = json_decode($response, true);

if (isset($response->ListaObjetos)) {
    print_r($response->ListaObjetos);
}