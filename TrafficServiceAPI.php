<?php

require_once 'RestUtils.php';
require_once 'TrafficRequestType.php';
require_once 'XML/Serializer.php';
require_once 'TrafficHandler.php';


$data = RestUtils::processRequest();

switch($data->getMethod())
{

case 'get':
        $requestContext = array();
        $request = $data->getRequestVars();
        $requestContext["request_type"] = $request["request_type"];
        $requestContext["src_location"] = $request["src_location"];
        $requestContext["dest_location"] = $request["dest_location"];
        $requestTypeObj = new TrafficRequestType();
        $requestTypeEnum = $requestTypeObj->getTrafficRequestType($requestContext["request_type"]);

        $restHandler = new TrafficServiceAPI();
        $responseCode = 200;
        $responseMessage = "";

        if (!($restHandler->validateRequest($requestTypeEnum))) {
                //handle error
                $responseCode = 501;
                $responseMessage = "Invalid Request Type ". $request["request_type"];
        } else {
                $responseContext = $restHandler->handleRequest($requestTypeEnum,$requestContext);
                $responseMessage = $responseContext;
                $responseCode = 200;
        }

        if($data->getHttpAccept() == 'json') {
                RestUtils::sendResponse($responseCode, json_encode($responseMessage), 'application/json');
        } else if ($data->getHttpAccept() == 'xml') {
                // using the XML_SERIALIZER Pear Package
                $options = array
                           (
                                   'indent' => '     ',
                                   'addDecl' => true,
                                   'rootName' => 'TrafficData',
                                   'defaultTagName' => 'leg',
                                   XML_SERIALIZER_OPTION_RETURN_RESULT => true
                           );
                $serializer = new XML_Serializer($options);
                RestUtils::sendResponse($responseCode, $serializer->serialize($responseMessage) , 'application/xml');
        }

        break;

case 'post':

}




class TrafficServiceAPI
{


        function handleRequest($requestType,$requestContext) {

                $responseHandler = new TrafficHandler();
                $responseContext = $responseHandler->processRequest($requestType,$requestContext);
                return $responseContext;
        }

        function validateRequest($requestType) {

                if ($requestType == TrafficRequestType::INVALID) {
                        return 0;
                }
                return 1;
        }

}



?>
