<?php

return [
    ''                             => 'HomeController@index',
    'home'                         => 'HomeController@index',
    'login'                        => 'LoginController@indexLogin',
    'login/do'                     => 'LoginController@loginUser',
    'cadastre-se'                  => 'LoginController@indexRegister',
    'esqueci-minha-senha'          => 'LoginController@indexForgotPassword',
    'usuarios'                     => 'UserController@index',
    'usuarios/delete'              => 'UserController@delete',
    'usuarios/cadastro'            => 'UserController@indexForm',
    'usuarios/cadastro/create'     => 'UserController@create',
    'usuarios/cadastro/{id}'       => 'UserController@indexForm',
    'usuarios/cadastro/edit/{id}'  => 'UserController@edit',
    'parceiros'                    => 'PartnerController@index',
    'parceiros/delete'             => 'PartnerController@delete',
    'parceiros/cadastro'           => 'PartnerController@indexForm',
    'parceiros/cadastro/create'    => 'PartnerController@save',
    'parceiros/cadastro/{id}'      => 'PartnerController@indexForm',
    'parceiros/cadastro/edit/{id}' => 'PartnerController@save',
    'clientes'                     => 'CustomerController@index',
    'clientes/delete'              => 'CustomerController@delete',
    'clientes/cadastro'            => 'CustomerController@indexForm',
    'clientes/cadastro/create'     => 'CustomerController@save',
    'clientes/cadastro/{id}'       => 'CustomerController@indexForm',
    'clientes/cadastro/edit/{id}'  => 'CustomerController@save',
    'especialidades/find'          => 'SpecialtyController@findByName',

];
