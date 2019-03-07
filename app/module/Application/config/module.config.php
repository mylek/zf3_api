<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/doc',
                    'defaults' => [
                        'controller' => Controller\DocController::class,
                        'action' => 'index',
                        'isAuthorizationRequired' => false // set true if this api Required JWT Authorization.
                    ],
                ],
            ],
			'api' => [
                'type' => Segment::class,
				'options' => [
					'route' => '/api',
				],
				'may_terminate' => true,
				'child_routes' => [
					'application' => [
						'type' => Segment::class,
						'options' => [
							'route' => '/v1',
							'defaults' => [
								'controller' => Controller\PageController::class,
								'action' => 'index',
							],
						],
					],
				],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\DocController::class => InvokableFactory::class,
            Controller\PageController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];