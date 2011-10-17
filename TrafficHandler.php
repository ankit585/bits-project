<?php

require_once 'TrafficBrowseHandler.php';
require_once 'TrafficUpdateHandler.php';
require_once 'TrafficRequestType.php';

class TrafficHandler
{

        function createHandler($requestType) {
                if ($requestType == TrafficRequestType::BROWSE) {
                        $handler = new TrafficBrowseHandler();
                } else if ($requestType == TrafficRequestType::UPDATE) {
                        $handler = new TrafficUpdateHandler();
                }
                return $handler;
        }

        function processRequest($requestType,$requestContext) {

                $handler = $this->createHandler($requestType);
                $responseContext = $handler->processRequest($requestContext);
                return $responseContext;
        }

}
?>
