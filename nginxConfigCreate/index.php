<?php

require '../vendor/autoload.php';

use RomanPitak\Nginx\Config\Directive;
use RomanPitak\Nginx\Config\Scope;

$config = include 'config.php';
Scope::create()
    ->addDirective(
        Directive::create('server')
            ->setChildScope(
                Scope::create()
                    ->addDirective(Directive::create('listen', 80))
                    ->addDirective(
                        Directive::create(
                            'index',
                            'index.php index.html index.htm default.php default.htm default.html'
                        )
                    )
                    ->addDirective(Directive::create('server_name', 'mm.test'))
                    ->addDirective(
                        Directive::create(
                            'location',
                            '^~ /h5/',
                            Scope::create()
                                ->addDirective(Directive::create('proxy_pass', $config['h5_url'] . '/'))
                        )
                    )
                    ->addDirective(
                        Directive::create(
                            'location',
                            '^~ /api/',
                            Scope::create()
                                ->addDirective(Directive::create('proxy_pass', $config['api_url'] . '/'))
                        )
                    )
                    ->addDirective(
                        Directive::create(
                            'location',
                            '^~ /down/',
                            Scope::create()
                                ->addDirective(Directive::create('proxy_pass', $config['app_url'] . '/'))
                        )
                    )
                    ->addDirective(
                        Directive::create(
                            'location',
                            '^~ /merchant/',
                            Scope::create()
                                ->addDirective(Directive::create('proxy_pass', $config['agent_url'] . '/merchant/'))
                        )
                    )

            )
    )
    ->saveToFile($config['path']);

