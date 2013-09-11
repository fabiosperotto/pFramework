<?php

/**
 * FrontController
 * Define os caminhos para os arquivos.
 */
define('SERVER_ROOT' , __DIR__);
define('SITE_ROOT' , 'http://localhost');
define('DS', DIRECTORY_SEPARATOR);
define('MAIN_CONT', ''); //troque para o seu controlador principal

/**
 * Busca o controlador de paginas do framework
 */
require_once(SERVER_ROOT . DS . 'system' . DS . 'config' . DS . 'router.php');
