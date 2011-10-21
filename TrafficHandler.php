<?php

require_once 'TrafficBrowseModel.php';
require_once 'TrafficUpdateModel.php';
require_once 'TrafficRequestType.php';

class TrafficHandler
{

        function createHandler($requestType) {
                if ($requestType == TrafficRequestType::BROWSE) {
                        $model = new TrafficBrowseModel();
                } else if ($requestType == TrafficRequestType::UPDATE) {
                        $model = new TrafficUpdateModel();
                }
                return $model;
        }

        function processRequest($requestType,$requestContext) {

                $handler = $this->createHandler($requestType);
                $responseContext = $handler->processRequest($requestContext);
                return $responseContext;
        }

}
?>
