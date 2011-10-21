<?php
require_once 'DAO_VO/TrafficDensity.php';
require_once 'DAO_VO/Location.php';
require_once 'DAO_VO/Route.php';
require_once 'DataFactory.php';

class TrafficUpdateModel
{

        function processRequest($requestContext) {

                $src = $requestContext["src_location"];
                $dest = $requestContext["dest_location"];
                $traffic = $requestContext["traffic_density"];
                if ($this->updateTrafficDensity($src,$dest,$traffic)) {
                   $status = "OK";       
                } else {
                   $status = "ERROR";
                }
                return $status;
        }


        function updateTrafficDensity($src,$dest,$traffic) {

                 
                $conn = new Datasource('fa3.ads.corp.sp1.yahoo.com', 'tss', 'ui_user', 'some_pass');
                
                $df = new DataFactory();
                
                $locationDao = $df->createLocationDAO();
                $location = $locationDao->createValueObject();

                $location->setName($src);
                $startLocId=$locationDao->searchMatching($conn, $location);
                
                $location->setName($dest);
                $endLocId=$locationDao->searchMatching($conn, $location);
                $routeDao = $df->createRouteDAO();
                $route = $routeDao->createValueObject();

                $route->setStartLocationId($startLocId[0]->getId());
                $route->setEndLocationId($endLocId[0]->getId());

                $routeId = $routeDao->searchMatching($conn, $route);
                
                $trafficDensityDao = $df->createTrafficDensityDAO();
                $trafficDensity = $trafficDensityDao->createValueObject();
                $trafficDensity->setLegId($routeId[0]->getLegId());
                $trafficDensity->setRouteId($routeId[0]->getId());

                $trafficDen =  $trafficDensityDao->searchMatching($conn, $trafficDensity);
                
                $density = $trafficDen[0]['density'];
                $new_density = round((0.7*$density) + (0.3 * $traffic));  
                $trafficDensity->setDensity($new_density);   
                
                $trafficDensityDao->save($conn, $trafficDensity);   
                return 1;
         }    

}
?>
