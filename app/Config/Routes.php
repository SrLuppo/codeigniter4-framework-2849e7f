<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\FornecedoresController;  
use App\Controllers\Fornecedores1;  

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/produtos', 'ProdutosController::index');
$routes->post('/produtos/cadastrar', 'ProdutosController::cadastrar');
$routes->post('/produtos/editar', 'ProdutosController::editar');
$routes->post('/produtos/excluir/(:num)', 'ProdutosController::excluir/$1');

$routes->get('/fornecedores', 'FornecedoresController::index');
$routes->post('/fornecedores/cadastrar', 'FornecedoresController::cadastrar');
$routes->post('/fornecedores/editar/(:num)', 'FornecedoresController::editar/$1');
$routes->post('/fornecedores/excluir/(:num)', 'FornecedoresController::excluir/$1');
