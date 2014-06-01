<?php

namespace Netgusto\HMVCBundle\Services;

use Symfony\Component\HttpKernel\HttpKernelInterface;

class HMVCRequestHandler {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function delegate($controller, $path = array(), $query=array()) {
        
        $path['_controller'] = $controller;
        $subRequest = $this->container->get('request')->duplicate($query, null, $path);

        $response = $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);

        if($response->isRedirect() || !$response->isSuccessful()) {
            $response->send();
            exit;
        }

        return $response;
    }
}