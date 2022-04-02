<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    $builder->connect('/', ['controller' => 'Evaluations', 'action' => 'externo']);
    $builder->connect('/evaluacion/:id', ['controller' => 'Evaluations', 'action' => 'ejecutar']);
    $builder->connect('/reporte/:id', ['controller' => 'Evaluations', 'action' => 'reporte']);
    $builder->connect('/send/:id', ['controller' => 'Evaluations', 'action' => 'send']);
    $builder->connect('/resultados/:id', ['controller' => 'Evaluations', 'action' => 'resultados']);
    $builder->connect('/graph1/:id', ['controller' => 'Evaluations', 'action' => 'graph1']);
    $builder->connect('/graph2/:id', ['controller' => 'Evaluations', 'action' => 'graph2']);
    $builder->connect('/graph3/:id', ['controller' => 'Evaluations', 'action' => 'graph3']);
    $builder->connect('/sales/excel/:id', ['controller' => 'Sales', 'action' => 'excel']);
    $builder->connect('/sales/word/:id', ['controller' => 'Sales', 'action' => 'word']);
    $builder->connect('/sales/download/:id', ['controller' => 'Sales', 'action' => 'download']);
    $builder->connect('/evaluations/reporte/:id', ['controller' => 'Evaluations', 'action' => 'reporte']);
    $builder->connect('/evaluations/process/:id', ['controller' => 'Evaluations', 'action' => 'process']);
    $builder->connect('/evaluations/finalizado/:id', ['controller' => 'Evaluations', 'action' => 'finalizado']);
    $builder->connect('/evaluations/respuestas/:id', ['controller' => 'Evaluations', 'action' => 'respuestas']);

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
