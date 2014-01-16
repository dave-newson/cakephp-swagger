<?php
/**
 * Swagger Routes
 */

 Router::connect(
    '/api/docs',
    array('plugin'=>'Swagger', 'controller' => 'Swagger', 'action' => 'generateDocumentation')
);

Router::connect(
    '/api/docs/:resource',
    array('plugin'=>'Swagger', 'controller' => 'Swagger', 'action' => 'generateDocumentation'),
    array('pass'=>array('resource'))
);